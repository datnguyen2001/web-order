<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImagesModel extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    protected $fillable = ['product_id', 'src'];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
