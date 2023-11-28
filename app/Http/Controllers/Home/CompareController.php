<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CompareController extends Controller
{
    public function index()
    {
        $products = Product::findOrFail(session()->get('productCompare'));
        return view('front.compare.index', compact('products'));
    }

    public function add(Product $product)
    {
        if (session()->has('productCompare')) {
            if (!in_array($product->id, session()->get('productCompare'))) {
                session()->push('productCompare', $product->id);
            }
        } else {
            session()->put('productCompare', [$product->id]);
        }

        return redirect()->route('home.compare.index');
    }

    public function remove($productId)
    {
        if (session()->has('productCompare')) {
            foreach (session()->get('productCompare') as $key => $item) {
                if ($item == $productId) {
                    session()->pull('productCompare.' . $key);
                }
            }

            if (session()->get('productCompare') == []) {
                session()->forget('productCompare');
                return redirect()->route('home.index');
            }
        }

        return redirect()->back();
    }
}
