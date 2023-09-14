<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Setup;
use App\Models\ShopCart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $cart = ShopCart::where(['user_id' => $user->id, 'status' => 'pending'])->get();
        $created_at = ShopCart::where(['user_id' => $user->id, 'status' => 'pending'])->get();

        $total_price = 0;
        foreach ($cart as $key => $value) {
            $total_price = $value->total_price + $total_price;
        }
        $hkd_price = ExchangeRate::latest()->first();
        $delivery_methods = Setup::all();
        $payment_methods = PaymentMethod::all();
        $now = Carbon::now();
        // dd($now);
        return view('frontend.shop_cart.index', ['delivery_methods' => $delivery_methods, 'payment_methods' => $payment_methods, 'now' => $now, 'carts' => $cart, 'total_price' => $total_price, 'hkd_price' => $hkd_price->rate]);
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
            'user_id' => ['required'],
            'product_id' => ['required'],
            'spot_price' => ['required'],
            'quantity' => ['required'],
            // 'referral_code' => ['required', 'string', 'min:6', 'max:6'],
        ]);
        // dd($request->all());
        if (\Auth::user()->is_verified == 1) {
            $product = Product::find($request->product_id);
            $result = $product->productsInventory($request->quantity);
            if ($result != null) {
                $input = $request->all();
                $input['total_price'] = $request->quantity * $request->spot_price;
                ShopCart::create($input);

                return ['success' => 'Item Added to Cart Successfully', 'cart_count' => \Auth::user()->cart_count];
            }
            return ['error' => 'Product is not in stock'];
        }
        return ['error' => 'User is not verified'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopCart  $shopCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShopCart $shopCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopCart  $shopCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopCart $shopCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopCart  $shopCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopCart $shopCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopCart  $shopCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopCart $shopCart)
    {
        try {
            // dd($shopCart);
            return $shopCart->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    public function delete_shop_carts($id)
    {
        $user = User::findOrFail($id);
        ShopCart::where('user_id', $user->id)->delete();
        return ['success', 'Records deleted'];
    }
}
