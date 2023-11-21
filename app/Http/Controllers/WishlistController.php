<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);
    }
}
