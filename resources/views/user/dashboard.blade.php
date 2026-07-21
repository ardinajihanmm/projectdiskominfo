@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.user')
@section('title','Dashboard')
@section('content')

<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <span class="dashboard-badge"><i class="bi bi-house-door-fill"></i> Dashboard</span>
            <h2 class="dashboard-title mt-3">Selamat Datang, <span>{{ $user->name }}</span></h2>
            <p class="dashboard-desc">
                Silakan ajukan layanan atau laporkan kendala TIK yang Anda alami. Kami akan memproses pengajuan Anda, dan Anda dapat memantau perkembangannya melalui halaman <strong>Helpdesk Pemkab Pemalang.</strong>
            </p>
        </div>
        <div class="col-lg-4">
            <div class="account-status">
                <div class="status-icon"><i class="bi bi-shield-check"></i></div>
                <div>
                    <small>Status Akun</small>
                    <h6 class="mb-1">Aktif</h6>
                    <span>Anda dapat mengajukan layanan kapan saja.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="modern-card total-card">
            <div class="icon-box"><i class="bi bi-ticket-perforated-fill"></i></div>
            <div class="card-content">
                <small>Total Pengajuan</small>
                <h2 class="counter" data-target="{{ $totalTicket }}">0</h2>
                <span>Seluruh tiket yang diajukan</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="modern-card waiting-card">
            <div class="icon-box"><i class="bi bi-hourglass-split"></i></div>
            <div class="card-content">
                <small>Menunggu Diproses</small>
                <h2 class="counter" data-target="{{ $todo }}">0</h2>
                <span>Menunggu ditangani</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="modern-card progress-card">
            <div class="icon-box"><i class="bi bi-arrow-repeat"></i></div>
            <div class="card-content">
                <small>Sedang Diproses</small>
                <h2 class="counter" data-target="{{ $progress }}">0</h2>
                <span>Sedang dikerjakan</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="modern-card complete-card">
            <div class="icon-box"><i class="bi bi-check-circle-fill"></i></div>
            <div class="card-content">
                <small>Selesai</small>
                <h2 class="counter" data-target="{{ $completed }}">0</h2>
                <span>Pengajuan telah selesai</span>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
