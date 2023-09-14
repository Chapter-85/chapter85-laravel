<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductCommission;
use App\Models\Setup;
use App\Models\ShopCart;
use App\Models\User;
use App\Notifications\OrderCreated;
use Illuminate\Http\Request;
use DataTables;
use ErrorException;
use Illuminate\Support\Facades\Notification;

class CustomerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerProduct::with(['product', 'customer'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('purchase_price', function ($row) {
                    return $row->purchase_price . ' USD';
                })
                // ->rawColumns()
                ->make(true);
        }
        return view('customer_products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cart_ids' => ['required'],
            'user_id' => ['required'],
            'payment_method_id' => ['required'],
            'delivery_method_id' => ['required'],
            'currency' => ['required'],
        ]);

        $products = [];
        $quantities = [];
        $total_order_price = 0;
        $total_quantity = 0;
        $user = User::find($request->user_id);
        $customer = Customer::where('user_id', $request->user_id)->first();
        $payment_method = PaymentMethod::findOrFail($request->payment_method_id);
        $delivery_method = Setup::findOrFail($request->delivery_method_id);

        if ($user->is_verified == 1) {
            if (strtolower($request->payment_method) != 'credit card') {
                $order = Order::create([
                    'customer_id' => $customer->id,
                    'delivery_method_id' => $request->delivery_method_id,
                    'payment_method_id' => $request->payment_method_id,
                    'payment_status' => 'UNPAID',
                    'order_status' => 'PENDING',
                    'delivery_status' => 'PENDING',
                    'currency' => $request->currency,
                    'created_at' => $request->created_at
                ]);
            } else {
                $order = Order::create([
                    'customer_id' => $customer->id,
                    'delivery_method_id' => $request->delivery_method_id,
                    'payment_method_id' => $request->payment_method_id,
                    'payment_status' => 'PAID',
                    'order_status' => 'CONFIRMED',
                    'delivery_status' => 'PENDING',
                    'currency' => $request->currency,
                    'created_at' => $request->created_at
                ]);
            }
            if (strtolower($request->payment_method) != 'credit card') {
                if (isset($payment_method->due_date)) {
                    if ($payment_method->due_date_type == 'hour') {
                        $payment_due_date = $order->created_at->addHours($payment_method->due_date);
                    } else {
                        $payment_due_date = $order->created_at->addDays($payment_method->due_date);
                    }
                    $order->payment_due_date = $payment_due_date;
                    $order->save();
                }
            }

            if (isset($delivery_method->due_date)) {
                if ($delivery_method->due_date_type == 'hour') {
                    $delivery_due_date = $order->created_at->addHours($delivery_method->due_date);
                } else {
                    $delivery_due_date = $order->created_at->addDays($delivery_method->due_date);
                }
                $order->delivery_due_date = $delivery_due_date;
                $order->save();
            }
            // dd($payment_due_date);
            Notification::send($user, new OrderCreated($payment_method->email_instructions));
            foreach ($request->cart_ids as $key => $cart) {
                $user_cart = ShopCart::find($cart);

                $tier_1 = null;
                $tier_2 = null;
                $tier_3 = null;
                $tier_4 = null;
                $mark_up = null;
                $markup_type = null;

                $product = Product::where('id', $user_cart->product_id)->with('category')->first();
                $result = $product->productsInventory($user_cart->quantity);
                if ($result != null) {
                    if ($product->surcharge_at_product == 'no') {
                        $mark_up = $product->category->mark_up;
                        $markup_type = $product->category->markup_type;
                    } else {
                        $mark_up = $product->mark_up;
                        $markup_type = $product->markup_type;
                    }
                    array_push($products, $product);
                    array_push($quantities, $user_cart->quantity);
                    $total_order_price = $total_order_price + $user_cart->total_price;
                    $total_quantity = $total_quantity + $user_cart->quantity;
                    $user_cart->status = 'purchased';
                    $user_cart->save();
                    if ($product->getProductCommission() != null) {
                        if ($user->referred_by != null) {

                            $tier_1 = User::where('referral_code', $user->referred_by)->first();

                            if ($tier_1 != null) {
                                $tier_1_commission = ($product->getProductCommission() / 100) * $product->tier_commission_1;

                                $input_product_commission = [
                                    'customer_id' => $customer->id,
                                    'product_id' => $user_cart->product_id,
                                    'order_id' => $order->id,
                                    'product_price' => $product->getProductPriceWithoutMarkUp(),
                                    'product_mark_up' => $mark_up,
                                    'mark_up_type' => $markup_type,
                                    'tier_type' => 'tier_1',
                                    'tier_id' => $tier_1->id,
                                    'tier_commission' => $tier_1_commission,
                                    'tier_commission_percentage' => $product->tier_commission_1,
                                ];

                                ProductCommission::create($input_product_commission);
                            } else {
                                // $product->tier_commission_5 = $product->tier_commission_5+$product->t;
                                $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_1 + $product->tier_commission_2 + $product->tier_commission_3 + $product->tier_commission_4;
                                $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                $input_product_commission = [
                                    'customer_id' => $customer->id,
                                    'product_id' => $user_cart->product_id,
                                    'order_id' => $order->id,
                                    'product_price' => $product->getProductPriceWithoutMarkUp(),
                                    'product_mark_up' => $mark_up,
                                    'mark_up_type' => $markup_type,
                                    'tier_type' => 'tier_5',
                                    'tier_commission' => $tier5commission,
                                    'commission_got_percentage' => $tier_commission_5,
                                    'commission_got' => $tier_5_commission,
                                    'tier_commission_percentage' => $product->tier_commission_5,
                                ];

                                ProductCommission::create($input_product_commission);
                            }
                            if ($tier_1->referred_by != null) {
                                $tier_2 = User::where('referral_code', $tier_1->referred_by)->first();
                                if ($tier_2 != null) {
                                    $tier_2_commission = ($product->getProductCommission() / 100) * $product->tier_commission_2;

                                    $input_product_commission = [
                                        'customer_id' => $customer->id,
                                        'product_id' => $user_cart->product_id,
                                        'order_id' => $order->id,
                                        'product_price' => $product->getProductPriceWithoutMarkUp(),
                                        'product_mark_up' => $mark_up,
                                        'mark_up_type' => $markup_type,
                                        'tier_type' => 'tier_2',
                                        'tier_id' => $tier_2->id,
                                        'tier_commission' => $tier_2_commission,
                                        'tier_commission_percentage' => $product->tier_commission_2,
                                    ];

                                    ProductCommission::create($input_product_commission);
                                } else {
                                    $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_4 + $product->tier_commission_2 + $product->tier_commission_3;
                                    $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                    $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                    $input_product_commission = [
                                        'customer_id' => $customer->id,
                                        'product_id' => $user_cart->product_id,
                                        'order_id' => $order->id,
                                        'product_price' => $product->getProductPriceWithoutMarkUp(),
                                        'product_mark_up' => $mark_up,
                                        'mark_up_type' => $markup_type,
                                        'tier_type' => 'tier_5',
                                        'tier_commission' => $tier5commission,
                                        'commission_got_percentage' => $tier_commission_5,
                                        'commission_got' => $tier_5_commission,
                                        'tier_commission_percentage' => $product->tier_commission_5,
                                    ];

                                    ProductCommission::create($input_product_commission);
                                }
                                // dd($tier_3->referred_by);
                                if ($tier_2->referred_by != null) {
                                    $tier_3 = User::where('referral_code', $tier_2->referred_by)->first();

                                    if ($tier_3 != null) {
                                        $tier_3_commission = ($product->getProductCommission() / 100) * $product->tier_commission_3;

                                        $input_product_commission = [
                                            'customer_id' => $customer->id,
                                            'product_id' => $user_cart->product_id,
                                            'order_id' => $order->id,
                                            'product_price' => $product->getProductPriceWithoutMarkUp(),
                                            'product_mark_up' => $mark_up,
                                            'mark_up_type' => $markup_type,
                                            'tier_type' => 'tier_3',
                                            'tier_id' => $tier_3->id,
                                            'tier_commission' => $tier_3_commission,
                                            'tier_commission_percentage' => $product->tier_commission_3,
                                        ];

                                        ProductCommission::create($input_product_commission);
                                    } else {
                                        $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_4 + $product->tier_commission_3;
                                        $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                        $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                        $input_product_commission = [
                                            'customer_id' => $customer->id,
                                            'product_id' => $user_cart->product_id,
                                            'order_id' => $order->id,
                                            'product_price' => $product->getProductPriceWithoutMarkUp(),
                                            'product_mark_up' => $mark_up,
                                            'mark_up_type' => $markup_type,
                                            'tier_type' => 'tier_5',
                                            'tier_commission' => $tier5commission,
                                            'commission_got_percentage' => $tier_commission_5,
                                            'commission_got' => $tier_5_commission,
                                            'tier_commission_percentage' => $product->tier_commission_5,
                                        ];

                                        ProductCommission::create($input_product_commission);
                                    }
                                    if ($tier_3->referred_by != null) {
                                        $tier_4 = User::where('referral_code', $tier_3->referred_by)->first();
                                        if ($tier_4 != null) {
                                            $tier_4_commission = ($product->getProductCommission() / 100) * $product->tier_commission_4;

                                            $input_product_commission = [
                                                'customer_id' => $customer->id,
                                                'product_id' => $user_cart->product_id,
                                                'order_id' => $order->id,
                                                'product_price' => $product->getProductPriceWithoutMarkUp(),
                                                'product_mark_up' => $mark_up,
                                                'mark_up_type' => $markup_type,
                                                'tier_type' => 'tier_4',
                                                'tier_id' => $tier_4->id,
                                                'tier_commission' => $tier_4_commission,
                                                'tier_commission_percentage' => $product->tier_commission_4,
                                            ];

                                            ProductCommission::create($input_product_commission);

                                            $tier_commission_5 = $product->tier_commission_5;
                                            $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                            $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                            $input_product_commission = [
                                                'customer_id' => $customer->id,
                                                'product_id' => $user_cart->product_id,
                                                'order_id' => $order->id,
                                                'product_price' => $product->getProductPriceWithoutMarkUp(),
                                                'product_mark_up' => $mark_up,
                                                'mark_up_type' => $markup_type,
                                                'tier_type' => 'tier_5',
                                                'tier_commission' => $tier5commission,
                                                'commission_got_percentage' => $tier_commission_5,
                                                'commission_got' => $tier_5_commission,
                                                'tier_commission_percentage' => $product->tier_commission_5,
                                            ];

                                            ProductCommission::create($input_product_commission);
                                        } else {
                                            $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_4;
                                            $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                            $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                            $input_product_commission = [
                                                'customer_id' => $customer->id,
                                                'product_id' => $user_cart->product_id,
                                                'order_id' => $order->id,
                                                'product_price' => $product->getProductPriceWithoutMarkUp(),
                                                'product_mark_up' => $mark_up,
                                                'mark_up_type' => $markup_type,
                                                'tier_type' => 'tier_5',
                                                'tier_commission' => $tier5commission,
                                                'commission_got_percentage' => $tier_commission_5,
                                                'commission_got' => $tier_5_commission,
                                                'tier_commission_percentage' => $product->tier_commission_5,
                                            ];

                                            ProductCommission::create($input_product_commission);
                                        }
                                    } else {
                                        $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_4;
                                        $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                        $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                        $input_product_commission = [
                                            'customer_id' => $customer->id,
                                            'product_id' => $user_cart->product_id,
                                            'order_id' => $order->id,
                                            'product_price' => $product->getProductPriceWithoutMarkUp(),
                                            'product_mark_up' => $mark_up,
                                            'mark_up_type' => $markup_type,
                                            'tier_type' => 'tier_5',
                                            'tier_commission' => $tier5commission,
                                            'commission_got_percentage' => $tier_commission_5,
                                            'commission_got' => $tier_5_commission,
                                            'tier_commission_percentage' => $product->tier_commission_5,
                                        ];

                                        ProductCommission::create($input_product_commission);
                                    }
                                } else {
                                    $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_4 + $product->tier_commission_3;
                                    $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                    $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                    $input_product_commission = [
                                        'customer_id' => $customer->id,
                                        'product_id' => $user_cart->product_id,
                                        'order_id' => $order->id,
                                        'product_price' => $product->getProductPriceWithoutMarkUp(),
                                        'product_mark_up' => $mark_up,
                                        'mark_up_type' => $markup_type,
                                        'tier_type' => 'tier_5',
                                        'tier_commission' => $tier5commission,
                                        'commission_got_percentage' => $tier_commission_5,
                                        'commission_got' => $tier_5_commission,
                                        'tier_commission_percentage' => $product->tier_commission_5,
                                    ];

                                    ProductCommission::create($input_product_commission);
                                }
                            } else {
                                $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_4 + $product->tier_commission_2 + $product->tier_commission_3;

                                $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                                $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                                $input_product_commission = [
                                    'customer_id' => $customer->id,
                                    'product_id' => $user_cart->product_id,
                                    'order_id' => $order->id,
                                    'product_price' => $product->getProductPriceWithoutMarkUp(),
                                    'product_mark_up' => $mark_up,
                                    'mark_up_type' => $markup_type,
                                    'tier_type' => 'tier_5',
                                    'tier_commission' => $tier5commission,
                                    'commission_got_percentage' => $tier_commission_5,
                                    'commission_got' => $tier_5_commission,
                                    'tier_commission_percentage' => $product->tier_commission_5,
                                ];

                                ProductCommission::create($input_product_commission);
                            }
                        } else {
                            // $tier_5_commission = $product->getProductCommission();

                            $tier_commission_5 = $product->tier_commission_5 + $product->tier_commission_1 + $product->tier_commission_2 + $product->tier_commission_3 + $product->tier_commission_4;
                            $tier_5_commission = ($product->getProductCommission() / 100) * $tier_commission_5;
                            $tier5commission = ($product->getProductCommission() / 100) * $product->tier_commission_5;

                            $input_product_commission = [
                                'customer_id' => $customer->id,
                                'product_id' => $user_cart->product_id,
                                'order_id' => $order->id,
                                'product_price' => $product->getProductPriceWithoutMarkUp(),
                                'product_mark_up' => $mark_up,
                                'mark_up_type' => $markup_type,
                                'tier_type' => 'tier_5',
                                'tier_commission' => $tier5commission,
                                'commission_got_percentage' => $tier_commission_5,
                                'commission_got' => $tier_5_commission,
                                'tier_commission_percentage' => $product->tier_commission_5,
                            ];
                            ProductCommission::create($input_product_commission);
                        }
                    }
                    $input = $user_cart->toArray();
                    $input['customer_id'] = $customer->id;
                    CustomerProduct::create($input);
                } else {
                    return back()->with('error', 'Product not Available');
                }
            }

            foreach ($products as $key => $prod) {

                if ($prod->surcharge_at_product == 'no') {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $prod->id,
                        'spot_price' => $prod->getProductPriceWithoutMarkUp(),
                        'price_with_markup' => $prod->getProductPrice('number'),
                        'total_price' => $prod->getProductPrice('number') * $quantities[$key],
                        'mark_up' => $prod->category->mark_up,
                        'markup_type' => $prod->category->markup_type,
                        'quantity' => $quantities[$key],
                    ]);
                } else {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $prod->id,
                        'spot_price' => $prod->getProductPriceWithoutMarkUp(),
                        'price_with_markup' => $prod->getProductPrice('number'),
                        'total_price' => $prod->getProductPrice('number') * $quantities[$key],
                        'mark_up' => $prod->mark_up,
                        'markup_type' => $prod->markup_type,
                        'quantity' => $quantities[$key]
                    ]);
                }

                Inventory::create([
                    'product_id' => $prod->id,
                    'order_id' => $order->id,
                    'units' => -1 * abs($quantities[$key])
                ]);
            }
            // dd($order);
            return ['url' => route('order-delivery-details', $order->id)];
        } else {
            return throw new ErrorException('User is not verified');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerProduct $customerProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerProduct $customerProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerProduct $customerProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerProduct $customerProduct)
    {
        //
    }

    public function customer_products($id)
    {
        return view('customer_products.single_customer_product', ['customerID' => $id]);
    }

    public function customer_products_ajax($id)
    {
        $data = CustomerProduct::with(['product', 'customer'])->whereHas('customer', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('purchase_price', function ($row) {
                return $row->purchase_price . ' USD';
            })
            // ->rawColumns(['customer_name'])
            ->make(true);
    }
}
