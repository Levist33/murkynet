<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\TicketReply;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'subject' => 'required',

            'category' => 'required',

            'message' => 'required',

        ]);

        Ticket::create([

            'user_id' => auth()->id(),

            'subject' => $request->subject,

            'category' => $request->category,

            'message' => $request->message,

            'status' => 'open',

        ]);

        return back()->with(
            'success',
            'Support ticket submitted successfully.'
        );
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {

            abort(403);
        }

        $ticket->load('replies.user');

        return view('tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {

            abort(403);
        }

        $request->validate([

            'message' => 'required',

        ]);

        TicketReply::create([

            'ticket_id' => $ticket->id,

            'user_id' => auth()->id(),

            'message' => $request->message,

            'is_admin' => false,

        ]);

        return back()->with(
            'success',
            'Reply submitted successfully.'
        );
    }
}