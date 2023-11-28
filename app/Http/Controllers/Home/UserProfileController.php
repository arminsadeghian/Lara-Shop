<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('front.users_profile.index');
    }
}
