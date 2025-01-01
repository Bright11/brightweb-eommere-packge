<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable=[
               'name',
                'email',
                "street_address",
                "land_mark",
                "city",
                "state",
                "country",
                "pincode",
                "phone",
                'user_id'
    ];
}
