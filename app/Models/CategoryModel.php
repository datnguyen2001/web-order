<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'api_id',
        'name',
        'slug',
        'type',
        'parent_id',
        'child_id',
    ];

    public function children()
    {
        return $this->hasMany(CategoryModel::class, 'parent_id');
    }

    public function grandchildren()
    {
        return $this->hasMany(CategoryModel::class, 'child_id');
    }
}
