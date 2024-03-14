<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()
            ->active()
            ->filter()
            ->search()
            ->paginate(9);

        $attributes = $category->attributes()
            ->with('values')
            ->isFilter()
            ->get();

        $variation = $category->attributes()
            ->with('variationValues')
            ->isVariation()
            ->first();

        return view('front.categories.show', compact('category', 'products', 'attributes', 'variation'));
    }
}
