<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.index');
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qtybutton' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $productVariation = ProductVariation::findOrFail(json_decode($request->variation)->id);

        if ($request->qtybutton <= $productVariation->quantity) {
            $rowId = $product->id . '-' . $productVariation->id;
            if (Cart::get($rowId) == null) {
                Cart::add([
                    'id' => $rowId,
                    'name' => $product->name,
                    'price' => $productVariation->is_sale ? $productVariation->sale_price : $productVariation->price,
                    'quantity' => $request->qtybutton,
                    'attributes' => $productVariation->toArray(),
                    'associatedModel' => $product,
                ]);
            }
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'qtybutton' => 'required'
        ]);

        foreach ($validatedData['qtybutton'] as $rowId => $quantity) {
            $item = Cart::get($rowId);
            if ($quantity <= $item->attributes->quantity) {
                Cart::update($rowId, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $quantity
                    ]
                ]);
            }
        }

        return redirect()->back();
    }

    public function clear()
    {
        Cart::clear();

        return redirect()->back();
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back();
    }

}
