<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class,"product_id");
    }

    public function payment(){
        return $this->belongsTo(Payment::class,"paymentid");
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,"shipping_id");
    }
}
