<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistoriesModel extends Model
{
    use HasFactory;
    protected $table = 'wallet_histories';
    protected $fillable = [
        'user_id',
        'transaction_code',
        'amount',
        'old_balance',
        'new_balance',
        'wallet_type',
        'description',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
