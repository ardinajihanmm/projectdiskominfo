<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ringkasan Dashboard
        |--------------------------------------------------------------------------
        */

        $totalUser = User::where('role', 'user')->count();
        $totalService = Service::count();
        $totalTicket = Ticket::count();

        $todo = Ticket::where('status', 'To Do')->count();
        $progress = Ticket::where('status', 'In Progress')->count();
        $completed = Ticket::where('status', 'Completed')->count();

        $progressPercent = $totalTicket > 0
            ? round(($completed / $totalTicket) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Timeline Aktivitas
        |--------------------------------------------------------------------------
        */

        $activities = Ticket::latest('updated_at')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Semua Layanan
        |--------------------------------------------------------------------------
        */

        $services = Service::orderBy('nama_layanan')->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik Bulanan
        |--------------------------------------------------------------------------
        */

       $chartData = Ticket::selectRaw("
            DATE_FORMAT(created_at, '%Y-%m') as ym,
            SUM(status='To Do') as todo,
            SUM(status='In Progress') as progress,
            SUM(status='Completed') as completed,
            COUNT(*) as total
        ")
        ->groupBy('ym')
        ->orderBy('ym')
        ->get()
        ->keyBy('ym');

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $monthlyLabels = [];
        $monthlyTotals = [];
        $monthlyTodo = [];
        $monthlyProgress = [];
        $monthlyCompleted = [];
        $jumlahBulan = 6;
        
        for ($i = $jumlahBulan - 1; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subMonths($i);
            $key = $tanggal->format('Y-m'); // "2026-07"

            $monthlyLabels[] = $namaBulan[(int) $tanggal->format('n')] . ' ' . $tanggal->format('Y'); // "Juli 2026"

            $row = $chartData->get($key);

            $monthlyTotals[]    = $row ? (int) $row->total : 0;
            $monthlyTodo[]      = $row ? (int) $row->todo : 0;
            $monthlyProgress[]  = $row ? (int) $row->progress : 0;
            $monthlyCompleted[] = $row ? (int) $row->completed : 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Statistik Per Layanan
        |--------------------------------------------------------------------------
        */

        $serviceData = Ticket::selectRaw("
                service_id,
                SUM(status='To Do') as todo,
                SUM(status='In Progress') as progress,
                SUM(status='Completed') as completed,
                COUNT(*) as total
            ")
            ->with('service')
            ->groupBy('service_id')
            ->get();

        $serviceLabels = [];
        $serviceTotals = [];
        $serviceTodo = [];
        $serviceProgress = [];
        $serviceCompleted = [];

        foreach ($serviceData as $item) {

            $serviceLabels[] = optional($item->service)->nama_layanan ?? '-';
            $serviceTotals[] = (int) $item->total;
            $serviceTodo[] = (int) $item->todo;
            $serviceProgress[] = (int) $item->progress;
            $serviceCompleted[] = (int) $item->completed;
        }

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

            'activities' => $activities,

            'services' => $services,

            'chartData' => $chartData,

            'monthlyLabels' => $monthlyLabels,
            'monthlyTotals' => $monthlyTotals,
            'monthlyTodo' => $monthlyTodo,
            'monthlyProgress' => $monthlyProgress,
            'monthlyCompleted' => $monthlyCompleted,

            'serviceLabels' => $serviceLabels,
            'serviceTotals' => $serviceTotals,
            'serviceTodo' => $serviceTodo,
            'serviceProgress' => $serviceProgress,
            'serviceCompleted' => $serviceCompleted,

        ]);
    }
}