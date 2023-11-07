<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductCategoryRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();

        return view('admin.products.create', compact('brands', 'tags', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $productImageController = new ProductImageController();
            $primaryImageFileName = $productImageController->upload($validatedData['primary_image']);
            $imagesFileName = $productImageController->uploadMany($validatedData['images']);

            $product = Product::create([
                'category_id' => $validatedData['category_id'],
                'brand_id' => $validatedData['brand_id'],
                'name' => $validatedData['name'],
                'primary_image' => $primaryImageFileName['primaryImageFileName'],
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
                'delivery_amount' => $validatedData['delivery_amount'],
                'delivery_amount_per_product' => $validatedData['delivery_amount_per_product'],
            ]);

            foreach ($imagesFileName['imagesFileName'] as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($validatedData['attribute_ids'], $product->id);

            $category = Category::find($validatedData['category_id']);
            $productVariationController = new ProductVariationController();
            $productVariationController->store(
                $validatedData['variation_values'],
                $category->attributes()->wherePivot('is_variation', 1)->first()->id,
                $product
            );

            $product->tags()->attach($validatedData['tag_ids']);

            DB::commit();

            return back()->with('success', 'محصول مورد نظر با موفقیت ایجاد شد');
        } catch (\Exception $e) {
            return back()->with('failed', 'مشکلی در ایجاد محصول به وجود آمده، لطفا دوباره تلاش کنید!');
        }

    }

    public function show(Product $product)
    {
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $productImages = $product->images;

        return view('admin.products.show', compact('product', 'productAttributes', 'productVariations', 'productImages'));
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;

        return view('admin.products.edit', compact('product', 'brands', 'tags', 'categories', 'productAttributes', 'productVariations'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $product->update([
                'brand_id' => $validatedData['brand_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
                'delivery_amount' => $validatedData['delivery_amount'],
                'delivery_amount_per_product' => $validatedData['delivery_amount_per_product'],
            ]);

            $productAttributeController = new ProductAttributeController();
            $productAttributeController->update($validatedData['attribute_values']);

            $productVariationController = new ProductVariationController();
            $productVariationController->update($validatedData['variation_values']);

            $product->tags()->sync($validatedData['tag_ids']);

            DB::commit();

            return back()->with('success', 'محصول مورد نظر با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return back()->with('failed', 'مشکلی در ویرایش محصول به وجود آمده، لطفا دوباره تلاش کنید!');
        }
    }

    public function destroy(string $id)
    {
        //
    }

    public function editCategory(Product $product)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
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
