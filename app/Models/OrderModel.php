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
        'goods_money_chinese',
        'goods_money_vietnamese',
        'china_domestic_shipping_fee_chinese',
        'china_domestic_shipping_fee_vietnamese',
        'discount_chinese',
        'discount_vietnamese',
        'international_shipping_fee_chinese',
        'international_shipping_fee_vietnamese',
        'vietnam_domestic_shipping_fee_chinese',
        'vietnam_domestic_shipping_fee_vietnamese',
        'insurance_fee_chinese',
        'insurance_fee_vietnamese',
        'partial_payment_fee_chinese',
        'partial_payment_fee_vietnamese',
        'tally_fee_chinese',
        'tally_fee_vietnamese',
        'payment_currency',
        'deposit',
        'deposit_money',
        'payment_type',
        'total_payment_chinese',
        'total_payment_vietnamese',
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
