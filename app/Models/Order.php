<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'name',
        'phone',
        'delivery_type',
        'address',
        'comment',
        'delivery_date',
        'delivery_time',
        'total_price',
        'status'
    ];
}
