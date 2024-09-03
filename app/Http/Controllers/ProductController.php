<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Products::query();
        if ($search) {
            $query->where('name', 'like', "%$search%")
            ->orWhere('category','like',"%$search%")
            ->orWhere('status','like',"%$search%")
            ->orWhere('brand_name','like',"%$search%");
        }
        $products = $query->paginate(10);
        $brands = Brands::all();

        return view('products.index', compact('products', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brands::all();

        return view('products.create', compact('brands'));
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
            'attachment' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
        ]);
        $userid = Auth::user()->id;
        $product = new Products($request->all());

        if ($request->brand_id) {
            $brand = Brands::findOrFail($request->brand_id);
            $product->brand_name = $brand->name;
        }

        if ($request->attachment) {
            $customPath = 'uploads/files/';

            $fileName = $userid . '_attactment_' . time() . '.' . $request->attachment->extension();
            $file = $request->file('attachment');
            $file->move(public_path($customPath), $fileName);
            $product->attachment = $fileName;
        }
        // dd($product);
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Products created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        $brands = Brands::all();
        return view('products.show', compact('product', 'brands'));
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
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required',
            'attachment' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120',
        ]);
        $userid = Auth::user()->id;
        $product->fill($request->all());

        if ($request->brand_id) {
            $brand = Brands::findOrFail($request->brand_id);
            $product->brand_name = $brand->name;
        }

        if ($request->attachment != null) {
            if ($request->attachment != $product->attachment) {

                $customPath = 'uploads/files/';

                $fileName = $userid . '_attactment_' . time() . '.' . $request->attachment->extension();
                $file = $request->file('attachment');
                $file->move(public_path($customPath), $fileName);
                $product->attachment = $fileName;
            }
        }
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Products updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $customPath = 'uploads/files/';
        if ($product->attachment && file_exists(public_path($customPath) . '/' . $product->attachment)) {
            unlink(public_path($customPath) . '/' . $product->attachment);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Products deleted successfully.');
    }
}
