@extends('layouts.staff')

@section('title', 'Dashboard')

@section('content')

<!-- Header -->
<div class="dashboard-header mb-4">
    <div class="row align-items-center">

        <div class="col-lg-8">
            <span class="dashboard-badge">
                <i class="bi bi-house-door-fill"></i>
                Dashboard Staff
            </span>

            <h2 class="dashboard-title mt-3">
                Selamat Datang,
                <span>{{ $user->name }}</span>
            </h2>

            <p class="dashboard-desc">
                Kelola seluruh tiket layanan, pantau progres pekerjaan,
                dan tangani pengajuan pengguna melalui
                <strong>Helpdesk Diskominfo.</strong>
            </p>
        </div>


    </div>
</div>

<!-- Statistik -->
<div class="row g-4 mb-4">

    <div class="col-12 col-sm-6 col-xl-3">

        <div class="modern-card total-card">

            <div class="icon-box">
                <i class="bi bi-ticket-perforated-fill"></i>
            </div>

            <div class="card-content">

                <small>Total Tiket</small>

                <h2 class="counter"
                    data-target="{{ $totalTicket }}">0</h2>

                <span>
                    Seluruh tiket yang masuk
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

                <small>To Do</small>

                <h2 class="counter"
                    data-target="{{ $todo }}">0</h2>

                <span>
                    Tiket yang belum diproses
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

                <small>In Progress</small>

                <h2 class="counter"
                    data-target="{{ $progress }}">0</h2>

                <span>
                    Tiket yang sedang dikerjakan
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

                <small>Completed</small>

                <h2 class="counter"
                    data-target="{{ $completed }}">0</h2>

                <span>
                    Tiket yang telah selesai
                </span>

            </div>

        </div>

    </div>

</div>

<div class="row g-4">

    <!-- Progress -->
    <div class="col-12 col-lg-8">
        <div class="card progress-modern shadow-sm border-0 h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            Progress Penyelesaian Tiket
                        </h4>

                        <small class="text-muted">
                            Ringkasan penyelesaian seluruh tiket yang sedang Anda tangani.
                        </small>
                    </div>

                    <div class="progress-circle">
                        {{ $progressPercent }}%
                    </div>
                </div>

                <div class="progress modern-progress mb-3">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width: {{ $progressPercent }}%">
                    </div>
                </div>

                <div class="mb-4 text-muted">
                    <strong>{{ $completed }}</strong>
                    dari
                    <strong>{{ $totalTicket }}</strong>
                    tiket telah berhasil diselesaikan.
                </div>

                <div class="row g-2">
                    <div class="col-12 col-md-4">
                        <div class="status-box status-success">
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <strong>{{ $completed }}</strong>
                                <small>Completed</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="status-box status-warning">
                            <i class="bi bi-hourglass-split"></i>
                            <div>
                                <strong>{{ $todo }}</strong>
                                <small>To Do</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="status-box status-info">
                            <i class="bi bi-arrow-repeat"></i>
                            <div>
                                <strong>{{ $progress }}</strong>
                                <small>In Progress</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="col-12 col-lg-4">

        <div class="card quick-card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                     <div class="quick-title-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>

                    <div>
                        <h2 class="fw-bold mb-1">
                          Aksi Cepat
                        </h2>

                        <small class="text-muted">
                            Akses menu yang paling sering digunakan.
                        </small> 
                     </div> 
                </div>

                <div class="row g-4">
                    <div class="col-12 col-sm-6">
                        <a href="{{ route('staff.ticket.index') }}"
                            class="quick-menu quick-blue">

                            <i class="bi bi-ticket-perforated-fill"></i>

                            <h5>
                                 Daftar<br>Tiket
                            </h5>

                        </a>

                    </div>

                    <div class="col-12 col-sm-6">
                        <a href="{{ route('staff.kanban') }}"
                            class="quick-menu quick-green">

                            <i class="bi bi-kanban-fill"></i>

                            <h5>
                                Kanban<br>Board
                            </h5>
                        </a>
                    
                     </div>

                    <div class="col-12">

                        <a href="{{ route('staff.profile') }}"
                            class="quick-menu quick-gray">

                            <i class="bi bi-person-circle"></i>

                            <h5>
                                Profil Saya
                            </h5>

                        </a>
                    </div>
            </div>
        </div>
    </div>
    

