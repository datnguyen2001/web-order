<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeScheduleModel extends Model
{
    use HasFactory;
    protected $table = 'fee_schedule';
    protected $fillable = [
        'content',
    ];
}
