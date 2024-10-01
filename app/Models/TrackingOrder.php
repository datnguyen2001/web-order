<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrackingOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tracking_orders";
    protected $fillable = [
        "package_id",
        "package_code",
        "status_transport",
        "weight",
        "warehouse_id",
        "customer_id",
        "order_id",
        "order_code",
        "order_create_time",
        "bag_id",
        "note"
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customers_id');
    }

    public function freightBills()
    {
        return $this->hasMany(FreightBill::class, 'package_id', 'package_id');
    }
}
