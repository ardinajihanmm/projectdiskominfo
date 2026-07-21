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

        // Tiket dibatasi hanya untuk bidang staff ini, dan
        // hanya yang belum diambil atau sudah menjadi milik staff ini
        $baseQuery = Ticket::whereHas('service', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            })
            ->where(function ($q) use ($user) {
                $q->whereNull('staff_id')
                  ->orWhere('staff_id', $user->id);
            });

        // Statistik
        $totalTicket = (clone $baseQuery)->count();
        $todo = (clone $baseQuery)->where('status', 'To Do')->count();
        $progress = (clone $baseQuery)->where('status', 'In Progress')->count();
        $completed = (clone $baseQuery)->where('status', 'Completed')->count();

        // Progress %
        $progressPercent = $totalTicket > 0
            ? round(($completed / $totalTicket) * 100)
            : 0;
// Rata-rata poin SLA dari tiket yang sudah diselesaikan staff ini
$myCompletedTickets = (clone $baseQuery)
    ->where('status', 'Completed')
    ->where('staff_id', $user->id)
    ->whereNotNull('point')
    ->get();

$myAveragePoint = $myCompletedTickets->count() > 0
    ? round($myCompletedTickets->avg('point'))
    : null;

$myTepatWaktu = $myCompletedTickets->where('point', '>=', 100)->count();
$myTelat = $myCompletedTickets->where('point', '<', 100)->count();

        // Tiket terbaru
        $latestTickets = (clone $baseQuery)->with(['user', 'service'])
            ->latest()
            ->take(3)
            ->get();

        // Timeline aktivitas
        $activities = (clone $baseQuery)->latest('updated_at')
            ->take(7)
            ->get();

       return view('staff.dashboard', compact(
    'user', 'totalTicket', 'todo', 'progress',
    'completed', 'progressPercent', 'latestTickets', 'activities',
    'myAveragePoint', 'myTepatWaktu', 'myTelat'
));
    }

    /**
     * Kanban Board
     */
    public function kanban(Request $request)
    {
        $search = $request->search;
        $status = $request->status;
        $month = $request->month ?? now()->format('Y-m');
        $user = auth()->user();

        $query = Ticket::with(['user', 'service', 'staff'])
            ->whereHas('service', function ($q) use ($user) {
                $q->where('department_id', $user->department_id);
            })
            ->where(function ($q) use ($user) {
                $q->whereNull('staff_id')
                  ->orWhere('staff_id', $user->id);
            });

        $query->whereYear('created_at', Carbon::parse($month)->year)
              ->whereMonth('created_at', Carbon::parse($month)->month);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_ticket', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($user) use ($search) {
                      $user->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $tickets = $query->latest()->get();

        $todo = $tickets->where('status', 'To Do');
        $progress = $tickets->where('status', 'In Progress');
        $completed = $tickets->where('status', 'Completed');

        return view('staff.kanban', compact(
            'todo', 'progress', 'completed', 'search', 'status', 'month'
        ));
    }
}