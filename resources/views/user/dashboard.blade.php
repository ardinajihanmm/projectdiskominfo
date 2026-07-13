@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.user')

@section('title','Dashboard')

@section('content')


<!-- Header -->
<div class="dashboard-header mb-4">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <span class="dashboard-badge">

                <i class="bi bi-house-door-fill"></i>

                Dashboard

            </span>

            <h2 class="dashboard-title mt-3">

                Selamat Datang,
                <span>{{ $user->name }}</span>

            </h2>

            <p class="dashboard-desc">

                Kelola seluruh pengajuan layanan, pantau perkembangan tiket,
                dan lihat aktivitas terbaru melalui
                <strong>Helpdesk Diskominfo.</strong>

            </p>

        </div>

        <div class="col-lg-4">

            <div class="account-status">

                <div class="status-icon">

                    <i class="bi bi-shield-check"></i>

                </div>

                <div>

                    <small>Status Akun</small>

                    <h6 class="mb-1">

                        Aktif

                    </h6>

                    <span>

                        Anda dapat mengajukan layanan kapan saja.

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- Statistik -->
<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">

        <div class="modern-card total-card">

            <div class="icon-box">
                <i class="bi bi-ticket-perforated-fill"></i>
            </div>

            <div class="card-content">

                <small>Total Pengajuan</small>

                <h2 class="counter" data-target="{{ $totalTicket }}">0</h2>

                <span>
                    Seluruh tiket yang pernah diajukan
                </span>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="modern-card waiting-card">

            <div class="icon-box">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div class="card-content">

                <small>Menunggu Diproses</small>

                <h2 class="counter" data-target="{{ $todo }}">0</h2>

                <span>
                    Menunggu petugas menangani
                </span>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="modern-card progress-card">

            <div class="icon-box">
                <i class="bi bi-arrow-repeat"></i>
            </div>

            <div class="card-content">

                <small>Sedang Diproses</small>

                <h2 class="counter" data-target="{{ $progress }}">0</h2>

                <span>
                    Sedang dikerjakan petugas
                </span>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="modern-card complete-card">

            <div class="icon-box">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div class="card-content">

                <small>Selesai</small>

                <h2 class="counter" data-target="{{ $completed }}">0</h2>

                <span>
                    Pengajuan telah selesai
                </span>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <!-- Progress -->
<div class="card progress-modern shadow-sm border-0 mb-4">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">

                    Progress Penyelesaian

                </h4>

                <small class="text-muted">

                    Ringkasan perkembangan seluruh pengajuan Anda.

                </small>

            </div>

            <div class="progress-circle">

                {{ $progressPercent }}%

            </div>

        </div>

        <div class="progress modern-progress mb-3">

            <div
                class="progress-bar progress-bar-striped progress-bar-animated"
                style="width: {{ $progressPercent }}%">

            </div>

        </div>

        <div class="mb-4 text-muted">

            <strong>{{ $completed }}</strong>

            dari

            <strong>{{ $totalTicket }}</strong>

            pengajuan telah berhasil diselesaikan.

        </div>

        <div class="row g-3">

            <div class="col-md-4">

                <div class="status-box status-success">

                    <i class="bi bi-check-circle-fill"></i>

                    <div>

                        <strong>{{ $completed }}</strong>

                        <small>Selesai</small>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="status-box status-warning">

                    <i class="bi bi-hourglass-split"></i>

                    <div>

                        <strong>{{ $todo }}</strong>

                        <small>Menunggu Diproses</small>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="status-box status-info">

                    <i class="bi bi-arrow-repeat"></i>

                    <div>

                        <strong>{{ $progress }}</strong>

                        <small>Sedang Diproses</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- Aksi Cepat -->
<div class="card quick-card border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex align-items-center mb-4">

            <div class="quick-title-icon">

                <i class="bi bi-lightning-charge-fill"></i>

            </div>

            <div>

                <h4 class="mb-1 fw-bold">

                    Aksi Cepat

                </h4>

                <small class="text-muted">

                    Akses menu yang paling sering digunakan.

                </small>

            </div>

        </div>

        <div class="row g-3">

            <div class="col-6">

                <a href="{{ route('user.ticket.create') }}"
                   class="quick-menu quick-blue">

                    <i class="bi bi-plus-circle-fill"></i>

                    <h6>

                        Ajukan
                        <br>
                        Layanan

                    </h6>

                </a>

            </div>

            <div class="col-6">

                <a href="{{ route('user.ticket.history') }}"
                   class="quick-menu quick-green">

                    <i class="bi bi-clock-history"></i>

                    <h6>

                        Riwayat
                        <br>
                        Pengajuan

                    </h6>

                </a>

            </div>

            <div class="col-12">

                <a href="{{ route('user.profile') }}"
                   class="quick-menu quick-gray">

                    <i class="bi bi-person-circle"></i>

                    <h6>

                        Profil Saya

                    </h6>

                </a>

            </div>

        </div>

    </div>

</div>

<div class="row">
    <!-- Pengajuan Terbaru -->
<div class="card latest-ticket-card border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">

                    Pengajuan Terbaru

                </h4>

                <small class="text-muted">

                    Tiket terbaru yang Anda ajukan.

                </small>

            </div>

            <a href="{{ route('user.ticket.history') }}"
               class="btn btn-outline-primary rounded-pill">

                Lihat Semua

            </a>

        </div>

        @forelse($latestTickets as $ticket)

        <div class="ticket-item">

            <div class="ticket-icon">

                <i class="bi bi-ticket-perforated-fill"></i>

            </div>

            <div class="ticket-content">

                <div class="d-flex justify-content-between align-items-start flex-wrap">

                    <div>

                        <h5>

                            {{ $ticket->judul }}

                        </h5>

                        <small class="text-muted">

                            {{ $ticket->kode_ticket }}

                        </small>

                    </div>

                    <div>

                        @if($ticket->status=="Completed")

                            <span class="badge bg-success rounded-pill">

                                Selesai

                            </span>

                        @elseif($ticket->status=="In Progress")

                            <span class="badge bg-info rounded-pill">

                                Sedang Diproses

                            </span>

                        @else

                            <span class="badge bg-warning text-dark rounded-pill">

                                Menunggu Diproses

                            </span>

                        @endif

                    </div>

                </div>

                <div class="ticket-meta">

                    <span>

                        <i class="bi bi-grid"></i>

                        {{ $ticket->service->nama_layanan ?? '-' }}

                    </span>

                    <span>

                        <i class="bi bi-calendar3"></i>

                        {{ $ticket->created_at->format('d M Y') }}

                    </span>

                </div>

                <p>

                    {{ \Illuminate\Support\Str::limit($ticket->deskripsi,100) }}

                </p>

                <a href="{{ route('user.ticket.detail',$ticket->id) }}"
                   class="btn btn-primary rounded-pill">

                    <i class="bi bi-eye"></i>

                    Lihat Detail

                </a>

            </div>

        </div>

        @empty

        <div class="empty-ticket">

            <i class="bi bi-inbox"></i>

            <h5>

                Belum Ada Pengajuan

            </h5>

            <p>

                Anda belum pernah mengajukan layanan.

            </p>

            <a href="{{ route('user.ticket.create') }}"
               class="btn btn-primary rounded-pill">

                Ajukan Sekarang

            </a>

        </div>

        @endforelse

    </div>

</div>

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

