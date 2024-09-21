<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'payments';

    protected $casts = [
        'payment_date' => 'datetime',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->slug)) {
                $payment->slug = Str::random(10);
            }
        });
    }


}
