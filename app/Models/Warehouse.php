<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "warehouses";
    protected $fillable = ['warehouse_id', 'name'];

    public function trackingOrders()
    {
        return $this->hasMany(TrackingOrder::class, 'warehouse_id', 'warehouse_id');
    }
}
