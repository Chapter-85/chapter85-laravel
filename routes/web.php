<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CatergoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\CustomerShareholder;
use App\Http\Controllers\CustomerTrading;
use App\Http\Controllers\DeliveryChargesController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\HomeController as HomeCtrl;
use App\Http\Controllers\FrontendCustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCommissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ShopCartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return view('auth.login');
    }
})->name('index');



Route::get('/', [HomeCtrl::class, 'index']);
Route::get('/home', [HomeCtrl::class, 'index'])->name('home');

Route::get('/shop', [HomeCtrl::class, 'shop'])->name('shop');
Route::get('/about-us', [HomeCtrl::class, 'about_us'])->name('about_us');
Route::get('/services', [HomeCtrl::class, 'services'])->name('services');
Route::get('/contact-us', [HomeCtrl::class, 'contact_us'])->name('contact_us');
Route::get('/single-product/{id}', [HomeCtrl::class, 'single_product'])->name('single-product');
Route::get('/customer-login', [HomeCtrl::class, 'login'])->name('customer_login');
Route::get('/customer-register', [HomeCtrl::class, 'register'])->name('customer_register');
Route::post('/login-customer', [HomeCtrl::class, 'login_customer'])->name('login-customer');
Route::post('verify-code', [HomeCtrl::class, 'verify_code'])->name('verify-code');
Route::get('verify-code-view', [HomeCtrl::class, 'verifyCode'])->name('verify-code-view');
Route::post('/customer-register-account', [HomeCtrl::class, 'register_account'])->name('customer-register-account');
Route::get('/language/{locale}', [HomeCtrl::class, 'switch_language'])->name('language');
Route::get('account/verify/{token}', [HomeCtrl::class, 'verifyAccount'])->name('user.verify');
Route::get('/ez-gold', [HomeCtrl::class, 'ez_gold'])->name('ez-gold');
Route::get('/mg-pay', [HomeCtrl::class, 'mg_pay'])->name('mg-pay');
Route::get('verify-email/{code}', [CustomerController::class, 'verify_email'])->name('verify-email');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resources(['/customers' => CustomerController::class]);
    Route::resources(['agents' => AgentController::class]);
    Route::resources(['categories' => CatergoryController::class]);
    Route::resources(['products' => ProductController::class]);
    Route::resources(['customer-products' => CustomerProductController::class]);
    Route::resources(['manufacturers' => ManufacturerController::class]);
    Route::resources(['customer-profile-data' => FrontendCustomerController::class]);
    Route::resources(['customer-shareholders' => CustomerShareholder::class]);
    Route::resources(['customer-trading' => CustomerTrading::class]);
    Route::resources(['product-commission' => ProductCommissionController::class]);
    Route::resources(['orders' => OrderController::class]);
    Route::resources(['inventories' => InventoryController::class]);
    Route::resources(['shop-cart' => ShopCartController::class]);
    Route::resources(['delivery-charges' => DeliveryChargesController::class]);
    Route::resources(['exchange-rate' => ExchangeRateController::class]);
    Route::resources(['setup' => SetupController::class]);
    Route::resources(['payment-methods' => PaymentMethodController::class]);
    Route::resources(['nationalities' => NationalityController::class]);
    Route::get('verify-user', [CustomerController::class, 'verify_user'])->name('verify-user');
    Route::get('show-referral-code', [CustomerController::class, 'show_referral_code'])->name('show-referral-code');

    Route::get('customer-orders', [HomeCtrl::class, 'customer_orders'])->name('customer-orders');
    Route::get('customer-referrals', [HomeCtrl::class, 'customer_referrals'])->name('customer-referrals');
    Route::get('customer-commissions', [HomeCtrl::class, 'customer_commissions'])->name('customer-commissions');
    Route::get('customer-product/{id}', [CustomerProductController::class, 'customer_products'])->name('customer-product');
    Route::get('customer-product-ajax/{id}', [CustomerProductController::class, 'customer_products_ajax'])->name('customer-product-ajax');
    Route::get('tier-hierarchy/{id}', [CustomerController::class, 'tier_hierarchy'])->name('tier-hierarchy');
    Route::get('load-shareholders', [CustomerShareholder::class, 'load_shareholders'])->name('load-shareholders');
    Route::get('load-trading', [CustomerTrading::class, 'load_trading'])->name('load-trading');
    Route::get('load-single-product-logs/{id}', [InventoryController::class, 'load_single_product_logs'])->name('load-single-product-logs');
    Route::get('/order-details/{id}', [OrderController::class, 'order_details'])->name('order-details');
    Route::get('/order-delivery-details/{id}', [OrderController::class, 'order_delivery_details'])->name('order-delivery-details');

    Route::post('/applicant-info-individual', [HomeCtrl::class, 'applicant_information_individual'])->name('applicant-info-individual');
    Route::post('/applicant-info-corporate', [HomeCtrl::class, 'applicant_information_corporate'])->name('applicant-info-corporate');
    Route::get('/customer-profile', [HomeCtrl::class, 'profile'])->name('customer_profile');

    Route::resources(['roles' => RoleController::class]);
    Route::resources(['permissions' => PermissionController::class]);
    Route::resources(['staffs' => UserController::class]);
    Route::get('/staff-profile/{id}', [UserController::class, 'edit'])->name('staff-profile');
    Route::get('/roles-permission-assignment-list', [UserController::class, 'userRolesPermissionList'])->name('roles-permission-assignment-list');
    Route::get('edit-with-role-permissions/{id}', [UserController::class, 'editUserRolesPermissions'])->name('edit-with-role-permissions');
    Route::post('assign-role-permissions/{id}', [UserController::class, 'updateUserRolesPermissions'])->name('assign-role-permissions');
    Route::get('get-terms-and-condition/{method}/{id}', [OrderController::class, 'get_terms_and_conditions'])->name('get-terms-and-condition');
    Route::get('get-customer-order-details/{id}', [OrderController::class, 'customer_order_details'])->name('get-customer-order-details');
    Route::get('remove-shop-cart/{id}', [ShopCartController::class, 'delete_shop_carts'])->name('remove-shop-cart');
    Route::post('change-payment-state', [OrderController::class, 'change_status'])->name('change-payment-state');
    Route::post('change-delivery-state', [OrderController::class, 'change_delivery_status'])->name('change-delivery-state');
    Route::get('verification-email', [CustomerController::class, 'send_verification_code'])->name('verification-email');
});
