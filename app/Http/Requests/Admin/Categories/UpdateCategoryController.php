<?php

namespace App\Http\Requests\Admin\Categories;

class UpdateCategoryController extends StoreCategoryRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'slug' => 'required|string|unique:categories,slug,' . $this->request->get('category_id') . ''
        ]);
    }
}
