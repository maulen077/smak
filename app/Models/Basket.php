<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'dish_id',
        'quantity',
        'total_price',
    ];


    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
