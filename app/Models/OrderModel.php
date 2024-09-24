<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'address_id',
        'order_code',
        'is_tally',
        'note',
        'goods_money',
        'china_domestic_shipping_fee',
        'discount',
        'international_shipping_fee',
        'vietnam_domestic_shipping_fee',
        'insurance_fee',
        'partial_payment_fee',
        'tally_fee',
        'payment_currency',
        'deposit',
        'deposit_money',
        'payment_type',
        'total_payment_chinese',
        'total_payment_vietnamese',
        'status_id'
    ];
}
