<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $sliders = Banner::where('type', 'slider')->where('is_active', 1)->orderBy('priority')->get();
        return view('front.index', compact('parentCategories', 'sliders'));
    }
}
