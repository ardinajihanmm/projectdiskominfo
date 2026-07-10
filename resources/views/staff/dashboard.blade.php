@extends('layouts.staff')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            <i class="bi bi-speedometer2"></i>
            Dashboard Staff
        </h2>
        <small class="text-muted">
            Ringkasan aktivitas helpdesk
        </small>
    </div>

</div>

{{-- Statistik --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-5 border-primary">
            <div class="card-body">
                <small class="text-muted">Total Tiket</small>
                <h2 class="fw-bold">{{ $total }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-5 border-warning">
            <div class="card-body">
                <small class="text-muted">To Do</small>
                <h2 class="fw-bold text-warning">{{ $todo }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-5 border-info">
            <div class="card-body">
                <small class="text-muted">In Progress</small>
                <h2 class="fw-bold text-info">{{ $progress }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-5 border-success">
            <div class="card-body">
                <small class="text-muted">Completed</small>
                <h2 class="fw-bold text-success">{{ $completed }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="row">

    {{-- KIRI --}}
    <div class="col-lg-8">

        {{-- Progress --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">
    <div>
        <i class="bi bi-ticket-detailed-fill text-primary"></i>
        <strong>Daftar Tiket Terbaru</strong>
    </div>

    <a href="{{ route('staff.ticket.index') }}"
       class="btn btn-sm btn-outline-primary">
        Lihat Semua
    </a>
</div>

            <div class="card-body">

                <div class="progress mb-2" style="height:22px">

                    <div class="progress-bar bg-success"
                        style="width:{{ $percent }}%">

                        {{ $percent }}%

                    </div>

                </div>

                <small class="text-muted">
                    {{ $completed }} dari {{ $total }} tiket telah selesai.
                </small>

            </div>

        </div>

        {{-- Tiket Terbaru --}}
        <div class="card shadow-sm">

            <div class="card-header bg-white">

                <i class="bi bi-clock-history"></i>
                5 Tiket Terbaru

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                       <thead class="table-light">
                       <tr>
                            <th width="170">Kode Tiket</th>
                            <th>Judul Tiket</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($recent as $ticket)

                            <tr>

                                <td>{{ $ticket->kode_ticket }}</td>

                                <td>{{ $ticket->judul }}</td>

                                <td>{{ $ticket->user->name }}</td>

                                <td>

                                    @if($ticket->status=='To Do')
                                        <span class="badge bg-warning text-dark">To Do</span>
                                    @elseif($ticket->status=='In Progress')
                                        <span class="badge bg-info">In Progress</span>
                                    @else
                                        <span class="badge bg-success">Completed</span>
                                    @endif

                                </td>

                                <td class="text-center">
                                    <a href="{{ route('staff.ticket.show',$ticket->id) }}"
                                        class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                            Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted">

                                    Belum ada tiket.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    {{-- KANAN --}}
    <div class="col-lg-4">

        {{-- Quick Action --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <i class="bi bi-lightning-charge-fill text-primary"></i>

                Aksi Cepat

            </div>

            <div class="card-body d-grid gap-2">

                <a href="{{ route('staff.kanban') }}" class="btn btn-primary">

                    <i class="bi bi-kanban-fill"></i>

                    Kanban Board

                </a>

                <a href="{{ route('staff.ticket.index') }}" class="btn btn-success">

                    <i class="bi bi-ticket-detailed-fill"></i>

                    Daftar Tiket

                </a>

            </div>

        </div>

        {{-- Timeline --}}
        <div class="card shadow-sm">

            <div class="card-header bg-white">

                <i class="bi bi-clock-history text-primary"></i>

                Timeline Aktivitas

            </div>

            <div class="card-body">

                @foreach($recent as $ticket)

                    <div class="d-flex mb-4">

                        <div class="me-3">

                            @if($ticket->status=="Completed")
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            @elseif($ticket->status=="In Progress")
                                <i class="bi bi-arrow-repeat text-info fs-5"></i>
                            @else
                                <i class="bi bi-hourglass-split text-warning fs-5"></i>
                            @endif

                        </div>

                        <div>

                            <strong>{{ $ticket->kode_ticket }}</strong>

                            <br>

                            <small>
                                Status menjadi
                                <b>{{ $ticket->status }}</b>
                            </small>

                            <br>

                            <small class="text-muted">
                                {{ $ticket->updated_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection