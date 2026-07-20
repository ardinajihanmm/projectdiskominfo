<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $admin = auth()->user();
        $month = $request->month ?? now()->format('Y-m');

        // Tiket yang sudah selesai & sudah dihitung poinnya
        $baseQuery = Ticket::with(['staff', 'service.department'])
            ->where('status', 'Completed')
            ->whereNotNull('point')
            ->whereYear('completed_at', substr($month, 0, 4))
            ->whereMonth('completed_at', substr($month, 5, 2));

        if ($admin->isScopedToDepartment()) {
            $baseQuery->whereHas('service', function ($q) use ($admin) {
                $q->where('department_id', $admin->department_id);
            });
        }

        $completedTickets = $baseQuery->get();

        // Rekap per staff
        $staffReport = $completedTickets
            ->filter(fn ($ticket) => $ticket->staff_id)
            ->groupBy('staff_id')
            ->map(function ($tickets) {
                $staff = $tickets->first()->staff;

                return [
                    'staff' => $staff,
                    'total_tiket' => $tickets->count(),
                    'rata_rata_poin' => round($tickets->avg('point'), 2),
                    'total_poin' => round($tickets->sum('point'), 2),
                    'tepat_waktu' => $tickets->where('point', '>=', 100)->count(),
                    'telat' => $tickets->where('point', '<', 100)->count(),
                ];
            })
            ->sortByDesc('rata_rata_poin')
            ->values();

        // Rekap per bidang
        $departmentReport = $completedTickets
            ->filter(fn ($ticket) => $ticket->service && $ticket->service->department)
            ->groupBy(fn ($ticket) => $ticket->service->department->id)
            ->map(function ($tickets) {
                $department = $tickets->first()->service->department;

                return [
                    'department' => $department,
                    'total_tiket' => $tickets->count(),
                    'rata_rata_poin' => round($tickets->avg('point'), 2),
                ];
            })
            ->sortByDesc('rata_rata_poin')
            ->values();

        // Ringkasan keseluruhan
        $totalCompleted = $completedTickets->count();
        $overallAverage = $totalCompleted > 0
            ? round($completedTickets->avg('point'), 2)
            : 0;
        $totalTepatWaktu = $completedTickets->where('point', '>=', 100)->count();
        $totalTelat = $completedTickets->where('point', '<', 100)->count();

        $months = collect(range(0, 11))->map(function ($i) {
            $date = now()->subMonths($i);
            return [
                'value' => $date->format('Y-m'),
                'label' => $date->translatedFormat('F Y'),
            ];
        });

        return view('admin.report.index', compact(
            'staffReport',
            'departmentReport',
            'totalCompleted',
            'overallAverage',
            'totalTepatWaktu',
            'totalTelat',
            'month',
            'months'
        ));
    }
}