<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

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

        $done = Ticket::where('status', 'Done')->count();

        // 5 tiket terbaru
        $recent = Ticket::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('staff.dashboard', compact(
            'total',
            'todo',
            'progress',
            'done',
            'recent'
        ));
    }

    /**
     * Kanban Board
     */
    public function kanban()
    {
        $todo = Ticket::with(['user', 'service'])
            ->where('status', 'To Do')
            ->latest()
            ->get();

        $progress = Ticket::with(['user', 'service'])
            ->where('status', 'In Progress')
            ->latest()
            ->get();

        $done = Ticket::with(['user', 'service'])
            ->where('status', 'Done')
            ->latest()
            ->get();

        return view('staff.kanban', compact(
            'todo',
            'progress',
            'done'
        ));
    }
}