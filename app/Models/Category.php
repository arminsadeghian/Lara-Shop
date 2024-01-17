<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getIsActiveAttribute($is_active): string
    {
        return $is_active == 1 ? 'فعال' : 'غیرفعال';
    }

    public function activeCategories()
    {
        return $this->children()->where('is_active', 1);
    }

    public function getParentCategories()
    {
        return $this->where('parent_id', 0)->get();
    }

    public function getAllCategoriesWithoutParents()
    {
        return $this->where('parent_id', '!=', 0)->get();
    }

    public function getCategoryAttributes()
    {
        return $this->attributes()->wherePivot('is_variation', 0)->get();
    }

    public function getCategoryVariation()
    {
        return $this->attributes()->wherePivot('is_variation', 1)->get();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
