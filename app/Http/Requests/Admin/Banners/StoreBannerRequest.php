<?php

namespace App\Http\Requests\Admin\Banners;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'title' => 'nullable|string',
            'text' => 'nullable|string',
            'priority' => 'nullable|integer',
            'is_active' => 'required|integer',
            'type' => 'required|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'button_icon' => 'nullable|string',
            'image' => 'required|mimes:png,jpeg,jpg',
        ];
    }

}
