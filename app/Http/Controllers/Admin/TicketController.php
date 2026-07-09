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
        $query = Ticket::with([
            'user',
            'service',
            'staff'
        ]);

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
        $ticket->load([
            'user',
            'service',
            'staff',
            'attachments',
            'comments.user'
        ]);

        $staffs = User::where('role', 'staff')->get();

        return view('admin.ticket.detail', compact('ticket', 'staffs'));
    }

    /**
     * Halaman edit
     */
    public function edit(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'service',
            'staff'
        ]);

        return view('admin.ticket.edit', compact('ticket'));
    }

    /**
     * Update Status & Prioritas
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
        ]);

        // Simpan waktu mulai
        if ($request->status == 'In Progress' && !$ticket->started_at) {
            $ticket->started_at = now();
        }

        // Simpan waktu selesai
        if ($request->status == 'Completed') {
            $ticket->completed_at = now();
        }

        $ticket->status = $request->status;
        $ticket->prioritas = $request->prioritas;

        $ticket->save();

        return redirect()
            ->route('admin.ticket.show', $ticket->id)
            ->with('success', 'Status dan prioritas berhasil diperbarui.');
    }

    /**
     * Assign Staff
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'staff_id' => 'required|exists:users,id',
        ]);

        $ticket->staff_id = $request->staff_id;
        $ticket->save();

        return redirect()
            ->route('admin.ticket.show', $ticket->id)
            ->with('success', 'Staff berhasil ditugaskan.');
    }

    /**
     * Export PDF
     */
    public function exportPdf()
    {
        $tickets = Ticket::with([
            'user',
            'service',
            'staff'
        ])->get();

        $pdf = Pdf::loadView('admin.ticket.pdf', compact('tickets'));

        return $pdf->download('data-ticket.pdf');
    }

    /**
     * Export Excel
     */
    public function exportExcel()
    {
        return Excel::download(new TicketsExport, 'data-ticket.xlsx');
    }
}