<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallerId extends Model
{
    protected $fillable = [
        'user_id',
        'caller_id',
        'status',
        'admin_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}