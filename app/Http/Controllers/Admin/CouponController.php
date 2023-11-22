<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupons\StoreCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(StoreCouponRequest $request)
    {
        $validatedData = $request->validated();

        Coupon::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'type' => $validatedData['coupon_type'],
            'amount' => $validatedData['amount'],
            'percentage' => $validatedData['percentage'],
            'max_percentage_amount' => $validatedData['max_percentage_amount'],
            'expired_at' => convertShamsiToGregorianDate($validatedData['expired_at']),
            'description' => $validatedData['description'],
        ]);

        return redirect()->back()->with('success', 'کوپن مورد نظر ایجاد شد');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
