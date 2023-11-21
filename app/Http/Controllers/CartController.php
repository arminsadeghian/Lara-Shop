<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
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

}
