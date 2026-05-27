<?php

namespace App\Models;

use App\Models\TicketReply;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [

        'user_id',

        'subject',

        'category',

        'message',

        'status',

    ];

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Replies
    |--------------------------------------------------------------------------
    */

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}