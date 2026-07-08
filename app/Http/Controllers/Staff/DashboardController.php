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
        // Statistik
        $total = Ticket::count();

        $todo = Ticket::where('status', 'To Do')->count();
        $progress = Ticket::where('status', 'In Progress')->count();
        $completed = Ticket::where('status', 'Completed')->count();

        // 5 tiket terbaru
        $recent = Ticket::with(['user','service'])
            ->latest()
            ->take(5)
            ->get();

        // Timeline aktivitas
        $activities = Ticket::latest('updated_at')
            ->take(5)
            ->get();

        $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
        
        return view('staff.dashboard', compact(
            'total',
            'todo',
            'progress',
            'completed',
            'recent',
            'percent'
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