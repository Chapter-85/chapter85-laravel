<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Manufacturer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use File;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Product::with('category')->latest('updated_at')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status_prd', function ($row) {

                    $today = Carbon::now()->format('Y-m-d');

                    if($row->status == 'active'){

                        if($row->valid_from == null || $row->valid_till == null){
                            return '<span class="badge bg-info">Active</span>';
                        }else{

                            if ($row->valid_from <=  $today && $row->valid_till >= $today) {
                                return '<span class="badge bg-info">Active</span>';
                            }else{
                                return '<span class="badge bg-danger">Expired</span>';
                            }
                        }

                    }else{
                        return '<span class="badge bg-danger">In Active</span>';
                    }

                })
                ->addColumn('validity', function ($row) {

                    if($row->valid_from != null && $row->valid_till != null){
                        return $row->valid_from->format('d M, Y') .' to '. $row->valid_till->format('d M, Y');
                    }

                    return 'N/A';
                    
                })
                ->addColumn('action', function ($row) {
                    return view('products.actions', ['row' => $row]);
                })
                ->rawColumns(['action', 'status_prd'])
                ->make(true);
        }
        $manufacturers = Manufacturer::all();
        $categories = Catergory::all();
        return view('products.products', ['categories' => $categories, 'manufacturers' => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = Manufacturer::all();
        $categories = Catergory::all();
        return view('products.add_new_product', ['categories' => $categories, 'manufacturers' => $manufacturers]);
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
            'sku' => 'required|string|max:255||unique:products,sku',
            'name' => 'required|string|max:255',
            'product_picture' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'pricing_type' => 'required|string|max:255',
            'surcharge_at_product' => 'required',
            'catergory_id' => 'required|integer',
            'manufacturer_id' => 'required|integer',
            'weight' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        // $valid_from = null;
        // $valid_to = null;

        // $validity = $request->input('validity', '');

        // if($validity !== ''){

        //     $validity = explode('to', $validity);

        //     if(count($validity) == 2){
        //         $valid_from = trim($validity[0]);
        //         $valid_to = trim($validity[1]);
        //     }else{
        //         $valid_from = trim($validity[0]);
        //         $valid_to = trim($validity[0]);
        //     }
        // }

        // $input['status'] = 'active';

        $file_name = time() . '.' . $request->product_picture->extension();
        $path = 'uploads/products';
        File::ensureDirectoryExists($path);

        $request->product_picture->move(public_path($path), $file_name);

        $input['product_picture'] = $file_name;
        Product::create($input);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product->getProductComission());
        $manufacturers = Manufacturer::all();
        $categories = Catergory::all();
        return view('products.edit_product', ['product' => $product, 'categories' => $categories, 'manufacturers' => $manufacturers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $request->validate([
            'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'pricing_type' => 'required|string|max:255',
            // 'mark_up' => 'required',
            // 'markup_type' => 'required',
            // 'surcharge_at_product' => 'required',
            'catergory_id' => 'required|integer',
            'manufacturer_id' => 'required|integer',
            'weight' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        // dd($input);

        if ($request->hasFile('product_picture')) {
            // dd($input);
            $file_name = time() . '.' . $request->product_picture->extension();
            $path = 'uploads/products';
            File::ensureDirectoryExists($path);

            $request->product_picture->move(public_path($path), $file_name);

            $input['product_picture'] = $file_name;
        }
        $product->update($input);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            return $product->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
