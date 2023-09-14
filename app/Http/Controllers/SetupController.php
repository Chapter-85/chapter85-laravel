<?php

namespace App\Http\Controllers;

use App\Models\Setup;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Setup::latest()->get();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('setup.action', ['row' => $row]);
                })
                ->rawColumns(['action', 'description'])
                ->make(true);
        }
        return view('setup.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.add_new');
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
            'delivery_method' => 'required|string',
        ]);

        Setup::create($request->all());
        return redirect()->route('setup.index')
            ->with('success', 'Setup created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function show(Setup $setup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function edit(Setup $setup)
    {
        return view('setup.edit', ['setup' => $setup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setup $setup)
    {
        // dd($request->all());
        $request->validate([
            'delivery_method' => 'required|string',
        ]);

        $setup->update($request->all());

        return redirect()->route('setup.index')
            ->with('success', 'Setup updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setup  $setup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setup $setup)
    {
        try {
            return $setup->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
