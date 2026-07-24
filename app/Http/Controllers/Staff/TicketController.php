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
        $user = auth()->user();

        $tickets = Ticket::with(['user','service','staff'])

            ->whereHas('service', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            })

            ->where(function ($q) use ($user) {
                $q->whereNull('staff_id')
                  ->orWhere('staff_id', $user->id);
            })

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
                'staff',
                'attachments',
                'comments.user'
            ])->findOrFail($id);

            $user = auth()->user();

            if ($ticket->service->department_id != $user->department_id) {
                abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
            }

            if ($ticket->staff_id && $ticket->staff_id != $user->id) {
                return redirect()
                    ->route('staff.ticket.index')
                    ->with('error', 'Tiket ini sudah ditangani oleh staff lain.');
            }

            return view('staff.ticket.detail', compact('ticket'));
        }

        public function assignSelf($id)
        {
        $ticket = Ticket::with('service')->findOrFail($id);
        $user = auth()->user();

        if ($ticket->service->department_id != $user->department_id) {
            abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
        }

        if ($ticket->staff_id) {
            return back()->with('error', 'Tiket ini sudah diambil oleh staff lain.');
        }

        $ticket->staff_id = $user->id;
        $ticket->save();

        Notification::create([
            'user_id'   => $ticket->user_id,
            'ticket_id' => $ticket->id,
            'judul'     => 'Tiket Diambil Staff',
            'pesan'     => 'Tiket '.$ticket->kode_ticket.' sedang ditangani oleh '.$user->name,
            'is_read'   => false,
        ]);

        return back()->with('success', 'Tiket berhasil diambil, sekarang tiket ini milik Anda.');
        }

        public function update(Request $request, $id)
        {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed'
        ]);

        $ticket = Ticket::with('service')->findOrFail($id);
        $user = auth()->user();

        if ($ticket->service->department_id != $user->department_id) {
            abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
        }

        if ($ticket->staff_id && $ticket->staff_id != $user->id) {
            return back()->with('error', 'Tiket ini sudah ditangani oleh staff lain.');
        }

        if (!$ticket->staff_id) {
            $ticket->staff_id = $user->id;
        }

        $ticket->status = $request->status;

        if ($request->status == 'In Progress' && !$ticket->started_at) {
            $ticket->started_at = now();
        }

        if ($request->status == 'Completed' && !$ticket->completed_at) {
            $ticket->completed_at = now();
            $ticket->point = $ticket->calculatePoint();
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

        $user = auth()->user();
        $ticket->loadMissing('service');

        if ($ticket->service->department_id != $user->department_id) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket ini bukan bagian dari bidang Anda.',
            ], 403);
        }

        if ($ticket->staff_id && $ticket->staff_id != $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket ini sudah ditangani oleh staff lain.',
            ], 403);
        }

        if (!$ticket->staff_id) {
            $ticket->staff_id = $user->id;
        }

        $ticket->status = $request->status;

        if ($request->status == 'In Progress' && !$ticket->started_at) {
            $ticket->started_at = now();
        }

        if ($request->status == 'Completed' && !$ticket->completed_at) {
            $ticket->completed_at = now();
            $ticket->point = $ticket->calculatePoint();
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
        public function markAllRead()
        {
            \App\Models\Notification::where('user_id', auth()->id())
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
        }
}