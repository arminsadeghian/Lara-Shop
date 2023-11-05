<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
