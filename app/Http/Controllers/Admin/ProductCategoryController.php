<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\UpdateProductCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    // Get category attributes & variation for show in edit product category page
    public function getCategoryAttributes(Category $category)
    {
        $attributes = $category->getCategoryAttributes();
        $variation = $category->getCategoryVariation();

        return [
            'attributes' => $attributes,
            'variation' => $variation,
        ];
    }

    public function editCategory(Product $product, Category $category)
    {
        $categories = $category->getAllCategoriesWithoutParents();
        return view('admin.products.edit_category', compact('product', 'categories'));
    }

    public function updateCategory(UpdateProductCategoryRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $product->update([
                'category_id' => $validatedData['category_id'],
            ]);

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->change($validatedData['attribute_ids'], $product);

            $category = Category::find($validatedData['category_id']);
            $productVariationController = new ProductVariationController();
            $productVariationController->change(
                $validatedData['variation_values'],
                $category->attributes()->wherePivot('is_variation', 1)->first()->id,
                $product
            );

            DB::commit();

            return back()->with('success', 'دسته بندی مورد نظر ویرایش شد');
        } catch (\Exception $e) {
            return back()->with('failed', 'مشکلی در ویرایش دسته بندی به وجود آمده، لطفا دوباره تلاش کنید!');
        }
    }
}
