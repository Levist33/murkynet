<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = [
        'user_id',
        'caller_id_id',
        'phone',
        'duration',
        'cost',
        'status',
        'provider',
        'provider_call_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function callerId()
    {
        return $this->belongsTo(CallerId::class);
    }
}