<div class="col-lg-8">
    <div class="card progress-modern shadow-sm border-0 h-100">
        <div class="card-body p-4">
            @if($satisfactionScore !== null)
                @php
                    $slaLabel = $satisfactionScore >= 80 ? 'Sangat Baik' : ($satisfactionScore >= 65 ? 'Cukup Baik' : 'Perlu Perhatian');
                    $slaDesc = $satisfactionScore >= 80
                        ? 'Layanan yang kamu terima diproses dengan cepat dan tepat waktu.'
                        : ($satisfactionScore >= 65
                            ? 'Sebagian layananmu diproses agak lambat dari target waktu.'
                            : 'Layanan yang kamu terima cenderung terlambat dari target waktu.');
                @endphp
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            <i class="bi bi-emoji-smile-fill text-warning"></i>
                            Tingkat Kepuasan Layanan
                        </h4>
                        <small class="text-muted">
                            {{ $slaDesc }}
                        </small>
                    </div>
                    <div class="progress-circle">
                        {{ $satisfactionScore }}%
                    </div>
                </div>
                <div class="progress modern-progress mb-3">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width: {{ $satisfactionScore }}%">
                    </div>
                </div>
                <div class="mb-4 text-muted">
                    <strong>{{ $tepatWaktu }}</strong>
                    dari
                    <strong>{{ $completed }}</strong>
                    pengajuanmu diselesaikan tepat waktu.
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="status-box status-success h-100">
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <strong>{{ $tepatWaktu }}</strong>
                                <small>Tepat Waktu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status-box status-warning h-100">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                <strong>{{ $telat }}</strong>
                                <small>Terlambat dari SLA</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="status-box status-info h-100">
                            <i class="bi bi-arrow-repeat"></i>
                            <div>
                                <strong>{{ $progress }}</strong>
                                <small>Sedang Diproses</small>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-emoji-smile fs-1 text-secondary"></i>
                    <h5 class="fw-bold mt-3 mb-1">Belum Ada Data</h5>
                    <p class="text-muted mb-0">
                        Tingkat kepuasan akan muncul setelah ada pengajuanmu yang selesai diproses.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
    <div class="col-lg-4">
        <div class="card quick-card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="quick-title-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                    <div>
                        <h4 class="mb-1 fw-bold">Aksi Cepat</h4>
                        <small class="text-muted">Akses menu yang paling sering digunakan.</small>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('user.ticket.create') }}" class="quick-menu quick-blue">
                            <i class="bi bi-plus-circle-fill"></i>
                            <h6>Ajukan<br>Layanan</h6>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('user.ticket.history') }}" class="quick-menu quick-green">
                            <i class="bi bi-clock-history"></i>
                            <h6>Riwayat<br>Pengajuan</h6>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('user.profile') }}" class="quick-menu quick-gray">
                            <i class="bi bi-person-circle"></i>
                            <h6>Profil Saya</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card latest-ticket-card border-0 shadow-sm h-100">
            <div class="card-body p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">Pengajuan Terakhir</h3>
                        <p class="text-muted mb-0">Informasi tiket terbaru yang Anda ajukan.</p>
                    </div>
                </div>
                @if($latestTicket)
                    {{-- Header Tiket --}}
                    <div class="latest-ticket-content">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="ticket-icon"><i class="bi bi-ticket-perforated-fill"></i></div>
                                <div>
                                    <h4 class="fw-bold mb-1">{{ $latestTicket->judul }}</h4>
                                    <div class="text-muted">{{ $latestTicket->kode_ticket }}</div>
                                </div>
                            </div>
                            <div>
                                @if($latestTicket->status=='Completed')
                                    <span class="badge bg-success rounded-pill px-4 py-2"><i class="bi bi-check-circle-fill me-2"></i> Selesai</span>
                                @elseif($latestTicket->status=='In Progress')
                                    <span class="badge bg-info rounded-pill px-4 py-2"><i class="bi bi-arrow-repeat me-2"></i> Sedang Diproses</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill px-4 py-2"><i class="bi bi-hourglass-split me-2"></i> Menunggu Diproses</span>
                                @endif
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="ticket-info">
                                    <i class="bi bi-grid text-primary"></i>
                                    <div>
                                        <small>Layanan</small>
                                        <strong>{{ $latestTicket->service->nama_layanan ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ticket-info">
                                    <i class="bi bi-calendar3 text-success"></i>
                                    <div>
                                        <small>Tanggal</small>
                                        <strong>{{ $latestTicket->created_at->format('d F Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ticket-info">
                                    <i class="bi bi-chat-left-text text-warning"></i>
                                    <div>
                                        <small>Deskripsi</small>
                                        <strong>{{ Str::limit($latestTicket->deskripsi,45) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.ticket.detail',$latestTicket->id) }}" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-eye-fill me-2"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-5 text-secondary mb-3"></i>
                        <h5 class="fw-bold">Belum Ada Pengajuan</h5>
                        <p class="text-muted">Anda belum pernah mengajukan layanan.</p>
                        <a href="{{ route('user.ticket.create') }}" class="btn btn-primary rounded-pill px-4">Ajukan Layanan</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card timeline-card border-0 shadow-sm h-100">
            <div class="timeline-header">
                <div>
                    <h4 class="mb-1 fw-bold"><i class="bi bi-activity text-primary me-2"></i> Timeline Aktivitas</h4>
                    <small class="text-muted">2 aktivitas terbaru</small>
                </div>
            </div>
            <div class="timeline-body">
                @forelse($activities->take(3) as $activity)
                    <div class="timeline-item-modern">
                        <div class="timeline-dot">
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
                        <div class="timeline-card-item">
                            <h6>{{ $activity->judul }}</h6>
                            <p>{{ $activity->pesan }}</p>
                            <small>{{ $activity->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-clock-history display-6 text-secondary"></i>
                        <p class="mt-3 text-muted">Belum ada aktivitas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="card guide-card border-0 shadow-sm">
    <div class="card-body p-5">
        <div class="text-center mb-5">
            <span class="guide-badge"><i class="bi bi-stars me-2"></i> Panduan Pengajuan</span>
            <h3 class="fw-bold mt-3">Alur Pengajuan Layanan Helpdesk</h3>
            <p class="text-muted mb-0">Ikuti langkah berikut agar pengajuan Anda dapat diproses dengan cepat dan mudah.</p>
        </div>
        <div class="guide-timeline">
            <div class="guide-line"></div>
            <div class="row text-center g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="guide-step">
                        <div class="guide-icon blue"><i class="bi bi-plus-circle-fill"></i></div>
                        <span class="step-number">Langkah 1</span>
                        <h5>Ajukan Layanan</h5>
                        <p>Pilih menu <strong>Ajukan Layanan</strong> untuk membuat pengajuan baru.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="guide-step">
                        <div class="guide-icon green"><i class="bi bi-ui-checks-grid"></i></div>
                        <span class="step-number">Langkah 2</span>
                        <h5>Isi Formulir</h5>
                        <p>Lengkapi seluruh data serta unggah lampiran apabila diperlukan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="guide-step">
                        <div class="guide-icon orange"><i class="bi bi-hourglass-split"></i></div>
                        <span class="step-number">Langkah 3</span>
                        <h5>Pantau Status</h5>
                        <p>Cek perkembangan pengajuan melalui menu <strong>Riwayat Tiket</strong>.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="guide-step">
                        <div class="guide-icon cyan"><i class="bi bi-check-circle-fill"></i></div>
                        <span class="step-number">Langkah 4</span>
                        <h5>Selesai</h5>
                        <p>Lihat hasil layanan atau balas komentar dari petugas apabila diperlukan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="guide-tip mt-5">
            <i class="bi bi-lightbulb-fill text-warning me-2"></i>
            <strong>Tips :</strong> Pastikan data dan lampiran yang diunggah sudah benar agar proses penanganan menjadi lebih cepat.
        </div>
    </div>
</div>
@endsection
