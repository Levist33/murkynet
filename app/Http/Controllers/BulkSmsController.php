<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Senderid;
use App\Models\SmsLog;
use App\Models\Transaction;
use App\Models\Wallet;

class BulkSmsController extends Controller
{
    public function index()
    {
        $senderids = Senderid::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->get();

        return view('sms.index', compact('senderids'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'sender_id_id' => 'required',
            'message' => 'required',
            'numbers_file' => 'required|file|mimes:txt,csv',
        ]);

        $user = auth()->user();

        $wallet = Wallet::where('user_id', $user->id)->first();

        if (!$wallet) {

            return redirect('/send-sms')->with(
                'error',
                'Wallet not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Read Numbers File
        |--------------------------------------------------------------------------
        */

        $numbers = file(
            $request->file('numbers_file')->getRealPath(),
            FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
        );

        /*
        |--------------------------------------------------------------------------
        | Clean Numbers
        |--------------------------------------------------------------------------
        */

        $numbers = array_filter(array_map('trim', $numbers));

        /*
        |--------------------------------------------------------------------------
        | Pricing
        |--------------------------------------------------------------------------
        */

        $pricePerSms = 0.05;

        $totalCost = count($numbers) * $pricePerSms;

        /*
        |--------------------------------------------------------------------------
        | Check Balance
        |--------------------------------------------------------------------------
        */

        if ($wallet->balance < $totalCost) {

            return redirect('/send-sms')->with(
                'error',
                'Insufficient balance for bulk campaign.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Deduct Wallet
        |--------------------------------------------------------------------------
        */

        $wallet->decrement('balance', $totalCost);

        /*
        |--------------------------------------------------------------------------
        | Save Transaction
        |--------------------------------------------------------------------------
        */

        Transaction::create([
            'user_id' => $user->id,
            'amount' => $totalCost,
            'type' => 'bulk_sms_charge',
            'description' => 'Bulk SMS campaign charge',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Simulate SMS Sending
        |--------------------------------------------------------------------------
        */

        foreach ($numbers as $phone) {

            SmsLog::create([

                'user_id' => $user->id,

                'sender_id_id' => $request->sender_id_id,

                'phone_number' => $phone,

                'message' => $request->message,

                'cost' => $pricePerSms,

                'status' => 'sent',

                'provider' => 'Bulk SMS Simulator',

                'provider_message_id' => 'BULK' . rand(100000, 999999),

            ]);
        }

        return redirect('/send-sms')->with(
            'success',
            count($numbers) . ' SMS messages sent successfully.'
        );
    }

    public function history()
    {
        $smsLogs = SmsLog::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('sms.history', compact('smsLogs'));
    }
}