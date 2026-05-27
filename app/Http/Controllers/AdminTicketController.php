<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('user', 'replies.user');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([

            'message' => 'required',

        ]);

        TicketReply::create([

            'ticket_id' => $ticket->id,

            'user_id' => auth()->id(),

            'message' => $request->message,

            'is_admin' => true,

        ]);

        return back()->with(
            'success',
            'Reply sent successfully.'
        );
    }

    public function close(Ticket $ticket)
    {
        $ticket->update([

            'status' => 'closed',

        ]);

        return back()->with(
            'success',
            'Ticket closed successfully.'
        );
    }
}