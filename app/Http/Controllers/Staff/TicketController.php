<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Notification;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $tickets = Ticket::with(['user','service'])

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_ticket', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'like', "%{$search}%");
                    });
                });
            })

            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('staff.ticket.index', compact(
            'tickets',
            'search',
            'status'
        ));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed'
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->status = $request->status;

        if ($request->status == 'In Progress' && !$ticket->started_at) {
            $ticket->started_at = now();
        }

        if ($request->status == 'Completed' && !$ticket->completed_at) {
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

        return redirect()
            ->route('staff.ticket.show', $ticket->id)
            ->with('success', 'Status tiket berhasil diperbarui.');
    }
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed',
        ]);

        $ticket->status = $request->status;

        if ($request->status == 'In Progress' && !$ticket->started_at) {
            $ticket->started_at = now();
        }

        if ($request->status == 'Completed' && !$ticket->completed_at) {
            $ticket->completed_at = now();
        }

        $ticket->save();

        Notification::create([
            'user_id' => $ticket->user_id,
            'ticket_id' => $ticket->id,
            'judul' => 'Status Tiket',
            'pesan' => 'Tiket '.$ticket->kode_ticket.' kini berstatus '.$ticket->status,
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true
        ]);
    }
    public function notification(Notification $notification)
    {
        if ($notification->user_id != auth()->id()) {
            abort(403);
        }

        $notification->update([
            'is_read' => true,
        ]);

        return redirect()->route(
            'staff.ticket.show',
            $notification->ticket_id
        );
    }
}