<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
