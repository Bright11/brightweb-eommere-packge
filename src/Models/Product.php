<?php

namespace Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'buying_price',
        'selling_price',
        'qty',
        'description',
        'image_pc',
        'image_url',
        'discount',
        'keywords',
        'category_id',
        'slug',
        'source'
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function($model) {
            $model->slug = $model->generateSlug($model->name);
        });
    }

    public function generateSlug($name)
    {
        $slug = Str::slug($name);
        $allslugs = static::where("slug", "LIKE", "{$slug}%")->pluck("slug");

        if (!$allslugs->contains($slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 1000; $i++) {
            $newslug = "{$slug}-{$i}";
            if (!$allslugs->contains($newslug)) {
                return $newslug;
            }
        }

        return $slug;
    }

    public function variations()
    {
        return $this->hasMany(Product_variation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,"id");
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function productgallery()
    {
        return $this->hasMany(Product_gallery::class);
    }
}
