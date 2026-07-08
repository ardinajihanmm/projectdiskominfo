@extends('layouts.staff')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-clock-history text-primary"></i>
            Timeline Aktivitas
        </h2>
        <small class="text-muted">
            Riwayat aktivitas staff saat menggunakan sistem Helpdesk.
        </small>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">

            <div class="timeline">

                <div class="timeline-item">
                    <div class="timeline-icon bg-success">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Login ke Sistem</h6>
                        <small class="text-muted">08 Jul 2026 • 08:00 WIB</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon bg-primary">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Membuka tiket TCK-ABCD123</h6>
                        <small class="text-muted">08 Jul 2026 • 08:05 WIB</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon bg-warning">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Mengubah status menjadi <b>In Progress</b></h6>
                        <small class="text-muted">08 Jul 2026 • 08:10 WIB</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon bg-info">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Menambahkan komentar pada tiket</h6>
                        <small class="text-muted">08 Jul 2026 • 08:20 WIB</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon bg-success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Menyelesaikan tiket</h6>
                        <small class="text-muted">08 Jul 2026 • 08:45 WIB</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-icon bg-danger">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Logout</h6>
                        <small class="text-muted">08 Jul 2026 • 17:00 WIB</small>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<style>
.timeline{
    position:relative;
    margin-left:20px;
    border-left:3px solid #0d6efd;
    padding-left:30px;
}

.timeline-item{
    position:relative;
    margin-bottom:35px;
}

.timeline-icon{
    position:absolute;
    left:-46px;
    width:34px;
    height:34px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
}

.timeline-content{
    background:#fff;
    border-radius:10px;
    padding:15px 20px;
    box-shadow:0 3px 10px rgba(0,0,0,.08);
}
</style>

@endsection