<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValuesModel extends Model
{
    use HasFactory;
    protected $table = 'product_values';
    protected $fillable = [
        'product_id',
        'name',
        'src'
    ];
}
