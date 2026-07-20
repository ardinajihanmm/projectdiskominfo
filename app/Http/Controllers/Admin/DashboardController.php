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
        /*
        |--------------------------------------------------------------------------
        | Ringkasan Dashboard
        |--------------------------------------------------------------------------
        */

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

        // Rata-rata poin SLA (ikut scope bidang admin)
        $completedWithPoint = (clone $ticketBase)
            ->where('status', 'Completed')
            ->whereNotNull('point')
            ->get();

        $averagePoint = $completedWithPoint->count() > 0
            ? round($completedWithPoint->avg('point'))
            : null;

        /*
        |--------------------------------------------------------------------------
        | Timeline Aktivitas
        |--------------------------------------------------------------------------
        */

        $activities = (clone $ticketBase)->latest('updated_at')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Semua Layanan (dipakai untuk Quick Menu & Filter Layanan)
        |--------------------------------------------------------------------------
        */

        $services = (clone $serviceBase)->orderBy('nama_layanan')->get();

        /*
        |--------------------------------------------------------------------------
        | Data untuk Filter Statistik Tiket (Bulan & Tahun)
        |--------------------------------------------------------------------------
        */

        $months = $this->monthNames();
        $years = $this->availableYears();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', [

            'totalUser' => $totalUser,
            'totalService' => $totalService,
            'totalTicket' => $totalTicket,

            'todo' => $todo,
            'progress' => $progress,
            'completed' => $completed,

            'progressPercent' => $progressPercent,
            'averagePoint' => $averagePoint,

            'activities' => $activities,

            'services' => $services,

            'months' => $months,
            'years' => $years,

        ]);
    }

    /**
     * Endpoint AJAX untuk Statistik Tiket.
     * Menerima kombinasi filter month + year + service sekaligus (AND),
     * lalu mengembalikan hitungan status tiket hasil filter tersebut.
     * Dipanggil oleh resources/js/chart.js setiap ada perubahan filter,
     * jadi ketiga filter selalu dikirim bersamaan (tidak saling menimpa).
     */
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

    /**
     * Terapkan filter bulan, tahun, dan layanan ke query tiket.
     * Filter yang tidak diisi (kosong) otomatis diabaikan,
     * sedangkan filter yang diisi digabung dengan AND.
     */
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

    /**
     * Daftar nama bulan (1-12) dalam Bahasa Indonesia, dipakai untuk
     * mengisi dropdown Filter Bulan dan diseragamkan di satu tempat
     * supaya tidak ada duplikasi array bulan di bagian lain controller.
     */
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

    /**
     * Daftar tahun yang tersedia untuk Filter Tahun, diambil dari tahun-tahun
     * yang benar-benar ada tiketnya, ditambah tahun berjalan (supaya tahun
     * ini selalu muncul walau belum ada tiket sama sekali), diurutkan terbaru dulu.
     */
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