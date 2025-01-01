<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'variation_type', 'variation_value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
