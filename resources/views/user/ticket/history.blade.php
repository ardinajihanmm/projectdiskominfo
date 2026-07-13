@extends('layouts.user')

@section('title','Riwayat Pengajuan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-2">
            Riwayat Pengajuan
        </h2>

        <p class="text-muted mb-0">
            Lihat status dan perkembangan seluruh pengajuan layanan Anda.
        </p>

    </div>

    <a href="{{ route('user.dashboard') }}"
       class="btn btn-light border rounded-3 px-4">

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </a>

</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body p-4">

        <form method="GET">

            <div class="row g-3">

                <div class="col-lg-6">

                    <div class="input-group">

                        <span class="input-group-text bg-white border-end-0">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            type="text"
                            name="search"
                            class="form-control border-start-0"
                            placeholder="Cari kode tiket atau judul..."
                            value="{{ request('search') }}">

                    </div>

                </div>

                <div class="col-lg-3">

                    <select name="status" class="form-select">

                        <option value="">Semua Status</option>
                        <option value="To Do" {{ request('status')=='To Do'?'selected':'' }}>
                            Menunggu Diproses
                        </option>
                        <option value="In Progress" {{ request('status')=='In Progress'?'selected':'' }}>
                            Sedang Diproses
                        </option>
                        <option value="Completed" {{ request('status')=='Completed'?'selected':'' }}>
                            Selesai
                        </option>

                    </select>

                </div>

                <div class="col-lg-3 d-grid">

                    <button class="btn btn-primary">

                        <i class="bi bi-search me-2"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- Tabel Riwayat -->
<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

    <th class="ps-4">Kode Tiket</th>

    <th>Judul</th>

    <th>Layanan</th>

    <th>Status</th>

    <th>Tanggal</th>

    <th class="text-center">Aksi</th>

</tr>

                </thead>

                <tbody>

                    @forelse($tickets as $ticket)

                    <tr>

                        <td class="ps-4">

    <div class="fw-bold">
        {{ $ticket->kode_ticket }}
    </div>

</td>

                        <td>

    <div class="fw-semibold">

        {{ $ticket->judul }}

    </div>

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
                        <td class="text-center">

    <a href="{{ route('user.ticket.detail',$ticket->id) }}"
       class="btn btn-primary btn-sm rounded-pill px-3">

        <i class="bi bi-eye me-1"></i>

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