<?php

namespace Brightweb\Ecommerce\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral_usage extends Model
{
    use HasFactory;

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    // The referee (user who was referred)
    public function referee()
    {
        return $this->belongsTo(User::class, 'referee_id');
    }
}
