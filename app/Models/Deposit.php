<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'currency',
        'network',
        'amount',
        'wallet_address',
        'txid',
        'proof',
        'status',
        'admin_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}