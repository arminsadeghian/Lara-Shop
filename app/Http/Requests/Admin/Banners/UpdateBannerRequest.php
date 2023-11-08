<?php

namespace App\Http\Requests\Admin\Banners;

class UpdateBannerRequest extends StoreBannerRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'image' => 'nullable|mimes:png,jpeg,jpg',
        ]);
    }
}
