<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brands::all();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('brands.create', compact('category'));
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
            'handle_by' => 'required',
            'image_brand' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
        ]);

        $category = Category::findOrFail($request->category_id);
        $brand = new Brands($request->all());
        $brand->category_name = $category->name;
        if ($request->hasFile('image_brand')) {
            $file = $request->file('image_brand');
            $imageBase64 = base64_encode(file_get_contents($file->getRealPath()));
            $brand->image_brand = $imageBase64;
        }

        $brand->save();

        return redirect()->route('brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brand)
    {
        $imageSrc = 'data:image/jpeg;base64,' . $brand->image_brand;

        $brand->image_brand = $imageSrc;

        $category = Category::all();
        return view('brands.show', compact('brand','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brands $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sq_target' => 'nullable|numeric',
            'so_target' => 'nullable|numeric',
            'sales_target' => 'nullable|numeric',
            'group' => 'nullable|string|max:255',
            'handle_by' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand->fill($request->all());
        $category = Category::findOrFail($request->category_id);
        $brand->category_name = $category->name;
        if ($request->hasFile('image_brand')) {
            $file = $request->file('image_brand');
            $imageBase64 = base64_encode(file_get_contents($file->getRealPath()));
            $brand->image_brand = $imageBase64;
        }

        $brand->save();

        return redirect()->route('brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function updateTarget(Request $request, Brands $brand)
    {
        $request->validate([
            'sq_target' => 'nullable|numeric',
            'so_target' => 'nullable|numeric',
            'sales_target' => 'nullable|numeric'
        ]);

        $brand->fill($request->all());

        $brand->save();

        return redirect()->route('brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brands $brand)
    {
        if ($brand->image && file_exists(public_path('images') . '/' . $brand->image)) {
            unlink(public_path('images') . '/' . $brand->image);
        }

        if ($brand->brochure && file_exists(public_path('brochures') . '/' . $brand->brochure)) {
            unlink(public_path('brochures') . '/' . $brand->brochure);
        }

        $brand->delete();

        return redirect()->route('brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
