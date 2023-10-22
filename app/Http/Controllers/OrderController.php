<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\Setup;
use App\Models\User;
use App\Notifications\OrderConfirmed;
use App\Notifications\PaymentRecevied;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Notification;
use App\Models\ShopCart;
use App\Models\WalkInCustomer;
use App\Notifications\OrderCreated;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::with(['customer.user', 'order_products', 'delivery_method', 'payment_method'])->latest('updated_at')->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    return view('orders.actions', ['row' => $row]);
                })
                ->addColumn('total_price', function ($row) {
                    $total_price = OrderProduct::where('order_id', $row->id)->sum('total_price');
                    return 'USD ' . $total_price;
                })
                ->rawColumns(['action', 'total_price'])
                ->make(true);
        }
        return view('orders.index');
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
        $user = \Auth::user();
        if (!isset($user)) {
            $customer = WalkInCustomer::where(['session_id' => $request->cookie('laravel_session')])->first();
            $input = $request->all();
            $input['walk_in_customer_id'] = $customer->id;
            $input['payment_status'] = 'UNPAID';
            $input['order_status'] = 'In Progress';
            $input['delivery_status'] = 'PENDING';
            $input['currency'] = 'PKR';
            $order = Order::create($input);
            $carts = ShopCart::where('session_id', $request->cookie('laravel_session'))->get();
            foreach ($carts as $cart) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'spot_price' => $cart->spot_price,
                    'quantity' => $cart->quantity,
                    'total_price' => $cart->total_price,
                ]);

                Inventory::create([
                    'product_id' => $cart->product_id,
                    'product_size_id' => $cart->product_size_id,
                    'order_id' => $order->id,
                    'units' => -1 * abs($cart->quantity)
                ]);
            }
            ShopCart::where('session_id', $request->cookie('laravel_session'))->update(['status' => 'COMPLETED']);
            Notification::send($customer, new OrderCreated());
        } else {
            $customer = Customer::where(['user_id' => $user->id])->first();
            $input = $request->all();
            $input['customer_id'] = $customer->id;
            $input['payment_status'] = 'UNPAID';
            $input['order_status'] = 'In Progress';
            $input['delivery_status'] = 'PENDING';
            $input['currency'] = 'PKR';
            $order = Order::create($input);
            $carts = ShopCart::where('user_id', $user->id)->get();
            foreach ($carts as $cart) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'spot_price' => $cart->spot_price,
                    'quantity' => $cart->quantity,
                    'total_price' => $cart->total_price,
                ]);
                Inventory::create([
                    'product_id' => $cart->product_id,
                    'product_size_id' => $cart->product_size_id,
                    'order_id' => $order->id,
                    'units' => -1 * abs($cart->quantity)
                ]);
            }
            ShopCart::where('user_id', $user->id)->update(['status' => 'COMPLETED']);
            Notification::send($user, new OrderCreated());
        }
        return ['url' => route('home')];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.order_details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // dd($request->all());
        $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'zip_code' => 'required|string',
            'shipping_address' => 'required|string',
        ]);
        // $order->delivery_method = $request->delivery_method;
        $order->shipping_address = $request->shipping_address;
        $order->full_name = $request->full_name;
        $order->phone_number = $request->phone_number;
        $order->email = $request->email;
        $order->city = $request->city;
        $order->country = $request->country;
        $order->zip_code = $request->zip_code;
        $order->save();
        return ['url' => route('home')];
        // return redirect(route('home'))->with('success', 'order placed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function order_details($id)
    {
        $order = Order::where('id', $id)
            ->with(['customer', 'order_products.product.category', 'product_commissions.tier', 'delivery_method', 'payment_method', 'payment_status_updated_by_relation', 'delivery_status_updated_by_relation'])
            ->first();
        $total_price = OrderProduct::where('order_id', $id)->sum('total_price');
        // dd($order->toArray());
        return view('orders.order_details', ['order' => $order, 'total_price' => $total_price]);
    }

    public function order_delivery_details(Request $request)
    {

        $user = \Auth::user();
        if (!isset($user)) {
            $cart = ShopCart::where(['session_id' => $request->cookie('laravel_session'), 'status' => 'pending'])->get();
            $customer = WalkInCustomer::where(['session_id' => $request->cookie('laravel_session')])->first();
        } else {
            $cart = ShopCart::where(['user_id' => $user->id, 'status' => 'pending'])->get();
            $customer = Customer::where(['user_id' => $user->id])->with('user')->first();
        }

        $total_price = 0;
        foreach ($cart as $key => $value) {
            $total_price = $value->total_price + $total_price;
        }
        $cart_count = 0;
        if (!isset(\Auth::user()->id)) {
            $cart_count = ShopCart::where(['session_id' => $request->cookie('laravel_session'), 'status' => 'pending'])->count();;
        }
        return view('frontend.shop_cart.delievery_method', ['customer' => $customer, 'carts' => $cart, 'cart_count' => $cart_count, 'total_price' => $total_price, 'currentStep' => 1]);
    }

    public function customer_order_details($id)
    {
        $order = Order::where('id', $id)->with(['customer', 'order_products.product.category', 'product_commissions', 'delivery_method', 'payment_method'])->first();
        $total_price = OrderProduct::where('order_id', $id)->sum('total_price');
        // dd($order->toArray());
        return view('frontend.orders.order_details', ['order' => $order, 'total_price' => $total_price]);
    }

    public function get_terms_and_conditions($method, $id)
    {
        $method;
        if ($method == 'payment') {
            $method = PaymentMethod::findOrFail($id);
        } else {
            $method = Setup::findOrFail($id);
        }

        return ['method' => $method];
    }

    public function change_delivery_status(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'remarks' => 'required|string|max:255',
        ]);
        $id = $request->order_id;
        $order = Order::findOrFail($id);
        $customer = Customer::findOrFail($order->customer_id);
        $user = User::findOrFail($customer->user_id);
        if ($order) {
            $order->delivery_status = 'CONFIRMED';
            $order->order_status = 'COMPLETE';
            $order->delivery_remarks = $request->remarks;
            $order->delivery_status_updated_by = \Auth::user()->id;
            $order->delivery_status_updated_at = $request->updated_at;
            $order->save();
            // Notification::send($user, new OrderConfirmed);
            // Notification::send($user, new PaymentRecevied);
            return ['success' => 'Delivery STATUS UPDATED SUCCESSFULLY'];
        }
        return ['error' => 'NO ORDER FOUND'];
    }

    public function change_status(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'remarks' => 'required|string|max:255',
        ]);
        $id = $request->order_id;
        $order = Order::findOrFail($id);
        $customer = Customer::findOrFail($order->customer_id);
        $user = User::findOrFail($customer->user_id);
        if ($order) {
            $order->payment_status = 'PAID';
            $order->order_status = 'CONFIRMED';
            $order->payment_remarks = $request->remarks;
            $order->payment_status_updated_by = \Auth::user()->id;
            $order->payment_status_updated_at = $request->updated_at;
            $order->save();
            Notification::send($user, new OrderConfirmed);
            Notification::send($user, new PaymentRecevied);
            return ['success' => 'PAYMENT STATUS UPDATED SUCCESSFULLY'];
        }
        return ['error' => 'NO ORDER FOUND'];
    }
}
