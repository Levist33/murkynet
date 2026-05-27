<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use App\Models\CallerId;
use App\Models\Transaction;

use Illuminate\Http\Request;

class CallController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Outbound Call Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $callerIds = CallerId::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->get();

        return view('calls.index', compact('callerIds'));
    }

    /*
    |--------------------------------------------------------------------------
    | Make Call
    |--------------------------------------------------------------------------
    */

    public function call(Request $request)
    {
        $request->validate([
            'caller_id' => 'required',
            'phone' => 'required',
        ]);

        $user = auth()->user();

        $wallet = $user->wallet;

        $cost = 0.20;

        /*
        |--------------------------------------------------------------------------
        | Balance Check
        |--------------------------------------------------------------------------
        */

        if (!$wallet || $wallet->balance < $cost) {

            return back()->with(
                'error',
                'Insufficient balance.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Deduct Wallet
        |--------------------------------------------------------------------------
        */

        $wallet->decrement('balance', $cost);

        /*
        |--------------------------------------------------------------------------
        | Save Transaction
        |--------------------------------------------------------------------------
        */

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $cost,
            'type' => 'call_charge',
            'description' => 'Outbound call charge',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Simulate Telecom Provider
        |--------------------------------------------------------------------------
        */

        $statuses = [
            'answered',
            'failed',
            'completed',
        ];

        $status = $statuses[array_rand($statuses)];

        $duration = rand(10, 300);

        /*
        |--------------------------------------------------------------------------
        | Save Call Log
        |--------------------------------------------------------------------------
        */

        CallLog::create([

            'user_id' => $user->id,

            'caller_id_id' => $request->caller_id,

            'phone' => $request->phone,

            'duration' => $duration,

            'cost' => $cost,

            'status' => $status,

            'provider' => 'Demo Telecom Provider',

            'provider_call_id' => 'CALL' . rand(100000, 999999),

        ]);

        return back()->with(
            'success',
            'Call initiated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Call History
    |--------------------------------------------------------------------------
    */

    public function history()
    {
        $callLogs = CallLog::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('calls.history', compact('callLogs'));
    }

    /*
    |--------------------------------------------------------------------------
    | Caller ID Request Page
    |--------------------------------------------------------------------------
    */

    public function callerids()
    {
        $callerIds = CallerId::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('callerids.index', compact('callerIds'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store Caller ID Request
    |--------------------------------------------------------------------------
    */

    public function storeCallerId(Request $request)
    {
        $request->validate([
            'caller_id' => 'required|unique:caller_ids,caller_id',
        ]);

        CallerId::create([

            'user_id' => auth()->id(),

            'caller_id' => $request->caller_id,

            'status' => 'pending',

        ]);

        return back()->with(
            'success',
            'Caller ID submitted successfully.'
        );
    }
}