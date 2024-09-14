<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommercePlatformModel extends Model
{
    use HasFactory;
    protected $table = 'e-commerce_platform';
    protected $fillable = [
        'name',
        'src',
        'link',
        'display'
    ];
}
