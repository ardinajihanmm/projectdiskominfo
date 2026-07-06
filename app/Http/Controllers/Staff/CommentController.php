<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

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

    return back()->with(
        'success',
        'Komentar berhasil dikirim.'
    );
}
}