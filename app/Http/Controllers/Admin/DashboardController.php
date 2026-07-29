<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Notification;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = auth()->user();

        $ticketBase = Ticket::query();
        $serviceBase = Service::query();

        if ($admin->isScopedToDepartment()) {
            $ticketBase->whereHas('service', fn ($q) => $q->where('department_id', $admin->department_id));
            $serviceBase->where('department_id', $admin->department_id);
        }

        $totalUser = User::where('role', 'user')->count();
        $totalService = (clone $serviceBase)->count();
        $totalTicket = (clone $ticketBase)->count();

        $todo = (clone $ticketBase)->where('status', 'To Do')->count();
        $progress = (clone $ticketBase)->where('status', 'In Progress')->count();
        $completed = (clone $ticketBase)->where('status', 'Completed')->count();

        $progressPercent = $totalTicket > 0 ? round(($completed / $totalTicket) * 100) : 0;

        $completedWithPoint = (clone $ticketBase)
            ->where('status', 'Completed')
            ->whereNotNull('point')
            ->get();

        $averagePoint = $completedWithPoint->isNotEmpty()
            ? round($completedWithPoint->avg('point'))
            : null;

        $tepatWaktu = $completedWithPoint->where('point', '>=', 100)->count();
        $telat = $completedWithPoint->where('point', '<', 100)->count();

        $activities = (clone $ticketBase)->latest('updated_at')->take(5)->get();
        $services = (clone $serviceBase)->orderBy('nama_layanan')->get();

        $departments = $admin->isSuperAdmin()
            ? Department::orderBy('nama_bidang')->get()
            : collect();

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
            'departments' => $departments,
            'months' => $this->monthNames(),
            'years' => $this->availableYears(),
        ]);
    }

    public function ticketStats(Request $request): JsonResponse
    {
        $admin = auth()->user();
        $query = Ticket::query();

        if ($admin->isScopedToDepartment()) {
            $query->whereHas('service', fn ($q) => $q->where('department_id', $admin->department_id));
        }

        $query = $this->applyTicketFilters($query, $request, $admin->isSuperAdmin());

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

    private function applyTicketFilters(Builder $query, Request $request, bool $isSuperAdmin): Builder
    {
        if ($request->filled('month')) {
            $bulan = (int) $request->month;
            if ($bulan >= 1 && $bulan <= 12) {
                $query->whereMonth('created_at', $bulan);
            }
        }

        if ($request->filled('year')) {
            $tahun = (int) $request->year;
            if ($tahun >= 2000 && $tahun <= 2099) {
                $query->whereYear('created_at', $tahun);
            }
        }

        // Hanya super admin yang boleh filter berdasarkan bidang
        if ($isSuperAdmin && $request->filled('department')) {
            $departmentId = (int) $request->department;
            if ($departmentId > 0) {
                $query->whereHas('service', fn ($q) => $q->where('department_id', $departmentId));
            }
        }

        if ($request->filled('service')) {
            $serviceId = (int) $request->service;
            if ($serviceId > 0) {
                $query->where('service_id', $serviceId);
            }
        }

        return $query;
    }

    public function services(): JsonResponse
    {
        $admin = auth()->user();
        $query = Service::query();

        if ($admin->isScopedToDepartment()) {
            $query->where('department_id', $admin->department_id);
        }

        return response()->json(
            $query->select('id', 'nama_layanan', 'department_id')->orderBy('nama_layanan')->get()
        );
    }

    public function servicesByDepartment($department): JsonResponse
    {
        $admin = auth()->user();
        $departmentId = (int) $department;

        if ($admin->isScopedToDepartment() && (int) $admin->department_id !== $departmentId) {
            abort(403);
        }

        return response()->json(
            Service::where('department_id', $departmentId)
                ->select('id', 'nama_layanan', 'department_id')
                ->orderBy('nama_layanan')
                ->get()
        );
    }

    public function markAsRead($id)
    {
        $notif = Notification::where('user_id', auth()->id())
            ->findOrFail($id);

        $notif->update([
            'is_read' => true,
        ]);

        return redirect()->back();
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
            $query->whereHas('service', fn ($q) => $q->where('department_id', $admin->department_id));
        }

        $years = $query->selectRaw('DISTINCT YEAR(created_at) as year')->pluck('year')->map(fn ($year) => (int) $year);

        return $years->push(now()->year)->unique()->sortDesc()->values()->all();
    }
}