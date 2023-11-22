<?php

namespace App\Http\Requests\Admin\Coupons;

class UpdateCouponRequest extends StoreCouponRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'code' => 'required|string|unique:coupons,code,' . $this->request->get('coupon_id') . ''
        ]);
    }
}
