<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catergory;
use App\Models\Customer;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\CustomerShareholder;
use App\Models\AuthorizedTradingRepresentative;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductCommission;
use App\Models\UserVerify;
use App\Notifications\AccountVerified;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use NextApps\VerificationCode\VerificationCode;

class HomeController extends Controller
{
    public function index()
    {
        $_products = Product::with('category');
        $products = $_products->limit(3)->latest()->get();

        return view('frontend.home.index', [
            'products' => $products,
        ]);
    }

    public function shop(Request $request)
    {
        $_products = Product::with('category')->where(['status' => 'active']);

        if ($request->has('category')) {
            $_products = $_products->where(['catergory_id' => $request->category, 'status' => 'active']);
        }

        if ($request->get('sort') == 'desc') {
            $_products = $_products->get()->sortByDesc(function ($product) {
                return $product->product_price;
            });
        } elseif ($request->get('sort') == 'asc') {
            $_products = $_products->get()->sortBy(function ($product) {
                return $product->product_price;
            });
        } else {
            $_products = $_products->paginate(12);
        }

        // dd($_products->get());


        $products = $_products;

        $categories = Catergory::whereNull('parent_id')->with(['children'])->get();
        $manufacturers = Manufacturer::all();


        return view('frontend.products.index', [
            'products' => $products,
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'best_sellers' =>  Product::with('category')->limit(10)->latest()->get(),
            // 'results_count' => $_products->count(),
            // 'total_count' => Product::with('category')->count(),
        ]);
    }

    public function about_us()
    {
        return view('frontend.about_us.index');
    }

    public function services()
    {
        return view('frontend.services.index');
    }

    public function contact_us()
    {
        return view('frontend.contact_us.index');
    }

    public function login()
    {
        return view('frontend.login.login');
    }

    public function register()
    {
        return view('frontend.register.register');
    }

