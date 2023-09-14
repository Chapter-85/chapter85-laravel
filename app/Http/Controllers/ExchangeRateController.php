<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;

class ExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = ExchangeRate::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('exchange_rates.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('exchange_rates.index');
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
            'from_currency' => 'required|string|max:255',
            'to_currency' => 'required|string|max:255',
            'rate' => 'required',
        ]);

        ExchangeRate::create($request->all());

        return redirect()->route('exchange-rate.index')
            ->with('success', 'Exchange Rate created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ExchangeRate $exchangeRate)
    {
        return view('exchange_rates.index', ['exchangeRate' => $exchangeRate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExchangeRate $exchangeRate)
    {
        $request->validate([
            'from_currency' => 'required|string|max:255',
            'to_currency' => 'required|string|max:255',
            'rate' => 'required',
        ]);


        $exchangeRate->update($request->all());

        return redirect()->route('exchange-rate.index')
            ->with('success', 'Exchange Rate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeRate $exchangeRate)
    {
        try {
            return $exchangeRate->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
