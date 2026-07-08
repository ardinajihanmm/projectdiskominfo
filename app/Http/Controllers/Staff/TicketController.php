<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Notification;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);

        return view('staff.ticket.index', compact('tickets'));
    }

    public function show($id)
    {

        $ticket = Ticket::with([
            'user',
            'service',
            'comments.user',
            'attachments',
            'comments.user'
        ])->findOrFail($id);

        return view('staff.ticket.detail', compact('ticket'));

    }

    public function updateStatus(Request $request, $id)
{
    try {

        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed'
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->status = $request->status;

        if($request->status == 'In Progress'){
            $ticket->started_at = now();
        }

        if($request->status == 'Completed'){
            $ticket->completed_at = now();
        }

        $ticket->save();
        Notification::create([
    'user_id'   => $ticket->user_id,
    'ticket_id' => $ticket->id,
    'judul'     => 'Status Tiket',
    'pesan'     => 'Tiket '.$ticket->kode_ticket.' kini berstatus '.$ticket->status,
    'is_read'   => false,
]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ],500);

    }
}

}