<?php

namespace App\Http\Controllers;

use App\Models\CallerId;
use App\Models\SenderId;
use App\Models\CallLog;
use App\Models\Deposit;
use App\Models\SmsLog;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Wallet
        |--------------------------------------------------------------------------
        */

        $wallet = $user->wallet;

        /*
        |--------------------------------------------------------------------------
        | SMS Metrics
        |--------------------------------------------------------------------------
        */

        $smsCount = SmsLog::where('user_id', $user->id)->count();

        $delivered = SmsLog::where('user_id', $user->id)
            ->where('status', 'sent')
            ->count();

        $failed = SmsLog::where('user_id', $user->id)
            ->where('status', 'failed')
            ->count();

        $deliveryRate = $smsCount > 0
            ? round(($delivered / $smsCount) * 100, 1)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Call Metrics
        |--------------------------------------------------------------------------
        */

        $callCount = CallLog::where('user_id', $user->id)->count();

        $completedCalls = CallLog::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Deposits
        |--------------------------------------------------------------------------
        */

        $depositCount = Deposit::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Transactions
        |--------------------------------------------------------------------------
        */

        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SMS Logs
        |--------------------------------------------------------------------------
        */

        $smsLogs = SmsLog::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Call Logs
        |--------------------------------------------------------------------------
        */

        $callLogs = CallLog::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Activity Feed
        |--------------------------------------------------------------------------
        */

        $smsActivities = SmsLog::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($sms) {

                return [
                    'type' => 'sms',
                    'message' => 'SMS sent to ' . $sms->phone_number,
                    'time' => $sms->created_at,
                ];
            });

        $callActivities = CallLog::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($call) {

                return [
                    'type' => 'call',
                    'message' => 'Call made to ' . $call->phone,
                    'time' => $call->created_at,
                ];
            });

        $depositActivities = Deposit::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($deposit) {

                return [
                    'type' => 'deposit',
                    'message' => 'Deposit request of $' . $deposit->amount,
                    'time' => $deposit->created_at,
                ];
            });

        $callerActivities = CallerId::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($caller) {

                return [
                    'type' => 'callerid',
                    'message' => 'Caller ID submitted: ' . $caller->caller_id,
                    'time' => $caller->created_at,
                ];
            });

        $senderActivities = SenderId::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($sender) {

                return [
                    'type' => 'senderid',
                    'message' => 'Sender ID submitted: ' . $sender->sender_id,
                    'time' => $sender->created_at,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Merge Activities
        |--------------------------------------------------------------------------
        */

        $activities = $smsActivities
            ->merge($callActivities)
            ->merge($depositActivities)
            ->merge($callerActivities)
            ->merge($senderActivities)
            ->sortByDesc('time')
            ->take(15);

        /*
        |--------------------------------------------------------------------------
        | Weekly Analytics
        |--------------------------------------------------------------------------
        */

        $smsWeekly = [
            SmsLog::whereDate('created_at', now()->subDays(6))->count(),
            SmsLog::whereDate('created_at', now()->subDays(5))->count(),
            SmsLog::whereDate('created_at', now()->subDays(4))->count(),
            SmsLog::whereDate('created_at', now()->subDays(3))->count(),
            SmsLog::whereDate('created_at', now()->subDays(2))->count(),
            SmsLog::whereDate('created_at', now()->subDays(1))->count(),
            SmsLog::whereDate('created_at', now())->count(),
        ];

        $callWeekly = [
            CallLog::whereDate('created_at', now()->subDays(6))->count(),
            CallLog::whereDate('created_at', now()->subDays(5))->count(),
            CallLog::whereDate('created_at', now()->subDays(4))->count(),
            CallLog::whereDate('created_at', now()->subDays(3))->count(),
            CallLog::whereDate('created_at', now()->subDays(2))->count(),
            CallLog::whereDate('created_at', now()->subDays(1))->count(),
            CallLog::whereDate('created_at', now())->count(),
        ];

        $depositWeekly = [
            Deposit::whereDate('created_at', now()->subDays(6))->count(),
            Deposit::whereDate('created_at', now()->subDays(5))->count(),
            Deposit::whereDate('created_at', now()->subDays(4))->count(),
            Deposit::whereDate('created_at', now()->subDays(3))->count(),
            Deposit::whereDate('created_at', now()->subDays(2))->count(),
            Deposit::whereDate('created_at', now()->subDays(1))->count(),
            Deposit::whereDate('created_at', now())->count(),
        ];

        return view('dashboard', [

            'wallet' => $wallet,

            'smsCount' => $smsCount,

            'delivered' => $delivered,

            'failed' => $failed,

            'deliveryRate' => $deliveryRate,

            'callCount' => $callCount,

            'completedCalls' => $completedCalls,

            'depositCount' => $depositCount,

            'transactions' => $transactions,

            'smsLogs' => $smsLogs,

            'callLogs' => $callLogs,

            'activities' => $activities,

            'smsWeekly' => $smsWeekly,

            'callWeekly' => $callWeekly,

            'depositWeekly' => $depositWeekly,

        ]);
    }
}