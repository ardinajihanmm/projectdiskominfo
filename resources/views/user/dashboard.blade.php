@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.user')

@section('title','Dashboard')

@section('content')


<!-- Header -->
<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <h3 class="fw-bold mb-2">
            <i class="bi bi-house-door-fill text-primary"></i>
            Dashboard
        </h3>

        <p class="text-muted mb-0">

            Selamat datang,
            <strong>{{ $user->name }}</strong>.
            Gunakan portal ini untuk mengajukan layanan TIK,
            memantau status pengajuan, serta melihat informasi terbaru.

        </p>

    </div>

</div>

<div class="alert alert-success shadow-sm">

<i class="bi bi-shield-check"></i>

Status akun Anda aktif.
Anda dapat mengajukan layanan kapan saja.

</div>
<!-- Statistik -->

<div class="row mb-4">

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Total Pengajuan

                        </small>

                        <h2 class="fw-bold">

                            {{ $totalTicket }}

                        </h2>

                    </div>

                    <i class="bi bi-ticket-perforated-fill fs-1 text-primary"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            To Do

                        </small>

                        <h2 class="fw-bold text-warning">

                            {{ $todo }}

                        </h2>

                    </div>

                    <i class="bi bi-hourglass-split fs-1 text-warning"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Diproses

                        </small>

                        <h2 class="fw-bold text-info">

                            {{ $progress }}

                        </h2>

                    </div>

                    <i class="bi bi-gear-fill fs-1 text-info"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">

                            Selesai

                        </small>

                        <h2 class="fw-bold text-success">

                            {{ $completed }}

                        </h2>

                    </div>

                    <i class="bi bi-check-circle-fill fs-1 text-success"></i>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <!-- Progress -->
<div class="row">

    <!-- Progress -->
    <div class="col-lg-7 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <strong>
                    <i class="bi bi-graph-up-arrow text-success"></i>
                    Progress Penyelesaian
                </strong>

            </div>

            <div class="card-body">

                <div class="progress mb-3" style="height:22px;">

                    <div
                        class="progress-bar bg-success"
                        role="progressbar"
                        style="width: {{ $progressPercent }}%;"
                        aria-valuenow="{{ $progressPercent }}"
                        aria-valuemin="0"
                        aria-valuemax="100">

                        {{ $progressPercent }}%

                    </div>

                </div>

                <h5 class="fw-bold text-success">

                    {{ $progressPercent }}%

                </h5>

                <p class="mb-2 text-muted">

                    {{ $completed }} dari {{ $totalTicket }}
                    pengajuan telah berhasil diselesaikan.

                </p>

                <div class="d-flex flex-wrap gap-2">

                    <span class="badge bg-success">

                        <i class="bi bi-check-circle-fill"></i>

                        Selesai : {{ $completed }}

                    </span>

                    <span class="badge bg-warning text-dark">

                        <i class="bi bi-hourglass-split"></i>

                        To Do : {{ $todo }}

                    </span>

                    <span class="badge bg-info text-dark">

                        <i class="bi bi-gear-fill"></i>

                        Diproses : {{ $progress }}

                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- Aksi Cepat -->

    <div class="col-lg-5 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white">

                <strong>

                    <i class="bi bi-lightning-charge-fill text-primary"></i>

                    Aksi Cepat

                </strong>

            </div>

            <div class="card-body d-grid gap-2">

                <a href="{{ route('user.ticket.create') }}"
                    class="btn btn-primary">

                    <i class="bi bi-plus-circle"></i>

                    Ajukan Layanan

                </a>

                <a href="{{ route('user.ticket.history') }}"
                    class="btn btn-success">

                    <i class="bi bi-clock-history"></i>

                    Riwayat Pengajuan

                </a>

                <a href="{{ route('user.profile') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-person-circle"></i>

                    Profil Saya

                </a>

            </div>

        </div>

    </div>

</div>

