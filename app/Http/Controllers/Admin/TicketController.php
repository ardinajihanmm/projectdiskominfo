<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Daftar semua tiket
     */
    public function index()
    {
        $tickets = Ticket::with(['user', 'service', 'staff'])
            ->latest()
            ->get();

        return view('admin.ticket.index', compact('tickets'));
    }

    /**
     * Detail tiket
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'service', 'attachment', 'staff']);

        $staffs = User::where('role', 'staff')->get();

        return view('admin.ticket.detail', compact('ticket', 'staffs'));
    }

    /**
     * Halaman edit status
     */
    public function edit(Ticket $ticket)
    {
        $ticket->load(['user', 'service']);

        return view('admin.ticket.edit', compact('ticket'));
    }

    /**
     * Update status tiket
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Done',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.ticket.index')
            ->with('success', 'Status tiket berhasil diubah.');
    }

    /**
     * Assign staff
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'staff_id' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'staff_id' => $request->staff_id,
        ]);

        return redirect()
            ->route('admin.ticket.show', $ticket->id)
            ->with('success', 'Staff berhasil ditugaskan.');
    }
}