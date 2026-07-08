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

            <h4 class="fw-bold mb-4">

                {{ $latestTicket->judul }}

            </h4>

            <div class="row g-3 mb-4">

    <div class="col-md-6">

        <small class="text-muted d-block">
            <i class="bi bi-upc-scan text-primary"></i>
            Kode Tiket
        </small>

        <strong>{{ $latestTicket->kode_ticket }}</strong>

    </div>

    <div class="col-md-6">

        <small class="text-muted d-block">
            <i class="bi bi-calendar-event text-success"></i>
            Tanggal
        </small>

        <strong>
            {{ $latestTicket->created_at->format('d M Y H:i') }}
        </strong>

    </div>

    <div class="col-md-6">

        <small class="text-muted d-block">
            <i class="bi bi-list-task text-warning"></i>
            Status
        </small>

        @if($latestTicket->status=="Completed")

            <span class="badge bg-success px-3 py-2">

                <i class="bi bi-check-circle"></i>

                Completed

            </span>

        @elseif($latestTicket->status=="In Progress")

            <span class="badge bg-info px-3 py-2">

                <i class="bi bi-gear"></i>

                In Progress

            </span>

        @else

            <span class="badge bg-warning text-dark px-3 py-2">

                <i class="bi bi-hourglass-split"></i>

                To Do

            </span>

        @endif

    </div>

    <div class="col-md-6">

        <small class="text-muted d-block">
            <i class="bi bi-tag text-danger"></i>
            Layanan
        </small>

        <strong>

            {{ $latestTicket->service->nama ?? '-' }}

        </strong>

    </div>

</div>

            <a
                href="{{ route('user.ticket.detail',$latestTicket->id) }}"
                class="btn btn-outline-primary w-100">

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

            <i class="bi bi-activity text-primary"></i>

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

        @elseif(Str::contains($activity->judul,'Selesai'))

            <i class="bi bi-check-circle-fill text-success"></i>

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

        <small>

            <i class="bi bi-clock-history"></i>

            {{ $activity->created_at->diffForHumans() }}

        </small>

    </div>

</div>

@empty

<div class="text-center py-5">

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

<div class="card border-0 shadow-sm">

    <div class="card-header bg-primary text-white">

        <strong>

            <i class="bi bi-info-circle-fill"></i>

            Alur Pengajuan Layanan

        </strong>

    </div>

        <div class="card-body py-4">

<div class="row text-center step-wrapper">

    <div class="col-lg-3 col-6 step-item">

        <div class="step-number bg-primary">

            1

        </div>

        <div class="step-title">

            <i class="bi bi-plus-circle text-primary"></i>

            Ajukan Layanan

        </div>

        <div class="step-desc">

            Pilih menu Ajukan Layanan untuk membuat pengajuan baru.

        </div>

    </div>

    <div class="col-lg-3 col-6 step-item">

        <div class="step-number bg-success">

            2

        </div>

        <div class="step-title">

            <i class="bi bi-pencil-square text-success"></i>

            Isi Form

        </div>

        <div class="step-desc">

            Isi formulir pengajuan dan unggah lampiran jika diperlukan..

        </div>

    </div>

    <div class="col-lg-3 col-6 step-item">

        <div class="step-number bg-warning text-dark">

            3

        </div>

        <div class="step-title">

            <i class="bi bi-clock-history text-warning"></i>

            Pantau Status

        </div>

        <div class="step-desc">

            Pantau status pengajuan melalui menu Riwayat Pengajuan.

        </div>

    </div>

    <div class="col-lg-3 col-6 step-item">

        <div class="step-number bg-info">

            4

        </div>

        <div class="step-title">

            <i class="bi bi-check-circle text-info"></i>

            Selesai

        </div>

        <div class="step-desc">

            Lihat hasil layanan atau balas komentar dari petugas.

        </div>

    </div>

</div>

</div>

@endsection

