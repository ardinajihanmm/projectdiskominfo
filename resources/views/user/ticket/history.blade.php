@extends('layouts.user')

@section('title','Riwayat Pengajuan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            <i class="bi bi-clock-history text-primary"></i>
            Riwayat Pengajuan
        </h3>

        <small class="text-muted">
            Daftar seluruh pengajuan layanan yang pernah Anda buat.
        </small>

    </div>

    <a href="{{ route('user.dashboard') }}"
       class="btn btn-outline-secondary">

        <i class="bi bi-arrow-left"></i>

        Kembali

    </a>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-6">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari judul atau kode tiket..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-3">

                    <select
                        name="status"
                        class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="To Do"
                            {{ request('status')=='To Do'?'selected':'' }}>
                            To Do
                        </option>

                        <option value="In Progress"
                            {{ request('status')=='In Progress'?'selected':'' }}>
                            In Progress
                        </option>

                        <option value="Completed"
                            {{ request('status')=='Completed'?'selected':'' }}>
                            Completed
                        </option>

                    </select>

                </div>

                <div class="col-md-3 d-grid">

                    <button class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
<!-- Search & Filter nanti di sini -->

<!-- Tabel Riwayat -->
<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Kode</th>

                        <th>Judul</th>

                        <th>Layanan</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tickets as $ticket)

                    <tr>

                        <td>

                            {{ $ticket->kode_ticket }}

                        </td>

                        <td>

                            {{ $ticket->judul }}

                        </td>

                        <td>

                            {{ $ticket->service->nama_layanan }}

                        </td>

                        <td>

                            @if($ticket->status=='To Do')

                                <span class="badge bg-warning text-dark">

                                    To Do

                                </span>

                            @elseif($ticket->status=='In Progress')

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

                            {{ $ticket->created_at->format('d M Y') }}

                        </td>

                        <td>

                            <a href="{{ route('user.ticket.detail',$ticket->id) }}"
                               class="btn btn-sm btn-primary">

                                <i class="bi bi-eye"></i>

                                Detail

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="text-center py-5">

                                <i class="bi bi-ticket-perforated fs-1 text-secondary"></i>

                                <h5 class="mt-3">

                                    Tidak ada tiket ditemukan.

                                </h5>

                                <p class="text-muted">

                                    Belum ada data atau hasil pencarian tidak ditemukan.

                                </p>

                                <a href="{{ route('user.ticket.create') }}"
                                   class="btn btn-primary">

                                    <i class="bi bi-plus-circle"></i>

                                    Ajukan Layanan

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="mt-3">

    {{ $tickets->links() }}

</div>

@endsection