    public function login_customer(Request $request)
    {
        $request->validate([
            'login_email' => ['required', 'string', 'email', 'max:255'],
            'login_password' => ['required', 'string', 'min:8'],
        ]);

        $email = $request->login_email;
        $password = $request->login_password;

        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('login_email', 'The auth credentials are not matched');
            throw new ValidationException($validator);
            // return response()->json(['success' => false, 'message' => 'Login Fail, please check email id']);
        }
        if (!Hash::check($password, $user->password)) {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('login_email', 'The auth credentials are not matched');
            throw new ValidationException($validator);
            // return response()->json(['success' => false, 'message' => 'Login Fail, pls check password']);
        }
        auth()->login($user);
        if (isset($request->url)) {
            return redirect($request->url)->with('success', 'Logged in successfully');
        }
        return redirect(route('home'))->with('success', 'User Logged in Successfully');
    }

    public function register_account(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'customer_type' => ['required']
        ]);


        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'customer_type' => 'individual',
        ];

        $referral_code = strtoupper(Str::random(6));
        $input['referral_code'] = $referral_code;
        if ($request->has('referred_by')) {

            $agent = User::where('referral_code', $request->referred_by)->first();


            if ($agent) {
                $input['referred_by'] = $request->referred_by;
            } else {
                $input['referred_by'] = null;
            }
        }

        $user = User::create($input);
        Customer::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'gender' => '',
            'occupation' => '',
            'passport_no' => '',
            'country_code' => $request->country_code,
            'phone_number' => $request->phone_number,
            'nationality' => '',
            'address' => $request->address,
        ]);
        VerificationCode::send($user->email);
        auth()->login($user);
        return redirect(route('verify-code-view'));
    }

    public function verify_code(Request $request)
    {
        $user = \Auth::user();
        //dd($user);
        // dd($request->all());
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'code' => ['required', 'string', 'min:4', 'max:4'],
        ]);
        $user = User::where(['email' => $request->email])->first();
        $verified = VerificationCode::verify($request->code, $request->email);

        if ($verified == true) {
            $user->is_email_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            Notification::send($user, new AccountVerified);
            auth()->login($user);
            return redirect(route('customer_profile'))
                ->with('success', 'Account created successfully.');
        }

        return redirect(route('verify-code-view', ['email' => $request->email]))->with('error', 'Verification Failed');
    }

    public function verifyCode()
    {
        $user = \Auth::user();

        return view('frontend.verify_email.verify_email', ['email' => $user->email]);
    }

    public function profile()
    {
        $user = \Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();


        if ($customer == null) {
            $customer = Customer::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'gender' => '',
                'occupation' => '',
                'passport_no' => '',
                'phone_number' => '',
                'nationality' => '',
                'address' => '',
            ]);
        }

        $shareholders = CustomerShareholder::with('customer')->where('customer_id', $customer->id)->latest()->get();
        $representatives = AuthorizedTradingRepresentative::with('customer')->where('customer_id', $customer->id)->latest()->get();
        $nationalities = Nationality::all();

        return view('frontend.profile.profile', ['shareholders' => $shareholders, 'representatives' => $representatives, 'customer' => $customer, 'nationalities' => $nationalities]);
    }

    public function switch_language($locale)
    {
        // echo($locale);
        if (!in_array($locale, ['en', 'ch', 'ch_simple'])) {
            abort(400);
        }

        App::setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }

    public function single_product($id)
    {
        $product = Product::where(['id' => $id])->with(['category', 'manufacturer'])->first();
        // dd($product->toArray());
        return view('frontend.single_product.index', compact('product'));
    }

    public function applicant_information_individual(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|unique:customers',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'passport_no' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'address' => 'required',
        ]);

        $customer = Customer::create($request->all());
        return redirect(route('customer_profile' . '?tab=corporate', compact('customer')))
            ->with('success', 'Account created successfully.');
    }

    public function applicant_information_corporate(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'business_name' => 'required|string|max:255',
            'type_of_organization' => 'required|string|max:255',
            'business_phone_num' => 'required|string|max:255',
            'business_fax' => 'required|string|max:255',
            'business_email' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'type_of_business' => 'required|string|max:255',
            'business_reg_num' => 'required|string|max:255',
            'country_of_incorporation' => 'required|string|max:255',
            'years_in_business' => 'required|string|max:255',
            'import' => 'required|boolean',
            'countries_of_import' => 'required|boolean',
            'business_address' => 'required',
        ]);

        $customer = Customer::find($request->customer_id);
        $customer->update($request->all());
        return view('frontend.profile.profile', compact('customer'));
    }

    public function customer_orders()
    {
        $user = \Auth::user();
        $total_price = 0;
        $order_quantity = 0;
        $customer = Customer::where('user_id', $user->id)->first();
        if ($customer) {
            $orders = Order::where('customer_id', $customer->id)->with(['order_products.product'])->latest()->get();
            foreach ($orders as $key => $order) {
                $order_price = OrderProduct::where('order_id', $order->id)->sum('total_price');
                $order_quantity = OrderProduct::where('order_id', $order->id)->sum('quantity');
                $order['total_price'] = $order_price;
                $order['quantity'] = $order_quantity;
            }
            return view('frontend.orders.index', ['orders' => $orders, 'total_price' => $total_price]);
        }
        return view('frontend.orders.index');
    }

    public function customer_referrals()
    {
        $user = \Auth::user();
        $referrals = [];
        if ($user->referral_code != null) {
            $referrals = User::with('customer')->where('referred_by', $user->referral_code)->latest()->get();
        }
        // dd($referrals->toArray());
        return view('frontend.my_referrals.index', ['referrals' => $referrals]);
    }

    public function customer_commissions()
    {
        $user = \Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
        if ($customer) {
            $commissions = ProductCommission::where('tier_id', $user->id)->with(['product'])->get();
            // dd($commissions->toArray());
            return view('frontend.customer_commissions.index', ['commissions' => $commissions]);
        }
        return view('frontend.customer_commissions.index');
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }

    public function ez_gold()
    {
        return view('frontend.ez_gold.index');
    }

    public function mg_pay()
    {
        return view('frontend.mg_pay.header');
    }
}
