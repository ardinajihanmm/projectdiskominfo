@extends('layouts.staff')

@section('title', 'Daftar Tiket')

@section('content')

<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

   {{-- Header --}}
<div class="ticket-header">
    <h2>
        <i class="bi bi-list-ul text-primary"></i>
        Daftar Tiket
    </h2>

    <p>Kelola seluruh tiket layanan yang masuk.</p>
</div>

    {{-- Search & Filter --}}
    <div class="card filter-card mb-4">
        <div class="card-body">

            <form action="{{ route('staff.ticket.index') }}" method="GET">

                <div class="row g-3 align-items-center">

                    <div class="col-md-5">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari kode tiket, judul, atau pelapor..."
                            value="{{ $search }}">
                    </div>

                    <div class="col-md-3">
                        <select name="status" class="form-select">

                            <option value="">Semua Status</option>

                            <option value="To Do"
                                {{ $status=='To Do' ? 'selected' : '' }}>
                                To Do
                            </option>

                            <option value="In Progress"
                                {{ $status=='In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="Completed"
                                {{ $status=='Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                    </div>

                    <div class="col-md-2 d-grid">
                        <a href="{{ route('staff.ticket.index') }}"
                           class="btn btn-outline-secondary">
                            Reset
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Tabel --}}
    <div class="card ticket-table-card">

<div class="card-header ticket-table-header">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-table"></i>
            Data Tiket
        </h5>

        <span class="badge bg-light text-primary rounded-pill">
            {{ $tickets->total() }} Tiket
        </span>
    </div>
</div>
        <div class="card-body p-0">

            <div class="table-responsive modern-table">
                
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Ditangani</th>
                            <th width="280">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($tickets as $ticket)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $ticket->kode_ticket }}</td>

                        <td>{{ $ticket->judul }}</td>

                        <td>{{ $ticket->user->name }}</td>

                        <td>{{ $ticket->service->nama_layanan }}</td>

                        <td>
    @if($ticket->staff_id)
        <span class="badge bg-primary-subtle text-primary">
            <i class="bi bi-person-check"></i>
            {{ $ticket->staff->name ?? '-' }}
        </span>
    @else
        <span class="badge bg-secondary">Belum diambil</span>
    @endif
</td>

<td>
    @if(!$ticket->staff_id)
        <form action="{{ route('staff.ticket.assign',$ticket->id) }}" method="POST">
            @csrf
            <button class="btn btn-outline-primary btn-sm">
                <i class="bi bi-hand-index-thumb"></i> Ambil Tiket
            </button>
        </form>
    @else
        <form action="{{ route('staff.ticket.update',$ticket->id) }}" method="POST" class="d-flex gap-2">
            @csrf
            @method('PUT')
            <select name="status" class="form-select form-select-sm">
                <option value="To Do" {{ $ticket->status=='To Do' ? 'selected' : '' }}>To Do</option>
                <option value="In Progress" {{ $ticket->status=='In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $ticket->status=='Completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button class="btn btn-primary btn-sm"><i class="bi bi-check-lg"></i></button>
        </form>
    @endif
</td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center py-5">

                            <i class="bi bi-inbox fs-2 text-muted"></i>

                            <br>

                            <span class="text-muted">
                                Tidak ada data tiket.
                            </span>

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">
            {{ $tickets->links() }}
        </div>

    </div>

</div>

@endsection