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
        $totalUser = User::where('role', 'user')->count();
        $totalService = Service::count();
        $totalTicket = Ticket::count();
        $todo = Ticket::where('status', 'To Do')->count();
        $progress = Ticket::where('status', 'In Progress')->count();
        $completed = Ticket::where('status', 'Completed')->count();

        $progressPercent = $totalTicket > 0
            ? round(($completed / $totalTicket) * 100)
            : 0;

       return view('admin.dashboard',[
            'totalUser'=>$totalUser,
            'totalService'=>$totalService,
            'totalTicket'=>$totalTicket,
            'todo'=>$todo,
            'progress'=>$progress,
            'completed'=>$completed,
            'progressPercent'=>$progressPercent,
        ]);
    }
}