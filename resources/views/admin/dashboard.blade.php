@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<style>
    body {
        background: #F1F5F9;
        font-family: 'Segoe UI', sans-serif;
    }

    .dashboard-header {
        background: #fff;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,.06);
    }

    .dashboard-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: #eef4ff;
        color: #2563eb;
        border-radius: 999px;
        font-weight: 600;
        font-size: .9rem;
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #1e293b;
    }

    .dashboard-title span {
        color: #2563eb;
    }

    .dashboard-desc {
        font-size: 1rem;
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .modern-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 22px;
        height: 100%;
        min-height: 180px;
        padding: 28px;
        border-radius: 24px;
        color: #fff;
        transition: .35s;
        box-shadow: 0 15px 30px rgba(0,0,0,.12);
    }

    .modern-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,.18);
    }

    .modern-card::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -80px;
        top: -80px;
    }

    .modern-card::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,.05);
        left: -35px;
        bottom: -35px;
    }

    .icon-box {
        width: 78px;
        height: 78px;
        border-radius: 22px;
        background: rgba(255,255,255,.18);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 34px;
        flex-shrink: 0;
        transition: .35s;
    }

    .modern-card:hover .icon-box {
        transform: rotate(-8deg) scale(1.08);
    }

    .card-content {
        flex: 1;
    }

    .card-content small {
        display: block;
        font-size: .95rem;
        opacity: .9;
        margin-bottom: 8px;
    }

    .card-content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .card-content span {
        font-size: .92rem;
        opacity: .92;
    }

    .total-card {
        background: linear-gradient(135deg,#3B82F6,#2563EB,#1D4ED8);
    }

    .service-card {
        background: linear-gradient(135deg,#FBBF24,#F59E0B,#D97706);
    }

    .ticket-card {
        background: linear-gradient(135deg,#38BDF8,#06B6D4,#0891B2);
    }

    .complete-card {
        background: linear-gradient(135deg,#4ADE80,#22C55E,#15803D);
    }

    .progress-modern {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
    }

    .progress-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg,#2563eb,#1d4ed8);
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.3rem;
        font-weight: 700;
        box-shadow: 0 10px 25px rgba(37,99,235,.30);
    }

    .modern-progress {
        height: 16px;
        border-radius: 30px;
        background: #E5E7EB;
        overflow: hidden;
    }

    .modern-progress .progress-bar {
        border-radius: 30px;
        background: linear-gradient(90deg,#22C55E,#16A34A);
    }

    .status-box {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 26px 22px;
        border-radius: 18px;
        transition: .3s;
        width: 100%;
        height: 100%;
    }

    .status-box:hover {
        transform: translateY(-3px);
    }

    .status-box i {
        font-size: 38px;
    }

    .status-box strong {
        display: block;
        font-size: 1.8rem;
    }

    .status-box small {
        color: #6b7280;
        font-size: .95rem;
    }

    .status-success {
        background: #ECFDF5;
        color: #16A34A;
    }

    .status-warning {
        background: #FFF7ED;
        color: #D97706;
    }

    .status-info {
        background: #EFF6FF;
        color: #2563EB;
    }

    .quick-card {
        border-radius: 24px;
    }

    .quick-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        background: #EEF4FF;
        color: #2563EB;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        margin-right: 15px;
    }

    .quick-menu {
        text-decoration: none;
        border-radius: 20px;
        color: #fff;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: .35s;
        position: relative;
        overflow: hidden;
    }

    .quick-menu::before {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -45px;
        top: -45px;
    }

    .quick-menu:hover {
        color: #fff;
        transform: translateY(-6px);
        box-shadow: 0 20px 35px rgba(0,0,0,.18);
    }

    .quick-menu i {
        font-size: 38px;
        margin-bottom: 18px;
    }

    .quick-menu h6 {
        margin: 0;
        text-align: center;
        line-height: 1.5;
        font-weight: 700;
    }

    .quick-blue {
        background: linear-gradient(135deg,#2563EB,#1D4ED8);
    }

    .quick-green {
        background: linear-gradient(135deg,#16A34A,#15803D);
    }

    .quick-gray {
        background: linear-gradient(135deg,#475569,#334155);
        min-height: 120px;
    }

    .stat-pro-card {
        border-radius: 24px;
        box-shadow: 0 12px 35px rgba(0,0,0,.06);
    }

    .stat-pro-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: #EAF1FF;
        color: #2563EB;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .stat-pro-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #EAF1FF;
        color: #2563EB;
        font-weight: 700;
        border-radius: 30px;
        padding: 10px 22px;
        font-size: .95rem;
        white-space: nowrap;
        height: fit-content;
    }

    .stat-pro-select {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 10px 36px 10px 16px;
        min-width: 180px;
        cursor: pointer;
        transition: .2s;
    }

    .stat-pro-select:hover {
        border-color: #93C5FD;
        box-shadow: 0 0 0 3px rgba(37,99,235,.08);
    }

    .stat-pro-select > i:first-child {
        color: #94A3B8;
        font-size: 16px;
        pointer-events: none;
    }

    .stat-pro-select-text {
        font-weight: 600;
        color: #1E293B;
        font-size: .92rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        pointer-events: none;
    }

    .stat-pro-select .chevron {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 13px;
        pointer-events: none;
    }

    .stat-pro-select-native {
        display: none;
    }

    .stat-pro-dropdown-list {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0,0,0,.12);
        padding: 6px;
        max-height: 260px;
        overflow-y: auto;
        z-index: 50;
        display: none;
    }

    .stat-pro-dropdown-list.show {
        display: block;
    }

    .stat-pro-dropdown-item {
        padding: 10px 14px;
        border-radius: 10px;
        font-size: .9rem;
        color: #334155;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-pro-dropdown-item:hover {
        background: #EFF6FF;
        color: #2563EB;
    }

    .stat-pro-dropdown-item.active {
        background: #2563EB;
        color: #fff;
        font-weight: 600;
    }

    .stat-pro-dropdown-item .check-icon {
        font-size: .85rem;
        opacity: 0;
    }

    .stat-pro-dropdown-item.active .check-icon {
        opacity: 1;
    }

    @media (max-width:576px) {
        .stat-pro-select {
            min-width: 0;
            flex: 1 1 calc(50% - 6px);
        }
    }

    .stat-pro-donut-wrap {
        position: relative;
        width: 100%;
        max-width: 340px;
        height: 340px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-pro-donut-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        text-align: center;
        pointer-events: none;
    }

    .stat-pro-donut-center h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1E293B;
        margin-bottom: 2px;
    }

    .stat-pro-donut-center span {
        font-size: .85rem;
        color: #94A3B8;
        font-weight: 600;
    }

    .stat-pro-legend {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }

    .legend-pct {
        font-weight: 800;
        font-size: 1.05rem;
    }

    .legend-bar {
        height: 8px;
        border-radius: 20px;
        background: #EEF2F6;
        overflow: hidden;
    }

    .legend-bar-fill {
        height: 100%;
        border-radius: 20px;
        transition: width .6s ease;
    }

    .stat-pro-mini {
        display: flex;
        align-items: center;
        gap: 14px;
        border-radius: 18px;
        padding: 18px;
        height: 100%;
        transition: .3s;
        min-height: 110px;
    }

    .stat-pro-mini:hover {
        transform: translateY(-3px);
    }

    .mini-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
    }

    .mini-number {
        font-weight: 800;
        font-size: 1.6rem;
        line-height: 1.1;
        margin-bottom: 2px;
        color: #1E293B;
    }

    .mini-label {
        font-size: .85rem;
        color: #64748B;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .mini-pct {
        display: inline-block;
        font-size: .75rem;
        font-weight: 700;
        padding: 2px 10px;
        border-radius: 20px;
    }

    .stat-pro-mini-amber { background: #FEF6E7; }
    .stat-pro-mini-amber .mini-icon { background: linear-gradient(135deg,#FBBF24,#F59E0B); }
    .stat-pro-mini-amber .mini-pct { background: #FDECC8; color: #B45309; }

    .stat-pro-mini-blue { background: #EAF1FF; }
    .stat-pro-mini-blue .mini-icon { background: linear-gradient(135deg,#3B82F6,#2563EB); }
    .stat-pro-mini-blue .mini-pct { background: #D6E4FF; color: #1D4ED8; }

    .stat-pro-mini-green { background: #EAF9EF; }
    .stat-pro-mini-green .mini-icon { background: linear-gradient(135deg,#4ADE80,#16A34A); }
    .stat-pro-mini-green .mini-pct { background: #D3F3DE; color: #15803D; }

    .stat-pro-mini-purple { background: #F1EDFC; }
    .stat-pro-mini-purple .mini-icon { background: linear-gradient(135deg,#A78BFA,#7C3AED); }
    .stat-pro-mini-purple .mini-pct { background: #E4DBFA; color: #6D28D9; }

    #statusDonutChart {
        width: 100% !important;
        height: 100% !important;
    }

    .stat-pro-card,
    .timeline-card {
        height: 100%;
        border-radius: 24px;
    }

    .timeline-card .card-body {
        max-height: 720px;
        overflow-y: auto;
    }

    .timeline-header {
        padding: 22px 24px;
        border-bottom: 1px solid #edf2f7;
        background: white;
    }

    .timeline-body {
        padding: 24px;
        max-height: 500px;
        overflow-y: auto;
    }

    .timeline-item-modern {
        display: flex;
        gap: 15px;
        position: relative;
        padding-bottom: 25px;
        margin-bottom: 22px;
    }

    .timeline-item-modern:last-child {
        padding-bottom: 0;
    }

    .timeline-item-modern:not(:last-child)::before {
        content: "";
        position: absolute;
        left: 19px;
        top: 20px;
        width: 2px;
        height: 100%;
        background: #dbeafe;
        z-index: 1;
    }

    .timeline-dot {
        position: relative;
        z-index: 2;
        width: 46px;
        height: 46px;
        min-width: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg,#3b82f6,#2563eb);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 17px;
        flex-shrink: 0;
        box-shadow: 0 10px 25px rgba(37,99,235,.25);
    }

    .timeline-card-item {
        flex: 1;
        background: #f8fafc;
        border-radius: 18px;
        padding: 16px;
        transition: .3s;
    }

    .timeline-card-item:hover {
        transform: translateY(-3px);
        background: white;
        box-shadow: 0 12px 28px rgba(0,0,0,.08);
    }

    .timeline-card-item h6 {
        margin-bottom: 6px;
        font-weight: 700;
    }

    .timeline-card-item p {
        margin-bottom: 5px;
        color: #64748b;
        font-size: .92rem;
        line-height: 1.5;
    }

    .timeline-card-item strong {
        color: #2563eb;
    }

    .timeline-card-item small {
        color: #94a3b8;
    }

    .chart-card {
        border-radius: 24px;
    }
</style>

<div class="dashboard-header mb-4">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <span class="dashboard-badge">
                <i class="bi bi-house-door-fill"></i>
                Dashboard
            </span>

            <h2 class="dashboard-title mt-3">
                Selamat Datang,
                <span>{{ Auth::user()->name }}</span>
            </h2>

            <p class="dashboard-desc">
                Kelola seluruh sistem Helpdesk Pemkab Pemalanb
                Pantau statistik tiket, kelola layanan, pengguna, serta aktivitas
                helpdesk dalam satu dashboard.
            </p>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="modern-card total-card">
            <div class="icon-box">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="card-content">
                <small>Total User</small>
                <h2 class="counter" data-target="{{ $totalUser }}">0</h2>
                <span>Seluruh pengguna sistem.</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="modern-card service-card">
            <div class="icon-box">
                <i class="bi bi-tools"></i>
            </div>
            <div class="card-content">
                <small>Total Layanan</small>
                <h2 class="counter" data-target="{{ $totalService }}">0</h2>
                <span>Layanan yang tersedia.</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="modern-card ticket-card">
            <div class="icon-box">
                <i class="bi bi-ticket-perforated-fill"></i>
            </div>
            <div class="card-content">
                <small>Total Tiket</small>
                <h2 class="counter" data-target="{{ $totalTicket }}">0</h2>
                <span>Seluruh tiket yang masuk.</span>
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
                <h2 class="counter" data-target="{{ $completed }}">0</h2>
                <span>Tiket berhasil diselesaikan.</span>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mb-4">

    <div class="col-lg-8">
        <div class="card progress-modern border-0 h-100">
            <div class="card-body p-4">

                @if($averagePoint !== null)
                    @php
                        $slaLabel = $averagePoint >= 80 ? 'Sangat Baik' : ($averagePoint >= 65 ? 'Cukup Baik' : 'Perlu Perhatian');
                        $slaDesc = $averagePoint >= 80
                            ? 'Mayoritas tiket diselesaikan tepat waktu sesuai SLA.'
                            : ($averagePoint >= 65
                                ? 'Sebagian tiket terlambat dari SLA, masih dalam batas wajar.'
                                : 'Banyak tiket terlambat dari SLA, perlu evaluasi kinerja.');
                    @endphp

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">Skor SLA Keseluruhan</h4>
                            <small class="text-muted">{{ $slaDesc }}</small>
                        </div>

                        <div class="progress-circle">
                            {{ $averagePoint }}%
                        </div>
                    </div>

                    <div class="progress modern-progress mb-3">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            style="width: {{ $averagePoint }}%; background: repeating-linear-gradient(45deg, #3B82F6, #3B82F6 8px, #2563EB 8px, #2563EB 16px);">
                        </div>
                    </div>

                    <div class="mb-4 text-muted">
                        <strong>{{ $tepatWaktu }}</strong>
                        dari
                        <strong>{{ $completed }}</strong>
                        tiket selesai tepat waktu sesuai SLA.
                    </div>

                    <div class="row g-3 flex-grow-1">
                        <div class="col-md-4 d-flex">
                            <div class="status-box status-success">
                                <i class="bi bi-check-circle-fill"></i>
                                <div>
                                    <strong>{{ $tepatWaktu }}</strong>
                                    <small>Tepat Waktu</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex">
                            <div class="status-box status-warning">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <div>
                                    <strong>{{ $telat }}</strong>
                                    <small>Terlambat dari SLA</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex">
                            <div class="status-box status-info">
                                <i class="bi bi-arrow-repeat"></i>
                                <div>
                                    <strong>{{ $progress }}</strong>
                                    <small>Sedang Dikerjakan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-lightning-charge fs-1 text-secondary"></i>
                        <h5 class="fw-bold mt-3 mb-1">Belum Ada Data SLA</h5>
                        <p class="text-muted mb-0">
                            Skor SLA akan muncul setelah ada tiket yang diselesaikan.
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
                    <div class="quick-title-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">Aksi Cepat</h4>
                        <small class="text-muted">Menu administrasi yang sering digunakan.</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.user.index') }}" class="quick-menu quick-blue">
                            <i class="bi bi-people-fill"></i>
                            <h6>Kelola<br>User</h6>
                        </a>
                    </div>

                    <div class="col-6">
                        <a href="{{ route('admin.service.index') }}" class="quick-menu quick-green">
                            <i class="bi bi-tools"></i>
                            <h6>Kelola<br>Layanan</h6>
                        </a>
                    </div>

                    <div class="col-12">
                        <a href="{{ route('admin.ticket.index') }}" class="quick-menu quick-gray">
                            <i class="bi bi-ticket-perforated-fill"></i>
                            <h6>Kelola Tiket</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mb-4">

    <div class="col-lg-8">
        <div class="card stat-pro-card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-pro-icon">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">Statistik Tiket</h3>
                            <p class="text-muted mb-0 small">
                                Distribusi &amp; perkembangan status tiket Helpdesk.
                            </p>
                        </div>
                    </div>

                    <span class="stat-pro-badge">
                        <span id="badgeTotal">{{ $totalTicket }}</span> Tiket
                    </span>
                </div>

                <div class="d-flex flex-wrap gap-3 mb-4">

                    <div class="stat-pro-select">
                        <i class="bi bi-calendar3"></i>
                        <span class="stat-pro-select-text" id="monthSelectText">Semua Bulan</span>
                        <i class="bi bi-chevron-down chevron"></i>
                        <select id="filterMonth" class="stat-pro-select-native">
                            <option value="">Semua Bulan</option>
                            @foreach($months as $num => $name)
                                <option value="{{ $num }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="stat-pro-select">
                        <i class="bi bi-calendar-event"></i>
                        <span class="stat-pro-select-text" id="yearSelectText">Semua Tahun</span>
                        <i class="bi bi-chevron-down chevron"></i>
                        <select id="filterYear" class="stat-pro-select-native">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="stat-pro-select">
                        <i class="bi bi-grid-fill"></i>
                        <span class="stat-pro-select-text" id="serviceSelectText">Semua Layanan</span>
                        <i class="bi bi-chevron-down chevron"></i>
                        <select id="filterService" class="stat-pro-select-native">
                            <option value="">Semua Layanan</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row align-items-center g-4">

                    <div class="col-md-6">
                        <div class="stat-pro-donut-wrap">
                            <canvas id="statusDonutChart"></canvas>
                            <div class="stat-pro-donut-center">
                                <h2 id="donutTotal">0</h2>
                                <span>Total Tiket</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="stat-pro-legend">

                            <div class="stat-pro-legend-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="legend-dot" style="background:#F59E0B"></span>
                                        <strong>To Do</strong>
                                    </div>
                                    <span class="legend-pct" style="color:#F59E0B" id="pctTodo">0%</span>
                                </div>
                                <small class="text-muted d-block mb-2"><span id="legendTodo">0</span> Tiket</small>
                                <div class="legend-bar">
                                    <div class="legend-bar-fill" id="barTodo" style="width:0%;background:#F59E0B"></div>
                                </div>
                            </div>

                            <div class="stat-pro-legend-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="legend-dot" style="background:#2563EB"></span>
                                        <strong>In Progress</strong>
                                    </div>
                                    <span class="legend-pct" style="color:#2563EB" id="pctProgress">0%</span>
                                </div>
                                <small class="text-muted d-block mb-2"><span id="legendProgress">0</span> Tiket</small>
                                <div class="legend-bar">
                                    <div class="legend-bar-fill" id="barProgress" style="width:0%;background:#2563EB"></div>
                                </div>
                            </div>

                            <div class="stat-pro-legend-item">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="legend-dot" style="background:#16A34A"></span>
                                        <strong>Completed</strong>
                                    </div>
                                    <span class="legend-pct" style="color:#16A34A" id="pctCompleted">0%</span>
                                </div>
                                <small class="text-muted d-block mb-2"><span id="legendCompleted">0</span> Tiket</small>
                                <div class="legend-bar">
                                    <div class="legend-bar-fill" id="barCompleted" style="width:0%;background:#16A34A"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <hr class="my-4">

                <div class="row g-3">

                    <div class="col-6 col-lg-3">
                        <div class="stat-pro-mini stat-pro-mini-amber">
                            <div class="mini-icon"><i class="bi bi-clipboard-fill"></i></div>
                            <div class="mini-body">
                                <h3 class="mini-number" id="miniNumberTodo">{{ $todo }}</h3>
                                <div class="mini-label">To Do</div>
                                <span class="mini-pct" id="miniPctTodo">0%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="stat-pro-mini stat-pro-mini-blue">
                            <div class="mini-icon"><i class="bi bi-arrow-repeat"></i></div>
                            <div class="mini-body">
                                <h3 class="mini-number" id="miniNumberProgress">{{ $progress }}</h3>
                                <div class="mini-label">In Progress</div>
                                <span class="mini-pct" id="miniPctProgress">0%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="stat-pro-mini stat-pro-mini-green">
                            <div class="mini-icon"><i class="bi bi-check-circle-fill"></i></div>
                            <div class="mini-body">
                                <h3 class="mini-number" id="miniNumberCompleted">{{ $completed }}</h3>
                                <div class="mini-label">Completed</div>
                                <span class="mini-pct" id="miniPctCompleted">0%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="stat-pro-mini stat-pro-mini-purple">
                            <div class="mini-icon"><i class="bi bi-ticket-perforated-fill"></i></div>
                            <div class="mini-body">
                                <h3 class="mini-number" id="miniNumberTotal">{{ $totalTicket }}</h3>
                                <div class="mini-label">Total Tiket</div>
                                <span class="mini-pct" id="miniPctTotal">100%</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div
                    id="chartData"
                    data-todo="{{ $todo }}"
                    data-progress="{{ $progress }}"
                    data-completed="{{ $completed }}"
                    data-statsurl="{{ route('admin.dashboard.ticket-stats') }}">
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card timeline-card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">
                            <i class="bi bi-activity text-primary"></i>
                            Timeline Aktivitas
                        </h4>
                        <small class="text-muted">{{ $activities->count() }} aktivitas terbaru</small>
                    </div>
                </div>

                @forelse($activities as $activity)
                    <div class="timeline-item-modern">
                        <div class="timeline-dot
                            @if($activity->status=='Completed')
                                bg-success
                            @elseif($activity->status=='In Progress')
                                bg-info
                            @else
                                bg-warning
                            @endif">
                            @if($activity->status=='Completed')
                                <i class="bi bi-check"></i>
                            @elseif($activity->status=='In Progress')
                                <i class="bi bi-arrow-repeat"></i>
                            @else
                                <i class="bi bi-hourglass"></i>
                            @endif
                        </div>

                        <div class="timeline-card-item">
                            <strong>{{ $activity->kode_ticket }}</strong>
                            <p class="mb-1">
                                Status menjadi
                                <b>{{ $activity->status }}</b>
                            </p>
                            <small class="text-muted">{{ $activity->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-clock-history display-5 text-secondary"></i>
                        <p class="mt-3">Belum ada aktivitas.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

</div>

@push('scripts')
    @vite(['resources/js/chart.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@endsection