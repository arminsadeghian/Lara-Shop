<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $sliders = Banner::where('type', 'slider')->where('is_active', 1)->orderBy('priority')->get();
        $indexTopBanners = Banner::where('type', 'index-top')->where('is_active', 1)->orderBy('priority')->get();
        $products = Product::where('is_active', 1)->orderBy('created_at', 'DESC')->take(5)->get();
        return view('front.index', compact('parentCategories', 'sliders', 'indexTopBanners', 'products'));
    }
}
