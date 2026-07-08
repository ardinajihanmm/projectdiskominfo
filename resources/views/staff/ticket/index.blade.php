@extends('layouts.staff')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-ticket-detailed"></i>
            Daftar Tiket
        </h3>
    </div>

    {{-- Search --}}
    <form action="{{ route('staff.ticket.index') }}" method="GET" class="mb-4">

        <div class="row g-2">

            <div class="col-md-5">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari kode tiket, judul, atau pelapor..."
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>

                    <option value="To Do"
                        {{ request('status')=='To Do' ? 'selected' : '' }}>
                        To Do
                    </option>

                    <option value="In Progress"
                        {{ request('status')=='In Progress' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="Completed"
                        {{ request('status')=='Completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>
            </div>

            <div class="col-md-4">

                <button class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>

                <a href="{{ route('staff.ticket.index') }}"
                class="btn btn-outline-secondary">
                    Reset
                </a>

            </div>

        </div>

    </form>
    <div class="card shadow">
        <div class="card-body">

            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode Tiket</th>
                        <th>Judul</th>
                        <th>Pelapor</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th width="250">Aksi</th>
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
                            <span class="badge bg-info">
                                {{ $ticket->status }}
                            </span>
                        </td>

                        <td>

                            <form action="{{ route('staff.ticket.update', $ticket->id) }}" method="POST" class="d-flex gap-2">

                                @csrf
                                @method('PUT')

                                <select name="status" class="form-select form-select-sm">

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

                                <button class="btn btn-primary btn-sm">
                                    Simpan
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Tidak ada data tiket.
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>

            {{ $tickets->links() }}

        </div>
    </div>

</div>

@endsection