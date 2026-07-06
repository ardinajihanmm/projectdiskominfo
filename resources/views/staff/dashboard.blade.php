@extends('layouts.staff')

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

    <a href="{{ route('staff.kanban') }}" class="btn btn-primary">
        <i class="bi bi-kanban-fill"></i>
        Buka Kanban Board
    </a>

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
                <h2 class="fw-bold text-warning">
                    {{ $todo }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-5 border-info">
            <div class="card-body">
                <small class="text-muted">In Progress</small>
                <h2 class="fw-bold text-info">
                    {{ $progress }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-5 border-success">
            <div class="card-body">
                <small class="text-muted">Done</small>
                <h2 class="fw-bold text-success">
                    {{ $done }}
                </h2>
            </div>
        </div>
    </div>

</div>

{{-- Tiket Terbaru --}}
<div class="card shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            <i class="bi bi-clock-history"></i>
            5 Tiket Terbaru
        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pelapor</th>
                    <th>Layanan</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>

                </thead>

                <tbody>

                @forelse($recent as $ticket)

                    <tr>

                        <td>
                            {{ $ticket->kode_ticket }}
                        </td>

                        <td>
                            {{ $ticket->judul }}
                        </td>

                        <td>
                            {{ $ticket->user->name }}
                        </td>

                        <td>
                            {{ $ticket->service->nama_layanan }}
                        </td>

                        <td>

                            @if($ticket->prioritas=='Tinggi')

                                <span class="badge bg-danger">
                                    Tinggi
                                </span>

                            @elseif($ticket->prioritas=='Sedang')

                                <span class="badge bg-warning text-dark">
                                    Sedang
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Rendah
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($ticket->status=='To Do')

                                <span class="badge bg-warning">
                                    To Do
                                </span>

                            @elseif($ticket->status=='In Progress')

                                <span class="badge bg-info">
                                    In Progress
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Done
                                </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('staff.ticket.show',$ticket->id) }}"
                                class="btn btn-sm btn-primary">

                                <i class="bi bi-eye-fill"></i>
                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center text-muted">

                            Belum ada tiket.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection