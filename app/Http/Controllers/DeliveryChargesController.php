<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\DeliveryCharges;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use DataTables;

class DeliveryChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DeliveryCharges::with('category')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('parent_id', function ($row) {
                //     if ($row->parent_id != null)
                //         return $row->parent_id;
                //     else
                //         return 'N / A';
                // })
                ->addColumn('action', function ($row) {
                    return view('delivery_charges.action', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $categories = Catergory::all();
        return view('delivery_charges.index', ['categories' => $categories]);
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
            'delivery_method' => 'required|string|max:255',
            'category_id' => 'required|integer|max:255',
            'amount' => 'required',
            'time_duration' => 'required|string|max:255',
            'grace_period' => 'required|string|max:255',
            'charge_at_beginning' => 'required'
        ]);

        DeliveryCharges::create($request->all());
        return redirect()->route('delivery-charges.index')
            ->with('success', 'Delivery Charge created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryCharges  $deliveryCharges
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCharges $deliveryCharges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryCharges  $deliveryCharges
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Catergory::all();
        $delivery_charge = DeliveryCharges::findOrfail($id);
        return view('delivery_charges.index', ['categories' => $categories, 'deliveryCharges' => $delivery_charge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryCharges  $deliveryCharges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $deliveryCharges)
    {
        // dd($deliveryCharges);
        $delivery_charge = DeliveryCharges::findOrfail($deliveryCharges);
        $request->validate([
            'delivery_method' => 'required|string|max:255',
            'category_id' => 'required|integer|max:255',
            'amount' => 'required',
            'time_duration' => 'required|string|max:255',
            'grace_period' => 'required|string|max:255',
            'charge_at_beginning' => 'required'
        ]);

        $delivery_charge->update($request->all());

        return redirect()->route('delivery-charges.index')
            ->with('success', 'Delivery Charge updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryCharges  $deliveryCharges
     * @return \Illuminate\Http\Response
     */
    public function destroy($deliveryCharges)
    {
        $delivery_charge = DeliveryCharges::findOrfail($deliveryCharges);
        try {
            return $delivery_charge->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
