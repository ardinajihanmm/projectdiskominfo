<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TicketController extends Controller
{
    public function create()
    {
        $services = Service::all();

        return view('user.ticket.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'judul'      => 'required|max:255',
            'deskripsi'  => 'required',
            'lampiran'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = Ticket::create([
            'user_id'      => Auth::id(),
            'service_id'   => $request->service_id,
            'kode_ticket'  => 'TCK-' . strtoupper(Str::random(8)),
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'prioritas'    => 'Sedang',
            'status'       => 'To Do',
        ]);

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id'   => $admin->id,
                'ticket_id' => $ticket->id,
                'judul'     => 'Pengajuan Tiket Baru',
                'pesan'     => Auth::user()->name . ' membuat tiket "' . $ticket->judul . '"',
                'is_read'   => false,
            ]);
        }

        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('attachments', 'public');
            Attachment::create([
                'ticket_id' => $ticket->id,
                'nama_file' => $request->file('lampiran')->getClientOriginalName(),
                'path_file' => $path,
            ]);
        }
        return redirect()->route('user.ticket.history')
            ->with('success', 'Pengajuan tiket berhasil dibuat.');
    }
    public function storeComment(Request $request, \App\Models\Ticket $ticket)
    {
    if ($ticket->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'komentar' => 'required|string|max:2000',
    ]);

    $ticket->comments()->create([
        'user_id' => auth()->id(),
        'komentar' => $request->komentar,
    ]);

     if ($ticket->staff_id) {
        Notification::create([
            'user_id'   => $ticket->staff_id,
            'ticket_id' => $ticket->id,
            'judul'     => 'Komentar Baru',
            'pesan'     => auth()->user()->name .
                           ' memberikan balasan pada tiket ' .
                           $ticket->kode_ticket,
            'is_read'   => false,
        ]);
    }

    return back()->with('success', 'Balasan berhasil dikirim.');
    }

        public function history(Request $request)
    {
    $query = Ticket::with('service')
        ->where('user_id', Auth::id());
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('kode_ticket', 'like', "%{$search}%")
              ->orWhere('judul', 'like', "%{$search}%");
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $tickets = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();
    return view('user.ticket.history', compact('tickets'));
    }

    public function detail($id)
    {
        $ticket = Ticket::with([
            'service',
            'attachments',
            'comments.user'
        ])
        ->where('user_id', Auth::id())
        ->findOrFail($id);
        return view('user.ticket.detail', compact('ticket'));
    }
    public function markAllRead()
    {
        \App\Models\Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
