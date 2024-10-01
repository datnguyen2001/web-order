<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "customers";
    protected $fillable = [
        "customers_id",
        "agency_id",
        "code",
        "username",
        "address",
        "email",
        "full_name",
        "phone",
        "type",
    ];

    public function trackingOrders()
    {
        return $this->hasMany(TrackingOrder::class, 'customers_id', 'customer_id');
    }
}
