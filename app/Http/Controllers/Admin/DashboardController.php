<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
   
        $admin = auth()->user();

        $ticketBase = Ticket::query();
        $serviceBase = Service::query();

        if ($admin->isScopedToDepartment()) {
            $ticketBase->whereHas('service', function ($q) use ($admin) {
                $q->where('department_id', $admin->department_id);
            });

            $serviceBase->where('department_id', $admin->department_id);
        }

        $totalUser = User::where('role', 'user')->count();
        $totalService = (clone $serviceBase)->count();
        $totalTicket = (clone $ticketBase)->count();

        $todo = (clone $ticketBase)->where('status', 'To Do')->count();
        $progress = (clone $ticketBase)->where('status', 'In Progress')->count();
        $completed = (clone $ticketBase)->where('status', 'Completed')->count();

        $progressPercent = $totalTicket > 0
            ? round(($completed / $totalTicket) * 100)
            : 0;

        $completedWithPoint = (clone $ticketBase)
            ->where('status', 'Completed')
            ->whereNotNull('point')
            ->get();

        $averagePoint = $completedWithPoint->count() > 0
            ? round($completedWithPoint->avg('point'))
            : null;

        $tepatWaktu = $completedWithPoint->where('point', '>=', 100)->count();
        $telat = $completedWithPoint->where('point', '<', 100)->count();
            
        $activities = (clone $ticketBase)->latest('updated_at')
            ->take(5)
            ->get();


        $services = (clone $serviceBase)->orderBy('nama_layanan')->get();

        $months = $this->monthNames();
        $years = $this->availableYears();

        return view('admin.dashboard', [

    'totalUser' => $totalUser,
    'totalService' => $totalService,
    'totalTicket' => $totalTicket,

    'todo' => $todo,
    'progress' => $progress,
    'completed' => $completed,

    'progressPercent' => $progressPercent,
    'averagePoint' => $averagePoint,
    'tepatWaktu' => $tepatWaktu,
    'telat' => $telat,

    'activities' => $activities,

    'services' => $services,

    'months' => $months,
    'years' => $years,

]);
    }

    public function ticketStats(Request $request): JsonResponse
    {
        $admin = auth()->user();

        $query = Ticket::query();

        if ($admin->isScopedToDepartment()) {
            $query->whereHas('service', function ($q) use ($admin) {
                $q->where('department_id', $admin->department_id);
            });
        }

        $query = $this->applyTicketFilters($query, $request);

        $todo = (clone $query)->where('status', 'To Do')->count();
        $progress = (clone $query)->where('status', 'In Progress')->count();
        $completed = (clone $query)->where('status', 'Completed')->count();

        return response()->json([
            'todo' => $todo,
            'progress' => $progress,
            'completed' => $completed,
            'total' => $todo + $progress + $completed,
        ]);
    }

    private function applyTicketFilters(\Illuminate\Database\Eloquent\Builder $query, Request $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($request->filled('month')) {
            $query->whereMonth('created_at', (int) $request->input('month'));
        }

        if ($request->filled('year')) {
            $query->whereYear('created_at', (int) $request->input('year'));
        }

        if ($request->filled('service')) {
            $query->where('service_id', (int) $request->input('service'));
        }

        return $query;
    }

    private function monthNames(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    private function availableYears(): array
    {
        $admin = auth()->user();

        $query = Ticket::query();

        if ($admin->isScopedToDepartment()) {
            $query->whereHas('service', function ($q) use ($admin) {
                $q->where('department_id', $admin->department_id);
            });
        }

        $years = $query->selectRaw('DISTINCT YEAR(created_at) as year')
            ->pluck('year')
            ->map(fn ($year) => (int) $year);

        return $years
            ->push(now()->year)
            ->unique()
            ->sortDesc()
            ->values()
            ->all();
    }
}