@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Kelola Tiket</h2>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.ticket.export.pdf') }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>

            <a href="{{ route('admin.ticket.export.excel') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.ticket.index') }}" class="row mb-4">

        <div class="col-md-4">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari tiket..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>

                <option value="To Do" {{ request('status')=='To Do' ? 'selected' : '' }}>
                    To Do
                </option>

                <option value="In Progress" {{ request('status')=='In Progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="Completed" {{ request('status')=='Completed' ? 'selected' : '' }}>
                    Completed
                </option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="prioritas" class="form-select">

                <option value="">Semua Prioritas</option>

                <option value="High"
                    {{ request('prioritas')=='High' ? 'selected' : '' }}>
                    Tinggi
                </option>

                <option value="Medium"
                    {{ request('prioritas')=='Medium' ? 'selected' : '' }}>
                    Sedang
                </option>

                <option value="Low"
                    {{ request('prioritas')=='Low' ? 'selected' : '' }}>
                    Rendah
                </option>

            </select>
        </div>

        <div class="col-md-2 d-grid">
            <button class="btn btn-primary">
                <i class="bi bi-search"></i> Filter
            </button>
        </div>

    </form>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th width="60">No</th>
                <th>User</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>

      <tbody>

@forelse($tickets as $ticket)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $ticket->user->name }}</td>

    <td>{{ $ticket->judul }}</td>

    {{-- Status --}}
    <td>
        @if($ticket->status == 'To Do')
            <span class="badge bg-warning text-dark">To Do</span>

        @elseif($ticket->status == 'In Progress')
            <span class="badge bg-info">In Progress</span>

        @else
            <span class="badge bg-success">Completed</span>
        @endif
    </td>

    {{-- Prioritas --}}
    <td>
        @if($ticket->prioritas == 'Tinggi')
            <span class="badge bg-danger">Tinggi</span>

        @elseif($ticket->prioritas == 'Sedang')
            <span class="badge bg-warning text-dark">Sedang</span>

        @elseif($ticket->prioritas == 'Rendah')
            <span class="badge bg-success">Rendah</span>

        @else
            <span class="badge bg-secondary">-</span>
        @endif
    </td>

    {{-- Aksi --}}
    <td>
        <a href="{{ route('admin.ticket.show', $ticket->id) }}"
           class="btn btn-info btn-sm">
            <i class="bi bi-eye-fill"></i>
            Detail
        </a>
    </td>

</tr>

@empty

<tr>
    <td colspan="6" class="text-center">
        Belum ada tiket.
    </td>
</tr>

@endforelse

</tbody>
    </table>

    <div class="mt-3">
        {{ $tickets->links() }}
    </div>

</div>

@endsection