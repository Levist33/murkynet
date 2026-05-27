<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Senderid extends Model
{
    protected $table = 'senderids';

    protected $fillable = [
        'user_id',
        'sender_id',
        'country',
        'status',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class, 'sender_id_id');
    }
}