<?php

namespace App\Http\Controllers;

use App\Models\Catergory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\QueryException;
use File;

class CatergoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Catergory::whereNull('parent_id')->get();
        if ($request->ajax()) {

            $data = Catergory::latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('categories.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('categories.categories', ['categories' => $categories]);
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
            'name' => 'required|string|max:255',
            'picture' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ]);
        $input = $request->all();

        $file_name = time() . '.' . $request->picture->extension();
        $path = 'uploads/categories';
        File::ensureDirectoryExists($path);

        // dd(public_path($path),$file_name);
        $request->picture->move(public_path($path), $file_name);

        $input['picture'] = $file_name;
        Catergory::create($input);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catergory  $catergory
     * @return \Illuminate\Http\Response
     */
    public function show(Catergory $catergory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catergory  $catergory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catergory $category)
    {
        $categories = Catergory::whereNull('parent_id')->get();
        return view('categories.categories', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catergory  $catergory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catergory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $input = $request->all();
        // dd($input);

        if ($request->hasFile('picture')) {
            // dd($input);
            $file_name = time() . '.' . $request->picture->extension();
            $path = 'uploads/categories';
            File::ensureDirectoryExists($path);

            $request->picture->move(public_path($path), $file_name);

            $input['picture'] = $file_name;
        }

        $category->update($input);

        return redirect()->route('categories.index')
            ->with('success', 'Catergory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catergory  $catergory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catergory $category)
    {
        try {
            return $category->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
