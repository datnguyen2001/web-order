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
        'about_shop',
        'facebook',
        'tiktok',
        'youtube',
        'img_qr',
        'content_footer_one',
        'content_footer_two'
    ];
}
