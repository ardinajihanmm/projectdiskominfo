@extends('layouts.staff')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-ticket-detailed-fill text-primary"></i>
                Daftar Tiket
            </h2>
            <small class="text-muted">
                Kelola seluruh tiket yang masuk
            </small>
        </div>

       <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <form action="{{ route('staff.ticket.index') }}" method="GET">

            <div class="row g-3">

                <div class="col-md-6">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari judul atau kode tiket..."
                        value="{{ $search }}">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="To Do"
                            {{ $status=="To Do" ? 'selected' : '' }}>
                            To Do
                        </option>

                        <option value="In Progress"
                            {{ $status=="In Progress" ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="Completed"
                            {{ $status=="Completed" ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

               <div class="col-md-3 d-grid gap-2">

                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>

                        @if($search || $status)
                        <a href="{{ route('staff.ticket.index') }}"
                        class="btn btn-outline-secondary">
                            Reset
                        </a>
                        @endif

                    </div>
                </div>

            </div>

        </form>

    </div>
</div>
    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <i class="bi bi-list-task"></i>
            Data Tiket
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th width="240">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($tickets as $ticket)

                        <tr>

                            <td>{{ $tickets->firstItem() + $loop->index }}</td>

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

                                    <select name="status"
                                            class="form-select form-select-sm">

                                        <option value="To Do"
                                        {{ $ticket->status=="To Do" ? "selected" : "" }}>
                                            To Do
                                        </option>

                                        <option value="In Progress"
                                        {{ $ticket->status=="In Progress" ? "selected" : "" }}>
                                            In Progress
                                        </option>

                                        <option value="Completed"
                                        {{ $ticket->status=="Completed" ? "selected" : "" }}>
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
                            <td colspan="7" class="text-center py-4">
                                Tidak ada data tiket.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $tickets->links() }}
            </div>

        </div>

    </div>

</div>

@endsection