<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_gallery extends Model
{
    use HasFactory;

    protected $fillable=[
        'product_id',
        'image_from_pc',
        'source',
        'image_from_url'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
