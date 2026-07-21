<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Notification; 

class CommentController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'ticket_id' => 'required|exists:tickets,id',
        'komentar'  => 'required'
    ]);

    Comment::create([
        'ticket_id' => $request->ticket_id,
        'user_id'   => auth()->id(),
        'komentar'  => $request->komentar
    ]);
    $ticket = Ticket::find($request->ticket_id);

    Notification::create([
        'user_id'   => $ticket->user_id,
        'ticket_id' => $ticket->id,
        'judul'     => 'Komentar Baru',
        'pesan'     => 'Staff memberikan balasan pada tiket '.$ticket->kode_ticket,
        'is_read'   => false,
    ]);
        return back()->with(
            'success',
            'Komentar berhasil dikirim.'
        );
    }
}