</div>


<div class="row g-4 mt-4">

    <!-- Tiket Terbaru -->
    <div class="col-lg-8">

        <div class="card latest-ticket-card border-0 shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="fw-bold mb-1">
                            Tiket Terbaru
                        </h4>

                        <small class="text-muted">
                            Daftar tiket terbaru yang masuk.
                        </small>
                    </div>

                    <a href="{{ route('staff.ticket.index') }}"
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
                                <h5>{{ $ticket->judul }}</h5>

                                <small class="text-muted">
                                    {{ $ticket->kode_ticket }}
                                </small>
                            </div>

<div class="me-3">
    @if($ticket->status=="Completed")
        <span class="badge bg-success rounded-pill">
            Completed
        </span>
    @elseif($ticket->status=="In Progress")
        <span class="badge bg-info rounded-pill">
            In Progress
        </span>
    @else
        <span class="badge bg-warning text-dark rounded-pill">
            To Do
        </span>
    @endif
</div>

                        </div>

                        <div class="ticket-meta">

                            <span>
                                <i class="bi bi-person-fill"></i>
                                {{ $ticket->user->name ?? '-' }}
                            </span>

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

                        <a href="{{ route('staff.ticket.show',$ticket->id) }}"
                           class="btn btn-primary rounded-pill">
                            <i class="bi bi-eye"></i>
                            Detail Tiket
                        </a>

                    </div>

                </div>

                @empty

                <div class="empty-ticket text-center py-5">

                    <i class="bi bi-inbox fs-1 text-secondary"></i>

                    <h5 class="mt-3">
                        Belum Ada Tiket
                    </h5>

                    <p class="text-muted">
                        Saat ini belum ada tiket yang masuk.
                    </p>

                </div>

                @endforelse

            </div>

        </div>

    </div>

    <!-- Timeline Aktivitas -->
    <div class="col-lg-4">

        <div class="card shadow-sm border-0 h-100">

<div class="card-header border-0 bg-white py-3">

    <h4 class="fw-bold mb-1">
        <i class="bi bi-activity text-primary"></i>
        Timeline Aktivitas
    </h4>

    <small class="text-muted">
        Aktivitas terbaru staff
    </small>

</div>

            <div class="card-body">

                @forelse($activities as $activity)

<div class="timeline-item-modern">

    <div class="timeline-icon-modern">

        @if(Str::contains($activity->judul,'Komentar'))
            <i class="bi bi-chat-dots-fill"></i>

        @elseif(Str::contains($activity->judul,'Status'))
            <i class="bi bi-arrow-repeat"></i>

        @elseif(Str::contains($activity->judul,'Selesai'))
            <i class="bi bi-check-circle-fill"></i>

        @else
            <i class="bi bi-info-circle-fill"></i>
        @endif

    </div>

    <div class="timeline-content-modern">

        <h6>{{ $activity->judul }}</h6>

        <p>{{ $activity->pesan }}</p>

        <small>
            <i class="bi bi-clock"></i>
            {{ $activity->created_at->diffForHumans() }}
        </small>

    </div>

</div>

                @empty

                <div class="text-center py-5">

                    <i class="bi bi-clock-history fs-1 text-secondary"></i>

                    <p class="mt-3 text-muted">
                        Belum ada aktivitas terbaru.
                    </p>

                </div>

                @endforelse

            </div>

        </div>

    </div> {{-- akhir Timeline --}}
</div> {{-- akhir row Tiket + Timeline --}}

@endsection