<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brands\StoreBrandRequest;
use App\Http\Requests\Admin\Brands\UpdateBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(20);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        $validatedData = $request->validated();

        Brand::create([
            'name' => $validatedData['name'],
            'is_active' => $validatedData['is_active'],
        ]);

        return back()->with('success', 'برند مورد نظر ایجاد شد');
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $validatedData = $request->validated();

        $brand->update([
            'name' => $validatedData['name'],
            'is_active' => $validatedData['is_active'],
        ]);

        return back()->with('success', 'برند مورد نظر ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
}
