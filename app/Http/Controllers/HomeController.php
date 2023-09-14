<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole(['admin'])) {
            $products = Product::with('category')->where('status', 'active')->where(function ($query) {
                $query->whereNull('valid_till')->orWhereDate('valid_till', '>=', Carbon::now()->format('Y-m-d'));
            });
            $products = $products->count();
            $orders = Order::count();
            $verified_customers = User::where('is_verified', 1)->count();
            $total_customers = User::count();

            return view('dashboard.dashboard', compact('products', 'orders', 'verified_customers', 'total_customers'));
        } else {
            return redirect()->route('home')
                ->with('success', 'Logged in successfully.');
        }
    }
}
