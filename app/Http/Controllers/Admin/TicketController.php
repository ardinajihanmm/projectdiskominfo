<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;

class TicketController extends Controller
{
    /**
     * Daftar semua tiket
     */
public function index(Request $request)
{
    $query = Ticket::with(['user','service','staff']);

    // Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%')
              ->orWhere('kode_ticket', 'like', '%' . $request->search . '%')
              ->orWhereHas('user', function ($user) use ($request) {
                  $user->where('name', 'like', '%' . $request->search . '%');
              })
              ->orWhereHas('service', function ($service) use ($request) {
                  $service->where('nama_layanan', 'like', '%' . $request->search . '%');
              });
        });
    }

    // Filter Status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // Filter Prioritas
    if ($request->prioritas) {
        $query->where('prioritas', $request->prioritas);
    }

    $tickets = $query->latest()->paginate(10);

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
            'status' => 'required|in:To Do,In Progress,Complete',
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

    public function exportPdf()
    {
    $tickets = Ticket::with(['user','service','staff'])->get();

    $pdf = Pdf::loadView('admin.ticket.pdf', compact('tickets'));

    return $pdf->download('data-ticket.pdf');
    }

    public function exportExcel()
    {
    return Excel::download(new TicketsExport, 'data-ticket.xlsx');
    }
}