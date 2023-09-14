<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerShareholder;
use App\Models\AuthorizedTradingRepresentative;
use App\Models\Nationality;
use Illuminate\Http\Request;

class FrontendCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return redirect(route('customer-profile-data.edit', $customer->id) . '?tab=corporate')
            ->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $shareholders = CustomerShareholder::with('customer')->where('customer_id', $customer->id)->latest()->get();
        $representatives = AuthorizedTradingRepresentative::with('customer')->where('customer_id', $customer->id)->latest()->get();
        $nationalities = Nationality::all();
        return view('frontend.profile.profile', ['shareholders' => $shareholders, 'representatives' => $representatives, 'customer' => $customer, 'nationalities' => $nationalities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if ($request->form_info == 'individual') {
            $request->validate([
                // 'user_id' => 'required|unique:customers',
                'full_name' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'passport_no' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
                'nationality' => 'required|string|max:255',
                'address' => 'required',
            ]);

            $customer->update($request->all());
            $user = \Auth::user();
            if ($user->customer_type == 'corporate') {
                return redirect(route('customer-profile-data.edit', $customer->id) . '?tab=corporate')
                    ->with('success', 'Account created successfully.');
            } else {
                // dd($request->all());
                return redirect(route('home'))
                    ->with('success', 'Account created successfully.');
            }
        }
        if ($request->form_info == 'corporate') {
            $request->validate([
                // 'customer_id' => 'required',
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
            ]);

            // dd($request->all());
            $customer->update($request->all());
            return  redirect(route('customer-profile-data.edit', $customer->id) . '?tab=shareholder')
                ->with('success', 'Account created successfully.');
        }
        if ($request->form_info == 'other_info') {
            $request->validate([
                // 'customer_id' => 'required',
                'hear_about_mg' => 'required|string|max:255',
                'sales_rep_name' => 'required|string|max:255',
                'sales_rep_number' => 'required|string|max:255',
            ]);

            // dd($request->all());
            $customer->update($request->all());
            return  redirect(route('customer-profile-data.edit', $customer->id) . '?tab=bank_info')
                ->with('success', 'Account created successfully.');
        }
        if ($request->form_info == 'bank_info') {
            $request->validate([
                // 'customer_id' => 'required',
                'bank_name' => 'required|string|max:255',
                'bank_country_name' => 'required|string|max:255',
                'bank_account_name' => 'required|string|max:255',
                'bank_account_number' => 'required|string|max:255',
                'bank_branch_number' => 'required|string|max:255',
                'bank_swift_code' => 'required|string|max:255',
            ]);

            // dd($request->all());
            $customer->update($request->all());
            return  redirect(route('home'))
                ->with('success', 'Account created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
