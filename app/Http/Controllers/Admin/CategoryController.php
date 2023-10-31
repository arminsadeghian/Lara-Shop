<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();

        return view('admin.categories.create', compact('parentCategories', 'attributes'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $category = Category::create([
                'parent_id' => $validatedData['parent_id'],
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
                'icon' => $validatedData['icon'],
            ]);

            foreach ($validatedData['attribute_ids'] as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $validatedData['attribute_is_filter_ids']) ? 1 : 0,
                    'is_variation' => $validatedData['variation_id'] == $attributeId ? 1 : 0
                ]);
            }

            DB::commit();
            return back()->with('success', 'دسته بندی ایجاد شد');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('failed', 'دسته بندی ایجاد نشد');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
