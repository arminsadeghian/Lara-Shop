<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function show()
    {
        $commentsCount = Comment::all()->count();
        $productsCount = Product::all()->count();
        $transactionsCount = Transaction::all()->count();
        $ordersCount = Order::all()->count();

        return view('admin.dashboard', compact('commentsCount', 'productsCount', 'transactionsCount', 'ordersCount'));
    }
}
