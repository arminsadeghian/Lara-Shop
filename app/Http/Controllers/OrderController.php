<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function userProfileOrdersIndex()
    {
        $orders = Order::latest()->where('user_id', auth()->id())->get();
        return view('front.users_profile.orders', compact('orders'));
    }
}
