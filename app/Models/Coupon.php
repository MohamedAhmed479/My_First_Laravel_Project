<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'coupons';

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    protected $casts = [
        'expiration_date' => 'datetime',
    ];


}
