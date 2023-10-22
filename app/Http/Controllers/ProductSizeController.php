<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSizes;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductSizes::latest()->with('product')->get();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('product_sizes.action', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $products = Product::all();
        return view('product_sizes.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_sizes.add_new');
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
            'product_id' => 'required',
        ]);

        ProductSizes::create($request->all());
        return redirect()->route('product-sizes.index')
            ->with('success', 'Product Size created successfully.');
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
     * @param  \App\Models\ProductSizes  $product_sizes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_sizes = ProductSizes::find($id)->with('product')->first();
        $products = Product::all();
        return view('product_sizes.index', ['product_sizes' => $product_sizes, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSizes  $product_sizes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSizes $product_sizes)
    {
        $request->validate([
            'product_size' => 'required',
        ]);

        $product_sizes->update($request->all());

        return redirect()->route('setup.index')
            ->with('success', 'Setup updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSizes  $product_sizes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSizes $product_sizes)
    {
        try {
            return $product_sizes->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
