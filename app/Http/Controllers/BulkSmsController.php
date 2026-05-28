<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SenderId;
use App\Models\SmsLog;
use App\Models\Wallet;

class BulkSmsController extends Controller
{
    public function index()
    {
        $senderids = SenderId::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->get();

        return view('sms.index', compact('senderids'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'sender_id_id' => 'required',
            'message' => 'required',
            'numbers' => 'required',
        ]);

        $wallet = Wallet::where('user_id', auth()->id())->first();

        if (!$wallet) {
            return back()->with('error', 'Wallet not found.');
        }

        $numbers = explode(',', $request->numbers);

        $smsCount = count($numbers);

        $costPerSms = 1;

        $totalCost = $smsCount * $costPerSms;

        if ($wallet->balance < $totalCost) {
            return back()->with('error', 'Insufficient wallet balance.');
        }

        $wallet->balance -= $totalCost;
        $wallet->save();

        foreach ($numbers as $number) {

            SmsLog::create([
                'user_id' => auth()->id(),
                'sender_id_id' => $request->sender_id_id,
                'number' => trim($number),
                'message' => $request->message,
                'status' => 'sent',
            ]);
        }

        return back()->with('success', 'Bulk SMS sent successfully.');
    }

    public function history()
    {
        $smsLogs = SmsLog::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('sms.history', compact('smsLogs'));
    }
}