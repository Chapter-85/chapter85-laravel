<?php

namespace App\Http\Controllers;

use App\Models\AuthorizedTradingRepresentative;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;

class CustomerTrading extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = AuthorizedTradingRepresentative::with('customer')->where('customer_id', $request->customer_id)->get();
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->make(true);
        // }

        $representatives = AuthorizedTradingRepresentative::with('customer')->where('customer_id', $request->customer_id)->latest()->get();
        $customer = Customer::find($request->customer_id);
        return view('frontend.profile.profile', ['representatives' => $representatives, 'customer' => $customer]);
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
            'signature' => 'required',
        ]);
        // dd($request->all());
        AuthorizedTradingRepresentative::create($request->all());
        return redirect(route('customer-profile-data.edit', $request->customer_id) . '?tab=trading')
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

    public function load_trading(Request $request)
    {
        $customer_id = $request->customer_id;
        $representatives = AuthorizedTradingRepresentative::with('customer')->where('customer_id', $request->customer_id)->latest()->get();
        return view('customers.trading_modal', ['customer_id' => $customer_id, 'representatives' => $representatives]);
    }
}
