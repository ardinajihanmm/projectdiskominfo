@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>Dashboard Admin</h2>

    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5>Total User</h5>
                    <h2>{{ $totalUser }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5>Total Layanan</h5>
                    <h2>{{ $totalService }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-dark text-white">
                <div class="card-body text-center">
                    <h5>Total Tiket</h5>
                    <h2>{{ $totalTicket }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-4 mb-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h5>To Do</h5>
                    <h2>{{ $todo }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-info">
                <div class="card-body text-center">
                    <h5>In Progress</h5>
                    <h2>{{ $progress }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h5>Done</h5>
                    <h2>{{ $done }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Action --}}
<div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">
    <i class="bi bi-grid-1x2-fill me-2 text-primary"></i>
    Quick Action
</h5>
    </div>

    <div class="card-body">

        <div class="row g-3">

            <div class="col-md-4">
                <a href="{{ route('admin.user.index') }}"
                   class="btn btn-outline-primary w-100 py-4">

                    <i class="bi bi-people-fill fs-1"></i><br>

                    <strong>Kelola User</strong><br>

                    <small>Tambah, edit, dan hapus user</small>

                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.service.index') }}"
                   class="btn btn-outline-success w-100 py-4">

                    <i class="bi bi-tools fs-1"></i><br>

                    <strong>Kelola Layanan</strong><br>

                    <small>Manajemen layanan</small>

                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('admin.ticket.index') }}"
                   class="btn btn-outline-warning w-100 py-4">

                    <i class="bi bi-ticket-perforated-fill fs-1"></i><br>

                    <strong>Kelola Tiket</strong><br>

                    <small>Lihat dan ubah status tiket</small>

                </a>
            </div>

        </div>

    </div>
</div>

<div class="card shadow mt-4">
    <div class="card-header bg-primary text-white">
        Statistik Tiket
    </div>

    <div class="card-body">
        <canvas id="ticketChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx=document.getElementById('ticketChart');

new Chart(ctx,{
    type:'bar',
    data:{
        labels:['To Do','In Progress','Done'],
        datasets:[{
            label:'Jumlah Tiket',
            data:[
                {{ $todo }},
                {{ $progress }},
                {{ $done }}
            ],
            backgroundColor:[
                '#ffc107',
                '#0dcaf0',
                '#198754'
            ]
        }]
    }
});
</script>

@endsection
