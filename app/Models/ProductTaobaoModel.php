<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTaobaoModel extends Model
{
    use HasFactory;

    protected $table = 'product_taobaos';

    protected $fillable = [
        'api_id',
        'name',
        'slug',
        'category_id',
        'description',
        'quantity',
        'price',
        'sold'
    ];

    public function productValues()
    {
        return $this->hasMany(ProductValueTaobaoModel::class, 'product_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImageTaobaoModel::class, 'product_id');
    }
}
