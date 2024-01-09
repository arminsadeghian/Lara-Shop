<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Utils\ProductImageUploader;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function upload($primaryImage): array
    {
        $primaryImageFileName = ProductImageUploader::upload($primaryImage);

        return [
            'primaryImageFileName' => $primaryImageFileName,
        ];
    }

    public function uploadMany($images): array
    {
        $imagesFileName = [];
        foreach ($images as $image) {
            $imageFileName = ProductImageUploader::upload($image);
            $imagesFileName[] = $imageFileName;
        }

        return [
            'imagesFileName' => $imagesFileName,
        ];
    }

    public function edit(Product $product)
    {
        $productImages = $product->images;
        return view('admin.products.edit_images', compact('product', 'productImages'));
    }

    public function setPrimary(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'image_id' => 'required|exists:product_images,id'
        ]);
        $productImage = ProductImage::findOrFail($validatedData['image_id']);
        $product->update([
            'primary_image' => $productImage->image
        ]);
        return back()->with('success', 'تصویر مورد نظر به عنوان تصویر اصلی انتخاب شد');
    }

    public function add(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'primary_image' => 'nullable|mimes:png,jpeg,jpg',
            'images.*' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        if ($request->primary_image == null && $request->images == null) {
            return back()->with('failed', 'لطفا ابتدا تصویر یا تصاویر را انتخاب کنید');
        }

        if ($request->has('primary_image')) {
            $primaryImageFileName = ProductImageUploader::upload($validatedData['primary_image']);
            $product->update([
                'primary_image' => $primaryImageFileName
            ]);
        }

        if ($request->has('images')) {
            foreach ($validatedData['images'] as $image) {
                $imageFileName = ProductImageUploader::upload($image);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageFileName
                ]);
            }
        }

        return back()->with('success', 'تصویر جدید آپلود شد');
    }

    public function destroy(Request $request)
    {
        $validatedData = $request->validate([
            'image_id' => 'required|exists:product_images,id'
        ]);
        ProductImage::destroy($validatedData['image_id']);
        return back()->with('success', 'تصویر مورد نظر حذف شد');
    }

}
