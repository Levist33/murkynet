<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SenderID;

class SenderIdController extends Controller
{
    public function index()
    {
        $senderids = SenderID::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('senderids', [
            'senderids' => $senderids,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|max:11',
        ]);

        Senderid::create([
            'user_id' => auth()->id(),

            'sender_id' => $request->sender_id,

            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Sender ID submitted for approval.'
        );
    }
}