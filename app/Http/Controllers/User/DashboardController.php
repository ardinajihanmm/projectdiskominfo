<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
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

    $completed = Ticket::where('user_id', $user->id)
        ->where('status', 'Completed')
        ->count();

    // Persentase penyelesaian
    $progressPercent = $totalTicket > 0
        ? round(($completed / $totalTicket) * 100)
        : 0;

    // 5 tiket terbaru
    $latestTickets = Ticket::with('service')
        ->where('user_id', $user->id)
        ->latest()
        ->take(5)
        ->get();

    $latestTicket = Ticket::where('user_id', Auth::id())
    ->latest()
    ->first();


    $activities = Notification::where('user_id', Auth::id())
    ->latest()
    ->take(8)
    ->get();

    return view('user.dashboard', compact(
        'user',
        'totalTicket',
        'todo',
        'progress',
        'completed',
        'progressPercent',
        'latestTickets',
        'latestTicket',
        'activities'
    ));
}
public function markAsRead(Notification $notification)
{
    // Pastikan notifikasi milik user yang sedang login
    if ($notification->user_id != Auth::id()) {
        abort(403);
    }

    $notification->update([
        'is_read' => true
    ]);

    return back()->with('success', 'Notifikasi telah ditandai sebagai sudah dibaca.');
}
}