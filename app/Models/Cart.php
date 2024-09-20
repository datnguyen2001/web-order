<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_name',
        'product_value',
        'product_attribute',
        'quantity',
        'chinese_price',
        'vietnamese_price',
    ];
}
