<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValueTaobaoModel extends Model
{
    use HasFactory;

    protected $table = 'product_values_taobaos';

    protected $fillable = [
        'product_id',
        'name',
        'src',
        'PID'
    ];
    public function productAttributes()
    {
        return $this->hasMany(ProductAttributeTaobaoModel::class, 'product_value_id');
    }
}
