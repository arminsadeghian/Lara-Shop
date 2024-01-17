<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryController;
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

    public function create(Category $category)
    {
        $parentCategories = $category->getParentCategories();
        $attributes = Attribute::all();

        return view('admin.categories.create', compact('parentCategories', 'attributes'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            // Store category in database
            $category = Category::create([
                'parent_id' => $validatedData['parent_id'],
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
                'icon' => $validatedData['icon'],
            ]);

            // Store category attributes in database
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

    public function show(Category $category)
    {
        $attributes = Attribute::all();
        return view('admin.categories.show', compact('category', 'attributes'));
    }

    public function edit(Category $category)
    {
        $parentCategories = $category->getParentCategories();
        $attributes = Attribute::all();

        return view('admin.categories.edit', compact('category', 'parentCategories', 'attributes'));
    }

    public function update(UpdateCategoryController $request, Category $category)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            // Update category in database
            $category->update([
                'parent_id' => $validatedData['parent_id'],
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
                'icon' => $validatedData['icon'],
            ]);

            // Delete all category attributes from database
            $category->attributes()->detach();

            // Create category attributes
            foreach ($validatedData['attribute_ids'] as $attributeId) {
                $attribute = Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $validatedData['attribute_is_filter_ids']) ? 1 : 0,
                    'is_variation' => $validatedData['variation_id'] == $attributeId ? 1 : 0
                ]);
            }

            DB::commit();
            return back()->with('success', 'دسته بندی ویرایش شد');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('failed', 'دسته بندی ویرایش نشد');
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
