<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category->id)->take(5)->get();
        return view('front.products.show', compact('product', 'relatedProducts'));
    }
}
