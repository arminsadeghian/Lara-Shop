<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getIsActiveAttribute($is_active): string
    {
        return $is_active == 1 ? 'فعال' : 'غیرفعال';
    }

    public function getQuantityCheckAttribute()
    {
        return $this->variations()
            ->where('quantity', '>', 0)
            ->first() ?? 0;
    }

    public function getSaleCheckAttribute()
    {
        return $this->variations()
            ->where('quantity', '>', 0)
            ->where('sale_price', '!=', null)
            ->where('date_on_sale_from', '<', Carbon::now())
            ->where('date_on_sale_to', '>', Carbon::now())
            ->orderBy('sale_price')
            ->first() ?? false;
    }

    public function getPriceCheckAttribute()
    {
        return $this->variations()
            ->where('quantity', '>', 0)
            ->orderBy('price')
            ->first() ?? false;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }

    public function scopeFilter($query)
    {
        // Variation Filter
        if (request()->has('variation')) {
            $query->whereHas('variations', function ($query) {
                $variations = explode('-', request()->variation);
                foreach ($variations as $index => $variation) {
                    if ($index == 0) {
                        $query->where('value', $variation);
                    }
                    $query->orWhere('value', $variation);
                }
            });
        }

        return $query;
    }

}
