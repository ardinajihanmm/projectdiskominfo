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
        $total = Ticket::count();

        $todo = Ticket::where('status', 'To Do')->count();
        $progress = Ticket::where('status', 'In Progress')->count();
        $done = Ticket::where('status', 'Done')->count();

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
        $done = $tickets->where('status', 'Done');

        return view('staff.kanban', compact(
            'todo',
            'progress',
            'done',
            'search'
        ));
    }
}