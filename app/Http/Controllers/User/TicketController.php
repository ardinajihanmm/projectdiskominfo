<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Form buat tiket
     */
    public function create()
    {
        $services = Service::all();

        return view('user.ticket.create', compact('services'));
    }

    /**
     * Simpan tiket
     */
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

        if ($request->hasFile('lampiran')) {

            $path = $request->file('lampiran')->store('attachments', 'public');

            Attachment::create([
                'ticket_id' => $ticket->id,
                'nama_file' => $request->file('lampiran')->getClientOriginalName(),
                'file_path' => $path,
            ]);
        }

        return redirect('/user/ticket/history')
            ->with('success', 'Pengajuan tiket berhasil dibuat.');
    }

    /**
     * Riwayat tiket user
     */
    public function history()
    {
        $tickets = Ticket::with('service')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.ticket.history', compact('tickets'));
    }

    /**
     * Detail tiket
     */
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
}