<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attributes\StoreAttributeRequest;
use App\Http\Requests\Admin\Attributes\UpdateAttributeRequest;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->paginate(20);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(StoreAttributeRequest $request)
    {
        $request->validated();

        Attribute::create($request->all());

        return back()->with('success', 'ویژگی مورد نظر ایجاد شد');
    }

    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show', compact('attribute'));
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $request->validated();

        $attribute->update($request->all());

        return back()->with('success', 'ویژگی مورد نظر ویرایش شد');
    }

    public function destroy(string $id)
    {
        //
    }
}
