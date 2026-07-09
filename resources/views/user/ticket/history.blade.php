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

    <div class="input-group">

        <span class="input-group-text bg-white border-end-0">

            <i class="bi bi-search text-primary"></i>

        </span>

        <input
            type="text"
            name="search"
            class="form-control border-start-0"
            placeholder="Cari kode tiket atau judul..."
            value="{{ request('search') }}">

    </div>

</div>
                <div class="col-md-3">

    <select
        name="status"
        class="form-select">

        <option value="">Semua Status</option>

        <option value="To Do"
            {{ request('status')=='To Do'?'selected':'' }}>
            Menunggu Diproses
        </option>

        <option value="In Progress"
            {{ request('status')=='In Progress'?'selected':'' }}>
            Sedang Diproses
        </option>

        <option value="Completed"
            {{ request('status')=='Completed'?'selected':'' }}>
            Selesai
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

                <thead class="bg-light">

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

                            <span class="fw-bold font-monospace">

    {{ $ticket->kode_ticket }}

</span>

                        </td>

                        <td>

                            {{ $ticket->judul }}

                        </td>

                        <td>

                            {{ $ticket->service->nama_layanan }}

                        </td>

                        <td>

@if($ticket->status=='To Do')

<span class="badge rounded-pill bg-warning text-dark px-3 py-2">

<i class="bi bi-hourglass-split me-1"></i>

Menunggu

</span>

@elseif($ticket->status=='In Progress')

<span class="badge rounded-pill bg-info px-3 py-2">

<i class="bi bi-arrow-repeat me-1"></i>

Diproses

</span>

@else

<span class="badge rounded-pill bg-success px-3 py-2">

<i class="bi bi-check-circle-fill me-1"></i>

Selesai

</span>

@endif

</td>

</td>
<td>

<div class="fw-semibold">

{{ $ticket->created_at->format('d M Y') }}

</div>

<small class="text-muted">

{{ $ticket->created_at->format('H:i') }} WIB

</small>

</td>

                        <td>

                            <a href="{{ route('user.ticket.detail',$ticket->id) }}"
                               class="btn btn-primary btn-sm rounded-pill px-3">

                                <i class="bi bi-eye"></i>

                                Detail

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="text-center py-5">

                                <i class="bi bi-inbox display-3 text-secondary"></i>

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

    {{ $tickets->onEachSide(1)->links('pagination::bootstrap-5') }}

</div>

@endsection