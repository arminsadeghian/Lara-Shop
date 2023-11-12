<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = Product::latest()
            ->where('is_active', 1)
            ->where('category_id', $category->id)
            ->paginate(9);

        return view('front.categories.show', compact('category', 'products'));
    }
}
