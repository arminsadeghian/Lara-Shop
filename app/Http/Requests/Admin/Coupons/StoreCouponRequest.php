<?php

namespace App\Http\Requests\Admin\Coupons;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|unique:coupons,code',
            'coupon_type' => 'required',
            'amount' => 'required_if:coupon_type,=,amount',
            'percentage' => 'required_if:coupon_type,=,percentage',
            'max_percentage_amount' => 'required_if:coupon_type,=,percentage',
            'expired_at' => 'required',
            'description' => 'nullable|string',
        ];
    }
}
