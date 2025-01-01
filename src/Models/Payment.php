<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
