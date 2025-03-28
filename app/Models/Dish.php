<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'name_kk',
        'name_en',
        'photo',
        'price',
        'description',
        'description_kk',
        'description_en',
        'weight',
        'is_recommend',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
