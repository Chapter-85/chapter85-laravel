<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerShareholder as ModelsCustomerShareholder;
use Illuminate\Http\Request;
use DataTables;

class CustomerShareholder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = ModelsCustomerShareholder::with('customer')->where('customer_id', $request->customer_id)->get();
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->make(true);
        // }

        $customer = Customer::find($request->customer_id);
        $shareholders = ModelsCustomerShareholder::with('customer')->where('customer_id', $request->customer_id)->get();

        return view('frontend.profile.profile', ['customer' => $customer, 'shareholders' => $shareholders]);
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
            'name' => 'required',
            'customer_id' => 'required',
            'title' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'passport_no' => 'required',
            'nationality' => 'required',
            'address' => 'required'
        ]);
        // dd($request->all());
        ModelsCustomerShareholder::create($request->all());

        return redirect(route('customer-profile-data.edit', $request->customer_id) . '?tab=shareholder')
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
        //
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
        //
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

    public function load_shareholders(Request $request)
    {
        $customer_id = $request->customer_id;
        $shareholders = ModelsCustomerShareholder::with('customer')->where('customer_id', $request->customer_id)->latest()->get();
        return view('customers.shareholders_modal', ['customer_id' => $customer_id, 'shareholders' => $shareholders]);
    }
}
