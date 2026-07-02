<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $todo = Ticket::where('status', 'To Do')->count();

        $progress = Ticket::where('status', 'In Progress')->count();

        $completed = Ticket::where('status', 'Completed')->count();

        $tickets = Ticket::latest()
                    ->take(5)
                    ->get();

        return view('staff.dashboard', compact(
            'todo',
            'progress',
            'completed',
            'tickets'
        ));
    }
}