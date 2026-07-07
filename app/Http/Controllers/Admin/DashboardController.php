<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUser'      => User::where('role', 'user')->count(),
            'totalService'   => Service::count(),
            'totalTicket'    => Ticket::count(),
            'todo'           => Ticket::where('status', 'To Do')->count(),
            'progress'       => Ticket::where('status', 'In Progress')->count(),
            'completed'      => Ticket::where('status', 'Completed')->count(),
        ]);
    }
}
    $todo = Ticket::where('status','To Do')->count();
    $progress = Ticket::where('status','In Progress')->count();
    $completed = Ticket::where('status','Completed')->count();

    return view('admin.dashboard', compact(
        'todo',
        'progress',
        'completed'
    ));
    