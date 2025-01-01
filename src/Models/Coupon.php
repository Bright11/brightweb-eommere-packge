<?php

namespace  Brightweb\Ecommerce\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $fillable=[
        'code',
        'usage_count',
        'one_time_use',
        'discount_percentage',
        'expires_at'

    ];

    public function incrementUsage()
    {
        $this->usage_count++;
        $this->save();
    }

    public function isOneTimeUse()
    {
        return $this->one_time_use;
    }

    public function isExpired()
    {
        return $this->expires_at < now();
    }
}
