<?php

namespace Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;

class Social_link extends Model
{
    //
    protected $fillable = [
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'phone_number',
        'box_address'
    ];
}
