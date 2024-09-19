<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
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
        return $this->hasMany(ProductValuesModel::class, 'product_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImagesModel::class, 'product_id');
    }

}
