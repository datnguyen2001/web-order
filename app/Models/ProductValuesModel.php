<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValuesModel extends Model
{
    use HasFactory;
    protected $table = 'product_values';

    protected $fillable = [
        'api_id',
        'product_id',
        'name',
        'src',
        'PID'
    ];
}
