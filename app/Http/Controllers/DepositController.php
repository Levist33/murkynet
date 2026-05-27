<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Deposit;
use App\Models\CryptoWallet;

class DepositController extends Controller
{
    public function index()
    {
        $wallets = CryptoWallet::where('is_active', true)->get();

        return view('deposit', [
            'wallets' => $wallets,
        ]);
    }

    public function store(Request $request)
    {
        Deposit::create([
            'user_id' => auth()->id(),

            'currency' => $request->currency,

            'network' => $request->network,

            'amount' => $request->amount,

            'wallet_address' => $request->wallet_address,

            'txid' => $request->txid,

            'status' => 'pending',
        ]);

        return back()->with('success', 'Deposit request submitted successfully.');
    }

    public function history()
    {
        $deposits = Deposit::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('deposit-history', [
            'deposits' => $deposits,
        ]);
    }
}