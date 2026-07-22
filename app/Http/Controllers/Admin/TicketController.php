<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;

class TicketController extends Controller
{
   
    public function index(Request $request)
    {
    $admin = auth()->user();

    $query = Ticket::with(['user', 'service.department', 'staff']);

    if ($admin->isScopedToDepartment()) {
        $query->whereHas('service', function ($q) use ($admin) {
            $q->where('department_id', $admin->department_id);
        });
    }

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

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->prioritas) {
        $query->where('prioritas', $request->prioritas);
    }

    $tickets = $query->latest()->paginate(10);

    return view('admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {   
    $admin = auth()->user();

    $ticket->load(['user', 'service', 'staff', 'attachments', 'comments.user']);

    if ($admin->isScopedToDepartment() && $ticket->service->department_id != $admin->department_id) {
        abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
    }

    $staffs = User::where('role', 'staff')
        ->when($admin->isScopedToDepartment(), function ($q) use ($admin) {
            $q->where('department_id', $admin->department_id);
        })
        ->get();

    return view('admin.ticket.detail', compact('ticket', 'staffs'));
    }

    public function edit(Ticket $ticket)
    {
    $admin = auth()->user();

    $ticket->load(['user', 'service', 'staff']);

    if ($admin->isScopedToDepartment() && $ticket->service->department_id != $admin->department_id) {
        abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
    }

    return view('admin.ticket.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
    $admin = auth()->user();
    $ticket->loadMissing('service');

    if ($admin->isScopedToDepartment() && $ticket->service->department_id != $admin->department_id) {
        abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
    }

    $request->validate([
        'status' => 'required|in:To Do,In Progress,Completed',
        'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
    ]);

        if ($request->status == 'In Progress' && !$ticket->started_at) {
            $ticket->started_at = now();
        }

        if ($request->status == 'Completed') {
            $ticket->completed_at = now();
        }

        $statusLama = $ticket->status;

        $ticket->status = $request->status;
        $ticket->prioritas = $request->prioritas;

        $ticket->save();

        if ($statusLama != $ticket->status) {

            Notification::create([
                'user_id'   => $ticket->user_id,
                'ticket_id' => $ticket->id,
                'judul'     => 'Status Tiket',
                'pesan'     => 'Tiket ' . $ticket->kode_ticket . ' kini berstatus ' . $ticket->status,
                'is_read'   => false,
            ]);

        }

        return redirect()
            ->route('admin.ticket.show', $ticket->id)
            ->with('success', 'Status dan prioritas berhasil diperbarui.');
    }

    public function assign(Request $request, Ticket $ticket)
    {
    $admin = auth()->user();
    $ticket->loadMissing('service');

    if ($admin->isScopedToDepartment() && $ticket->service->department_id != $admin->department_id) {
        abort(403, 'Tiket ini bukan bagian dari bidang Anda.');
    }

    $request->validate([
        'staff_id' => 'required|exists:users,id',
    ]);

        $ticket->update([
            'staff_id' => $request->staff_id,
        ]);

        Notification::create([
            'user_id'   => $request->staff_id,
            'ticket_id' => $ticket->id,
            'judul'     => 'Tiket Baru Ditugaskan',
            'pesan'     => 'Anda ditugaskan untuk menangani tiket ' . $ticket->kode_ticket,
            'is_read'   => false,
        ]);

        return redirect()
            ->route('admin.ticket.show', $ticket)
            ->with('success', 'Staff berhasil ditugaskan.');
    }
    public function exportPdf()
    {
    $admin = auth()->user();

    $query = Ticket::with(['user', 'service.department', 'staff']);

    if ($admin->isScopedToDepartment()) {
        $query->whereHas('service', function ($q) use ($admin) {
            $q->where('department_id', $admin->department_id);
        });
    }

    $tickets = $query->get();

    $pdf = Pdf::loadView('admin.ticket.pdf', compact('tickets'));

    return $pdf->download('data-ticket.pdf');
    }

    public function exportExcel()
    {
    $admin = auth()->user();

    $departmentId = $admin->isScopedToDepartment() ? $admin->department_id : null;

    return Excel::download(new TicketsExport($departmentId), 'data-ticket.xlsx');
    }
    public function notification(Notification $notification)
    {
        abort_if($notification->user_id !== auth()->id(), 403);

        if (! $notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        if (! $notification->ticket_id) {
            return redirect()
                ->route('admin.ticket.index')
                ->with('error', 'Tiket terkait notifikasi ini tidak ditemukan.');
        }

        return redirect()->route('admin.ticket.show', $notification->ticket_id);
    }
}