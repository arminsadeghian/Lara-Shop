<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function upload($primaryImage): array
    {
        $primaryImageFileName = $this->fileNameToHash($primaryImage->getClientOriginalName());
        $primaryImage->move(public_path('\images\products'), $primaryImageFileName);

        return [
            'primaryImageFileName' => $primaryImageFileName,
        ];
    }

    public function uploadMany($images): array
    {
        $imagesFileName = [];
        foreach ($images as $image) {
            $imageFileName = $this->fileNameToHash($image->getClientOriginalName());
            $image->move(public_path('\images\products'), $imageFileName);
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

    public function setPrimary(Request $request)
    {
        dd($request->all());
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }

    private function fileNameToHash($name): string
    {
        $explodedFileName = explode('.', $name);
        $fileExtension = strtolower(end($explodedFileName));
        return sha1(time() . rand(1111, 9999)) . '.' . $fileExtension;
    }

}
