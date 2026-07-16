<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DashboardController extends Controller
{
    /**
     * Dashboard Staff
     */
    public function index()
{
    // User yang login
    $user = auth()->user();

    // Statistik
    $totalTicket = Ticket::count();

    $todo = Ticket::where('status', 'To Do')->count();

    $progress = Ticket::where('status', 'In Progress')->count();

    $completed = Ticket::where('status', 'Completed')->count();

    // Progress %
    $progressPercent = $totalTicket > 0
        ? round(($completed / $totalTicket) * 100)
        : 0;

    // Tiket terbaru
    $latestTickets = Ticket::with(['user', 'service'])
        ->latest()
        ->take(3)
        ->get();

    // Timeline aktivitas
    $activities = Ticket::latest('updated_at')
        ->take(7)
        ->get();

    return view('staff.dashboard', compact(
        'user',
        'totalTicket',
        'todo',
        'progress',
        'completed',
        'progressPercent',
        'latestTickets',
        'activities'
    ));
}

    /**
     * Kanban Board
     */
    public function kanban(Request $request)
{
    $search = $request->search;
    $status = $request->status;

    // default bulan sekarang
    $month = $request->month ?? now()->format('Y-m');

    $query = Ticket::with(['user', 'service']);

    // Filter bulan
    $query->whereYear('created_at', Carbon::parse($month)->year)
          ->whereMonth('created_at', Carbon::parse($month)->month);

    // Search
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('kode_ticket', 'like', "%{$search}%")
              ->orWhere('judul', 'like', "%{$search}%")
              ->orWhereHas('user', function ($user) use ($search) {
                  $user->where('name', 'like', "%{$search}%");
              });
        });
    }

    // Filter status (opsional)
    if ($status) {
        $query->where('status', $status);
    }

    $tickets = $query->latest()->get();

    $todo = $tickets->where('status', 'To Do');
    $progress = $tickets->where('status', 'In Progress');
    $completed = $tickets->where('status', 'Completed');

    return view('staff.kanban', compact(
        'todo',
        'progress',
        'completed',
        'search',
        'status',
        'month'
    ));
}

}