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

<form method="GET" action="{{ route('admin.ticket.index') }}" class="row mb-3">

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
            <option value="To Do" {{ request('status')=='To Do' ? 'selected' : '' }}>To Do</option>
            <option value="In Progress" {{ request('status')=='In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Done" {{ request('status')=='Done' ? 'selected' : '' }}>Done</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="prioritas" class="form-select">
            <option value="">Semua Prioritas</option>
            <option value="Tinggi" {{ request('prioritas')=='Tinggi' ? 'selected' : '' }}>Tinggi</option>
            <option value="Sedang" {{ request('prioritas')=='Sedang' ? 'selected' : '' }}>Sedang</option>
            <option value="Rendah" {{ request('prioritas')=='Rendah' ? 'selected' : '' }}>Rendah</option>
        </select>
    </div>

    <div class="col-md-2 d-grid gap-2">
    <button class="btn btn-primary">
        <i class="bi bi-search"></i> Filter
    </button>

    <a href="{{ route('admin.ticket.index') }}" class="btn btn-secondary">
        Reset
    </a>
</div>

</form>
    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($tickets as $ticket)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->judul }}</td>

                <td>

                    @if($ticket->status=='To Do')
                        <span class="badge bg-warning text-dark">To Do</span>

                    @elseif($ticket->status=='In Progress')
                        <span class="badge bg-info">In Progress</span>

                    @else
                        <span class="badge bg-success">Done</span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('admin.ticket.show',$ticket->id) }}"
                        class="btn btn-info btn-sm">
                        Detail
                    </a>

                    <form action="{{ route('admin.ticket.update', $ticket->id) }}"
                    method="POST"
                    style="display:inline;">
                    @csrf
                    @method('PUT')

                    <select name="status"
                            class="form-select form-select-sm d-inline"
                            style="width:170px;display:inline-block;"
                            onchange="this.form.submit()">

                        <option value="To Do"
                            {{ $ticket->status=='To Do' ? 'selected' : '' }}>
                            To Do
                        </option>

                        <option value="In Progress"
                            {{ $ticket->status=='In Progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="Complete"
                            {{ $ticket->status=='Complete' ? 'selected' : '' }}>
                            Complete
                        </option>

                    </select>
                </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center">
                    Belum ada tiket.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection