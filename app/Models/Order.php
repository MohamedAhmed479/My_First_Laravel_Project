<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'orders';

    // Using the creating event to set a random slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Set a random string for slug if it is not set
            if (empty($model->slug)) {
                $model->slug = Str::random(10); // Generates a random 10-character string
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }



    // قائمة الحالة المتاحة
    public static function statuses()
    {
        return [
            'pending' => 'pending',          // (معلق): الطلب تم استلامه ولكن لم تتم معالجته بعد. هذا يعني أن الطلب في انتظار المراجعة أو الموافقة.
            'processing' => 'processing',   //  (قيد المعالجة): الطلب يتم معالجته الآن. قد يشمل ذلك تجميع العناصر، إعداد الشحن، أو أي خطوات أخرى في إعداد الطلب.
            'shipped' => 'shipped',        // (مُشحن): الطلب قد تم شحنه وخرج من المستودع إلى العميل. يمكن أن يشمل هذا الحالة التي يتم فيها تسليم الطلب إلى شركة الشحن.
            'delivered' => 'delivered',   // (تم التسليم): الطلب قد وصل إلى العميل وتم استلامه بنجاح. عادةً ما تكون هذه الحالة مؤشرًا على انتهاء العملية.
            'cancelled' => 'cancelled',  // (ملغى): الطلب تم إلغاؤه، إما بناءً على طلب العميل أو بسبب مشكلة في الطلب (مثل عدم توفر العناصر).
            'refunded' => 'refunded',   // (مسترد): الطلب تم استرداد أمواله بالكامل للعميل. هذه الحالة قد تأتي بعد الإلغاء أو طلب استرجاع.
            'in_the_cart' => 'in_the_cart',   

        ];
    }

    protected $casts = [
        'delivery_time' => 'datetime',
    ];


    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('price', 'quantity', 'amount');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function customer() {
        return $this->belongsTo(User::class);
    }

}

