<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;

class CheckoutController extends Controller
{
    public function index()
    {
        if (\Cart::isEmpty()) {
            return redirect()->route('home.cart.index')->with('failed', 'سبد خرید شما خالی است');
        }

        $addresses = UserAddress::where('user_id', auth()->id())->get();
        return view('front.checkout.index', compact('addresses'));
    }
}
