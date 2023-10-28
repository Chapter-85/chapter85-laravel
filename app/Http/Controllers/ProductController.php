<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductPictures;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

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

            $data = Product::with('category')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status_prd', function ($row) {

                    $today = Carbon::now()->format('Y-m-d');

                    if ($row->status == 'active') {

                        if ($row->valid_from == null || $row->valid_till == null) {
                            return '<span class="badge bg-info">Active</span>';
                        } else {

                            if ($row->valid_from <=  $today && $row->valid_till >= $today) {
                                return '<span class="badge bg-info">Active</span>';
                            } else {
                                return '<span class="badge bg-danger">Expired</span>';
                            }
                        }
                    } else {
                        return '<span class="badge bg-danger">In Active</span>';
                    }
                })
                ->addColumn('validity', function ($row) {

                    if ($row->valid_from != null && $row->valid_till != null) {
                        return $row->valid_from->format('d M, Y') . ' to ' . $row->valid_till->format('d M, Y');
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
        // dd($request->all());
        $request->validate([
            'sku' => 'required|string|max:255||unique:products,sku',
            'name' => 'required|string|max:255',
            'product_picture.*' => 'required|file|mimes:jpg,jpeg,png',
            'pricing_type' => 'required|string|max:255',
            'catergory_id' => 'required|integer',
            'description' => 'required'
        ]);

        $input = $request->all();
        $product = Product::create($input);
        if ($request->has('product_picture')) {
            // dd('here');
            $path = 'uploads/products';
            File::ensureDirectoryExists($path);

            foreach ($request->file('product_picture') as $key => $image) {
                $file_name = time() . $key . '.' . $image->extension();
                $image->move(public_path($path), $file_name);
                ProductPictures::create([
                    'product_id' => $product->id,
                    'image' => $file_name
                ]);
                // $product->product_images()->create(['image' => $file_name]);
            }
        }


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
        $prod = Product::where('id', $product->id)->with('product_images')->first();
        // dd($prod->toArray());
        return view('products.edit_product', ['product' => $prod, 'categories' => $categories, 'manufacturers' => $manufacturers]);
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
            'catergory_id' => 'required|integer',
            'description' => 'required'
        ]);

        $input = $request->all();
        // dd($input);

        if ($request->has('product_picture')) {
            $path = 'uploads/products';
            File::ensureDirectoryExists($path);

            foreach ($product->product_images as $image) {
                Storage::delete($path . $image->file_name);
                $image->delete();
            }

            foreach ($request->file('product_picture') as $key => $image) {
                $file_name = time() . $key . '.' . $image->extension();
                $image->move(public_path($path), $file_name);
                ProductPictures::create([
                    'product_id' => $product->id,
                    'image' => $file_name
                ]);
                // $product->product_images()->create(['image' => $file_name]);
            }
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
