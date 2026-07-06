<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalTicket = Ticket::where('user_id', $user->id)->count();

        $todo = Ticket::where('user_id', $user->id)
            ->where('status', 'To Do')
            ->count();

        $progress = Ticket::where('user_id', $user->id)
            ->where('status', 'In Progress')
            ->count();

        $done = Ticket::where('user_id', $user->id)
            ->where('status', 'Done')
            ->count();

        return view('user.dashboard', compact(
            'user',
            'totalTicket',
            'todo',
            'progress',
            'done'
        ));
    }
}