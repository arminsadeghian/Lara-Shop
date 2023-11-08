<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        return view('front.index', compact('parentCategories'));
    }
}
