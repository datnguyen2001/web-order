<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;
    protected $table = 'setting';
    protected $fillable = [
        'logo',
        'exchange_rate',
        'insurance_fee',
        'partial_payment_key_1',
        'partial_payment_fee_1',
        'partial_payment_key_2',
        'partial_payment_fee_2',
        'tally_fee',
        'about_shop',
        'facebook',
        'tiktok',
        'youtube',
        'img_qr',
        'content_footer_one',
        'content_footer_two'
    ];
}
