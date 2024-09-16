<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletsModel extends Model
{
    use HasFactory;
    protected $table = 'wallets';
    protected $fillable = [
        'user_id',
        'vietnamese_money',
        'middle_money',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
