<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
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

        return redirect()->back();
    }

    public function remove(Product $product)
    {
        $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', auth()->id());
        $wishlist->delete();

        return redirect()->back();
    }

    public function userProfileWishlistIndex()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->get();
        return view('front.users_profile.wishlist', compact('wishlist'));
    }
}
