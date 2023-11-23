<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function userAddressesIndex()
    {
        $provinces = Province::all();
        return view('front.users_profile.addresses', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validateWithBag('addressStore', [
            'title' => 'required',
            'cellphone' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);

        UserAddress::create([
            'user_id' => auth()->id(),
            'province_id' => $validatedData['province_id'],
            'city_id' => $validatedData['city_id'],
            'title' => $validatedData['title'],
            'cellphone' => $validatedData['cellphone'],
            'address' => $validatedData['address'],
            'postal_code' => $validatedData['postal_code'],
        ]);

        return redirect()->back()->with('success', 'آدرس مورد نظر ثبت شد');
    }

    public function getProvinceCitiesList(Request $request)
    {
        return City::where('province_id', $request->province_id)->get();
    }

}
