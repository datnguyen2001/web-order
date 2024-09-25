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
        'total_payment_chinese',
        'total_payment_vietnamese',
        'payment_currency',
        'deposit',
        'deposit_money',
        'payment_type',
        'status_id'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id', 'id');
    }

    public function shippingAddress()
    {
        return $this->hasMany(AddressModel::class, 'id', 'address_id');
    }

}
