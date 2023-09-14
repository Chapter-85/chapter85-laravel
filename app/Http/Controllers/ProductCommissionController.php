<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ProductCommission;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class ProductCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = ProductCommission::with(['product', 'customer', 'tier'])->latest();
            if (isset($request->date_range) && $request->date_range != '') {
                $dates = explode(" to ", $request->date_range);
                if (count($dates) > 1) {
                    $data = $data->whereDate('created_at', '>=', $dates[0])
                        ->whereDate('created_at', '<=', $dates[1]);
                } else {
                    $data = $data->whereDate('created_at', $dates[0]);
                }
            }
            if (isset($request->user_id)) {
                $data = $data->where('customer_id', $request->user_id);
            }
            $data = $data->get();
            // dd($data->toArray());
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tier_commission', function ($row) {
                    // dd($row->toArray());
                    return  'USD ' . $row->tier_commission;
                })
                ->addColumn('product_mark_up', function ($row) {
                    if (isset($row->product_mark_up)) {
                        if ($row->mark_up_type == 'flat') {
                            return  'USD ' . $row->product_mark_up;
                        } else {
                            // dd('hello');
                            $row->product_price = (int)$row->product_price;
                            $markup = ($row->product_price / 100) * $row->product_mark_up;
                            return  'USD ' . $markup;
                        }
                    } else {
                        return 'N / A';
                    }
                })
                ->addColumn('tier_commission_percentage', function ($row) {
                    if (isset($row->tier_commission_percentage)) {
                        return  $row->tier_commission_percentage . ' %';
                    } else {
                        return 'N / A';
                    }
                })
                ->addColumn('tier_type', function ($row) {
                    return str_replace('_', ' ', ucwords($row->tier_type));
                })
                ->make(true);
        }
        $users = Customer::all();
        // dd($users->toArray());
        return view('product_commission.index', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCommission  $productCommission
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCommission $productCommission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCommission  $productCommission
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCommission $productCommission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCommission  $productCommission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCommission $productCommission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCommission  $productCommission
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCommission $productCommission)
    {
        //
    }
}
