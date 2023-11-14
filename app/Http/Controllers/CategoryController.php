<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()
            ->where('is_active', 1)
            ->filter()
            ->search()
            ->get();

        $attributes = $category->attributes()
            ->where('is_filter', 1)
            ->with('values')
            ->get();

        $variation = $category->attributes()
            ->where('is_variation', 1)
            ->with('variationValues')
            ->first();

        return view('front.categories.show', compact('category', 'products', 'attributes', 'variation'));
    }
}
