@extends('layouts.staff')

@section('title', 'Daftar Tiket')

@section('content')

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

   {{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-ticket-detailed-fill text-primary"></i>
            Daftar Tiket
        </h2>
        <p class="text-muted mb-0">
            Kelola seluruh tiket yang masuk.
        </p>
    </div>

    <a href="{{ route('staff.dashboard') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

</div>

    {{-- Search & Filter --}}
    <div class="card shadow-sm border-0 mb-4">
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
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <i class="bi bi-list-ul"></i>
            Data Tiket
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Layanan</th>
                            <th>Status</th>
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

                            @if($ticket->status=="To Do")
                                <span class="badge bg-warning text-dark">
                                    To Do
                                </span>

                            @elseif($ticket->status=="In Progress")
                                <span class="badge bg-info">
                                    In Progress
                                </span>

                            @else
                                <span class="badge bg-success">
                                    Completed
                                </span>
                            @endif

                        </td>

                        <td>

                            <form action="{{ route('staff.ticket.update',$ticket->id) }}"
                                  method="POST"
                                  class="d-flex gap-2">

                                @csrf
                                @method('PUT')

                                <select
                                    name="status"
                                    class="form-select form-select-sm">

                                    <option value="To Do"
                                        {{ $ticket->status=='To Do' ? 'selected' : '' }}>
                                        To Do
                                    </option>

                                    <option value="In Progress"
                                        {{ $ticket->status=='In Progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>

                                    <option value="Completed"
                                        {{ $ticket->status=='Completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>

                                </select>

                                <button
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-check-lg"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-5">

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