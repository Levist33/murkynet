<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
        'user_id',
        'sender_id_id',
        'phone_number',
        'message',
        'cost',
        'status',
        'provider',
        'provider_message_id',
    ];

    public function senderid()
    {
        return $this->belongsTo(Senderid::class, 'sender_id_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}