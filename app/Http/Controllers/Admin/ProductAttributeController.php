<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    public function store($attributes, $product)
    {
        foreach ($attributes as $key => $value) {
            ProductAttribute::create([
                'attribute_id' => $key,
                'value' => $value,
                'product_id' => $product,
            ]);
        }
    }

    public function update(array $attributeIds)
    {
        foreach ($attributeIds as $key => $value) {
            $productAttribute = ProductAttribute::findOrFail($key);
            $productAttribute->update([
                'value' => $value
            ]);
        }
    }

    public function change($attributes, $product)
    {
        ProductAttribute::where('product_id', $product->id)->delete();

        foreach ($attributes as $key => $value) {
            ProductAttribute::create([
                'attribute_id' => $key,
                'value' => $value,
                'product_id' => $product->id,
            ]);
        }
    }

}
