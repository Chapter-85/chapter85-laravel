<?php

namespace App\Http\Controllers;

use App\Models\WalkInCustomer;
use Illuminate\Http\Request;

class WalkInCustomerController extends Controller
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
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'address' => ['required']
        ]);
        $input = $request->all();
        $input['session_id'] = $request->cookie('laravel_session');
        WalkInCustomer::create($request->all());
        return ['url' => route('order-delivery-details')];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WalkInCustomer  $walkInCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(WalkInCustomer $walkInCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WalkInCustomer  $walkInCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(WalkInCustomer $walkInCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WalkInCustomer  $walkInCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WalkInCustomer $walkInCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WalkInCustomer  $walkInCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalkInCustomer $walkInCustomer)
    {
        //
    }
}
