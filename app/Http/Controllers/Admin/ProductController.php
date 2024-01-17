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

    public function create(Category $category)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = $category->getAllCategoriesWithoutParents();

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

            // Store product in database
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

            // Store product images in database
            foreach ($imagesFileName['imagesFileName'] as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }

            // Store product attributes in database
            (new ProductAttributeController())->store($validatedData['attribute_ids'], $product->id);

            // Store product variations in database
            $category = Category::find($validatedData['category_id']);
            (new ProductVariationController())->store(
                $validatedData['variation_values'],
                $category->attributes()->wherePivot('is_variation', 1)->first()->id,
                $product
            );

            // Store product tags in database
            $product->tags()->attach($validatedData['tag_ids']);

            DB::commit();

            return back()->with('success', 'محصول مورد نظر با موفقیت ایجاد شد');
        } catch (\Exception $e) {
            return back()->with('failed', 'مشکلی در ایجاد محصول به وجود آمده، لطفا دوباره تلاش کنید!');
        }

    }

    public function show(Product $product)
    {
        $productAttributes = $product->getProductAttributes();
        $productVariations = $product->getProductVariations();
        $productImages = $product->getProductImages();

        return view('admin.products.show', compact('product', 'productAttributes', 'productVariations', 'productImages'));
    }

    public function edit(Product $product, Category $category)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = $category->getAllCategoriesWithoutParents();
        $productAttributes = $product->getProductAttributes();
        $productVariations = $product->getProductVariations();

        return view('admin.products.edit', compact('product', 'brands', 'tags', 'categories', 'productAttributes', 'productVariations'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            // Update product
            $product->update([
                'brand_id' => $validatedData['brand_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'is_active' => $validatedData['is_active'],
                'delivery_amount' => $validatedData['delivery_amount'],
                'delivery_amount_per_product' => $validatedData['delivery_amount_per_product'],
            ]);

            // Update product attributes
            (new ProductAttributeController())->update($validatedData['attribute_values']);

            // Update product variations
            (new ProductVariationController())->update($validatedData['variation_values']);

            // Update product tags
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
}
