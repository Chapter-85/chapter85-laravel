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
        dd($request->all());
        $request->validate([
            'cart_ids' => ['required'],
            'user_id' => ['required'],
            // 'payment_method_id' => ['required'],
            // 'delivery_method_id' => ['required'],
            'currency' => ['required'],
        ]);

        $user = User::find($request->user_id);
        $customer = Customer::where('user_id', $request->user_id)->first();

        $order = Order::create([
            'customer_id' => $customer->id,
            // 'delivery_method_id' => $request->delivery_method_id,
            // 'payment_method_id' => $request->payment_method_id,
            'payment_status' => 'UNPAID',
            'order_status' => 'PENDING',
            'delivery_status' => 'PENDING',
            'currency' => $request->currency,
            'created_at' => $request->created_at
        ]);

        Notification::send($user, new OrderCreated());

        // dd($order);
        return ['url' => route('order-delivery-details', $order->id)];
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
