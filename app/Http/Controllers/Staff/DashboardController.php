<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

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

        $query = Ticket::with(['user', 'service']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_ticket', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($user) use ($search) {
                      $user->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $tickets = $query->latest()->get();

        $todo = $tickets->where('status', 'To Do');
        $progress = $tickets->where('status', 'In Progress');
        $completed = $tickets->where('status', 'Completed');

        return view('staff.kanban', compact(
            'todo',
            'progress',
            'completed',
            'search'
        ));
    }
}