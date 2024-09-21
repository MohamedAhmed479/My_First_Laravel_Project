<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;

    protected $table = "conversations";

    protected $guarded = ['id'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

}
