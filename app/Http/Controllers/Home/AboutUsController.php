<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('front.about_us.index');
    }
}
