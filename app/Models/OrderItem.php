<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'dishes_id',
        'price',
        'quantity',
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
