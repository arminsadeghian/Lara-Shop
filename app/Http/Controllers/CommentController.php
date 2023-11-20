<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:5|max:2000',
            'rate' => 'required|digits_between:0,5'
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#comments')->withErrors($validator);
        }

        try {
            DB::beginTransaction();

            Comment::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'text' => $request->text,
            ]);

            if ($product->rates()->where('user_id', auth()->id())->exists()) {
                $productRate = $product->rates()->where('user_id', auth()->id())->first();
                $productRate->update([
                    'rate' => $request->rate,
                ]);
            } else {
                ProductRate::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'rate' => $request->rate,
                ]);
            }

            DB::commit();

            return back()->with('success', 'از ثبت نظر شما ممنونیم');
        } catch (\Exception $e) {
            return back()->with('failed', 'مشکلی در ثبت نظر به وجود آمده!');
        }
    }
}