<div class="row">
    <!-- Pengajuan Terbaru -->
 <div class="col-lg-7 mb-4">

  <div class="card shadow-sm border-0 h-100">

    <div class="card-header bg-white">

        <strong>

            <i class="bi bi-ticket-detailed-fill text-primary"></i>

            Pengajuan Terbaru

        </strong>

    </div>

    <div class="card-body">

        @if($latestTicket)

            <h5 class="fw-bold">

                {{ $latestTicket->judul }}

            </h5>

            <table class="table table-borderless">

                <tr>

                    <td width="110"><strong>Kode</strong></td>

                    <td>{{ $latestTicket->kode_ticket }}</td>

                </tr>

                <tr>

                    <td><strong>Status</strong></td>

                    <td>

                        @if($latestTicket->status=="Completed")

                            <span class="badge bg-success">
                                Completed
                            </span>

                        @elseif($latestTicket->status=="In Progress")

                            <span class="badge bg-info">
                                In Progress
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                To Do
                            </span>

                        @endif

                    </td>

                </tr>

                <tr>

                    <td><strong>Tanggal</strong></td>

                    <td>

                        {{ $latestTicket->created_at->format('d M Y H:i') }}

                    </td>

                </tr>

            </table>

            <a
                href="{{ route('user.ticket.detail',$latestTicket->id) }}"
                class="btn btn-primary w-100">

                <i class="bi bi-eye"></i>

                Lihat Detail

            </a>

        @else

            <div class="text-center py-4">

                <i class="bi bi-ticket fs-1 text-secondary"></i>

                <p class="mt-3">

                    Belum ada pengajuan.

                </p>

            </div>

        @endif
    </div> {{-- card-body --}}

</div> {{-- card --}}

</div> {{-- col-lg-7 --}}

<div class="col-lg-5 mb-4">

    <div class="card shadow-sm border-0 h-100">

    <div class="card-header bg-white">

        <strong>

            <i class="bi bi-clock-history text-primary"></i>

            Timeline Aktivitas

        </strong>

    </div>

    <div class="card-body">

        @forelse($activities as $activity)

            <div class="timeline-item">

                <div class="timeline-icon">

                    @if(Str::contains($activity->judul,'Komentar'))

                        <i class="bi bi-chat-dots-fill text-success"></i>

                    @elseif(Str::contains($activity->judul,'Status'))

                        <i class="bi bi-arrow-repeat text-primary"></i>

                    @else

                        <i class="bi bi-info-circle-fill text-warning"></i>

                    @endif

                </div>

                <div class="timeline-content">

                    <h6>

                        {{ $activity->judul }}

                    </h6>

                    <p>

                        {{ $activity->pesan }}

                    </p>

                    <small class="text-muted">

                        <i class="bi bi-clock"></i>

                        {{ $activity->created_at->diffForHumans() }}

                    </small>

                </div>

            </div>

        @empty

            <div class="text-center py-4">

                <i class="bi bi-clock-history fs-1 text-secondary"></i>

                <p class="mt-3 text-muted">

                    Belum ada aktivitas.

                </p>

            </div>

                @endforelse

    </div> {{-- card-body --}}

</div> {{-- card --}}

</div> {{-- col-lg-5 --}}

</div> {{-- row --}}

<!-- Panduan -->

<!-- Panduan -->

<div class="card border-0 shadow-sm">

    <div class="card-header bg-primary text-white">

        <strong>

            <i class="bi bi-info-circle-fill"></i>

            Panduan Penggunaan Portal

        </strong>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <i class="bi bi-1-circle-fill text-primary"></i>

                Klik menu

                <strong>Ajukan Layanan</strong>

                untuk membuat pengajuan baru.

            </div>

            <div class="col-md-6 mb-3">

                <i class="bi bi-2-circle-fill text-primary"></i>

                Lengkapi formulir dan unggah lampiran bila diperlukan.

            </div>

            <div class="col-md-6 mb-3">

                <i class="bi bi-3-circle-fill text-primary"></i>

                Pantau status melalui menu

                <strong>Riwayat Pengajuan</strong>.

            </div>

            <div class="col-md-6 mb-3">

                <i class="bi bi-4-circle-fill text-primary"></i>

                Balas komentar petugas apabila diperlukan.

            </div>

        </div>

    </div>

</div>

@endsection

