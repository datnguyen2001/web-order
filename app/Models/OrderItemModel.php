<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_name',
        'product_value',
        'product_attribute',
        'quantity',
        'product_image',
        'product_value_image',
        'chinese_price',
        'vietnamese_price',
        'total_chinese_price',
        'total_vietnamese_price',
    ];
}
