<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\CallLog;
use App\Models\CallerId;
use App\Models\Deposit;
use App\Models\SmsLog;
use App\Models\SenderId;
use App\Models\Transaction;
use App\Models\Wallet;

use Database\Factories\UserFactory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::created(function ($user) {

            /*
            |--------------------------------------------------------------------------
            | Auto Create Wallet
            |--------------------------------------------------------------------------
            */

            Wallet::create([

                'user_id' => $user->id,

                'balance' => 0,

            ]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Wallet
    |--------------------------------------------------------------------------
    */

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Transactions
    |--------------------------------------------------------------------------
    */

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Sender IDs
    |--------------------------------------------------------------------------
    */

    public function senderids()
    {
        return $this->hasMany(SenderId::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SMS Logs
    |--------------------------------------------------------------------------
    */

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Deposits
    |--------------------------------------------------------------------------
    */

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Caller IDs
    |--------------------------------------------------------------------------
    */

    public function callerIds()
    {
        return $this->hasMany(CallerId::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Call Logs
    |--------------------------------------------------------------------------
    */

    public function callLogs()
    {
        return $this->hasMany(CallLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Tickets
    |--------------------------------------------------------------------------
    */

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}