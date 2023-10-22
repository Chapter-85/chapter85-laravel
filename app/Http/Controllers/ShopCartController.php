<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Setup;
use App\Models\ShopCart;
use App\Models\User;
use App\Models\Customer;
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
    public function index(Request $request)
    {
        $user = \Auth::user();
        if (!isset($user)) {
            $cart = ShopCart::where(['session_id' => $request->cookie('laravel_session'), 'status' => 'pending'])->get();
        } else {
            $cart = ShopCart::where(['user_id' => $user->id, 'status' => 'pending'])->get();
        }

        $total_price = 0;
        foreach ($cart as $key => $value) {
            $total_price = $value->total_price + $total_price;
        }
        $cart_count = 0;
        if (!isset(\Auth::user()->id)) {
            $cart_count = ShopCart::where(['session_id' => $request->cookie('laravel_session'), 'status' => 'pending'])->count();;
        }
        // dd($now);
        return view('frontend.shop_cart.index', ['carts' => $cart, 'total_price' => $total_price, 'cart_count' => $cart_count]);
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
            'product_id' => ['required'],
            'product_size_id' => ['required'],
            'spot_price' => ['required'],
            'quantity' => ['required'],
        ]);
        $product = Product::find($request->product_id);
        $result = $product->productsInventory($request->quantity);
        if ($result != null) {
            $input = $request->all();
            $input['total_price'] = $request->quantity * $request->spot_price;
            if (!isset($request->user_id)) {
                $input['session_id'] = $request->cookie('laravel_session');
                // $shoppingCart = ShopCart::where(['session_id' => $input['session_id'], 'status' => 'pending'])->first();
                // if (!$shoppingCart) {
                ShopCart::create($input);
                // } else {
                // $shoppingCart->quantity = $shoppingCart->quantity + $request->quantity;
                // $shoppingCart->total_price = $shoppingCart->quantity * $request->spot_price;
                // $shoppingCart->save();
                // }
                $shoppingCartItems = ShopCart::where(['session_id' => $input['session_id'], 'status' => 'pending'])->count();
                return ['success' => 'Item Added to Cart Successfully', 'cart_count' => $shoppingCartItems];
            } else {
                // $shoppingCart = ShopCart::where(['user_id' => $input['session_id'], 'status' => 'pending'])->first();
                // if (!$shoppingCart) {
                $input['user_id'] = \Auth::user()->id;
                ShopCart::create($input);
                // } else {
                //     $shoppingCart->quantity = $shoppingCart->quantity + $request->quantity;
                //     $shoppingCart->total_price = $shoppingCart->quantity * $request->spot_price;
                //     $shoppingCart->save();
                // }
                // ShopCart::create($input);
                return ['success' => 'Item Added to Cart Successfully', 'cart_count' => \Auth::user()->cart_count];
            }
        }
        return ['error' => 'Product is not in stock'];
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
