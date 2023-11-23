<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function userAddressesIndex()
    {
        return view('front.users_profile.addresses');
    }
}
