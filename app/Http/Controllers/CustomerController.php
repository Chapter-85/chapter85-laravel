<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Nationality;
use App\Models\User;
use App\Models\UserVerify;
use App\Notifications\AccountActivated;
use App\Notifications\VerificationCode as NotificationsVerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Customer::with('user')->latest()->get();
        // dd($data->toArray());
        if ($request->ajax()) {

            $data = Customer::with('user')->latest()->get();
            //dd($data->toArray());
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('customers.actions', ['row' => $row]);
                })
                ->addColumn('is_verified', function ($row) {
                    if ($row->user->is_verified == 0) {
                        return '<span class="badge bg-danger">In-Active</span>';
                    } else {
                        return '<span class="badge bg-info">Active</span>';
                    }
                })
                ->addColumn('email_verified', function ($row) {
                    if ($row->user->is_email_verified == 0) {
                        return '<span class="badge bg-danger">UnVerified</span>';
                    } else {
                        return '<span class="badge bg-info">Verified</span>';
                    }
                })
                ->addColumn('user_type', function ($row) {
                    return strtoupper($row->user->customer_type);
                })
                ->rawColumns(['action', 'is_verified', 'user_type', 'email_verified'])
                ->make(true);
        }
        $users = User::all();
        return view('customers.customers', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalities = Nationality::all();
        return view('customers.add_new_customer', ['nationalities' => $nationalities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->customer_type == 'individual') {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'customer_type' => ['required'],
                'gender' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'passport_no' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'address' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'passport_no' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'address' => 'required',
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
                'import' => 'required',
                // 'countries_of_import' => 'required',
                'business_address' => 'required',
                'hear_about_mg' => 'required|string|max:255',
                'sales_rep_name' => 'required|string|max:255',
                'sales_rep_number' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',
                'bank_country_name' => 'required|string|max:255',
                'bank_account_name' => 'required|string|max:255',
                'bank_account_number' => 'required|string|max:255',
                'bank_branch_number' => 'required|string|max:255',
                'bank_swift_code' => 'required|string|max:255',
            ]);
        }
        $input_user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'customer_type' => $request->customer_type,
        ];
        $referral_code = strtoupper(Str::random(6));
        $input_user['referral_code'] = $referral_code;
        if ($request->has('hear_about_mg')) {

            $agent = User::where('referred_by', $request->sales_rep_number)->first();


            if ($agent) {
                $input_user['referred_by'] = $request->sales_rep_number;
            } else {
                $input_user['referred_by'] = null;
            }
        }
        $user = User::create($input_user);
        // VerificationCode::send($user->email);
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['full_name'] = $request->name;
        Customer::create($input);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $user = User::find($customer->user_id);
        $nationalities = Nationality::all();
        return view('customers.edit_customer', ['customer' => $customer, 'user' => $user, 'nationalities' => $nationalities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if ($request->customer_type == 'individual') {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'passport_no' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'address' => 'required',
            ]);
        } else {
            $request->validate([
                'full_name' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'passport_no' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'address' => 'required',
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
                'import' => 'required',
                // 'countries_of_import' => 'required',
                'business_address' => 'required',
                'hear_about_mg' => 'required|string|max:255',
                'sales_rep_name' => 'required|string|max:255',
                'sales_rep_number' => 'required|string|max:255',
                'bank_name' => 'required|string|max:255',
                'bank_country_name' => 'required|string|max:255',
                'bank_account_name' => 'required|string|max:255',
                'bank_account_number' => 'required|string|max:255',
                'bank_branch_number' => 'required|string|max:255',
                'bank_swift_code' => 'required|string|max:255',
            ]);
        }
        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            return $customer->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    public function verify_user(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        // dd($user);
        if ($user) {
            if ($user->is_verified == 0) {
                $user->is_verified = 1;
                $user->save();
                Notification::send($user, new AccountActivated);
                return true;
            } else {
                $user->is_verified = 0;
                $user->save();
                return true;
            }
        }
        return false;
    }

    public function tier_hierarchy($id)
    {
        $customer = Customer::where('id', $id)->first();
        $users = User::where('id', $customer->user_id)->with('child')->get();
        // $allUsers = User::pluck('name', 'id')->all();
        return view('customers.tiers_details', ['users' => $users]);
    }

    public function show_referral_code(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        // dd($user);
        if ($user) {
            if ($user->show_referral_code == 0) {
                $user->show_referral_code = 1;
                $user->save();
                return true;
            } else {
                $user->show_referral_code = 0;
                $user->save();
                return true;
            }
        }
        return false;
    }

    public function send_verification_code(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        // dd($user->toArray());
        $token = Str::random(30);
        $user->notify(new NotificationsVerificationCode($token));

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        return true;
    }

    public function verify_email($code)
    {
        $user_code  = UserVerify::where('token', $code)->first();
        if ($user_code) {
            $user = User::findOrFail($user_code->user_id);
            $user->is_email_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
        return redirect(route('home'))->with('success', 'Your email is verified');
    }
}
