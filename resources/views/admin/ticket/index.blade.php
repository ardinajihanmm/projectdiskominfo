@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Kelola Tiket</h2>
        <form action="{{ route('admin.ticket.index') }}"
      method="GET"
      class="mb-3">

    <div class="input-group">

        <span class="input-group-text bg-primary text-white">
            <i class="bi bi-search"></i>
        </span>

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari kode tiket, judul, atau pelapor..."
            value="{{ $search ?? '' }}">

        <button class="btn btn-primary">
            Cari
        </button>

        @if(!empty($search))
            <a href="{{ route('admin.ticket.index') }}"
               class="btn btn-outline-secondary">
                Reset
            </a>
        @endif

    </div>

</form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-3 d-flex gap-2">

    <a href="{{ route('admin.ticket.export.pdf') }}"
       class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i>
        Export PDF
    </a>

    <a href="{{ route('admin.ticket.export.excel') }}"
       class="btn btn-success">
        <i class="bi bi-file-earmark-excel"></i>
        Export Excel
    </a>

    </div>
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

                    <a href="{{ route('admin.ticket.edit',$ticket->id) }}"
                        class="btn btn-warning btn-sm">
                        Ubah Status
                    </a>

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