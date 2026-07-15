@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<style>

body{
    background:#F1F5F9;
    font-family:'Segoe UI',sans-serif;
}

.dashboard-header{
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.dashboard-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 18px;
    background:#eef4ff;
    color:#2563eb;
    border-radius:999px;
    font-weight:600;
    font-size:.9rem;
}

.dashboard-title{
    font-size:2rem;
    font-weight:700;
    margin-bottom:10px;
    color:#1e293b;
}

.dashboard-title span{
    color:#2563eb;
}

.dashboard-desc{
    font-size:1rem;
    color:#64748b;
    line-height:1.8;
    margin-bottom:0;
}

.account-status{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    border-radius:22px;
    padding:25px;
    display:flex;
    align-items:center;
    gap:18px;
    height:100%;
    box-shadow:0 10px 25px rgba(37,99,235,.25);
}

.status-icon{
    width:65px;
    height:65px;
    border-radius:50%;
    background:rgba(255,255,255,.18);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
}

.account-status small{
    display:block;
    opacity:.85;
}

.account-status h6{
    font-size:1.2rem;
    font-weight:700;
}

.account-status span{
    font-size:.9rem;
    opacity:.9;
}

/* ===========================
        CARD STATISTIK
=========================== */

.modern-card{
    position:relative;
    overflow:hidden;
    display:flex;
    align-items:center;
    gap:22px;
    min-height:180px;
    padding:28px;
    border-radius:24px;
    color:#fff;
    transition:.35s;
    box-shadow:0 15px 30px rgba(0,0,0,.12);
}

.modern-card:hover{
    transform:translateY(-10px) scale(1.02);
    box-shadow:0 25px 50px rgba(0,0,0,.18);
}

.modern-card::before{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    right:-80px;
    top:-80px;
}

.modern-card::after{
    content:"";
    position:absolute;
    width:120px;
    height:120px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
    left:-35px;
    bottom:-35px;
}

.icon-box{
    width:78px;
    height:78px;
    border-radius:22px;
    background:rgba(255,255,255,.18);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:34px;
    flex-shrink:0;
    transition:.35s;
}

.modern-card:hover .icon-box{
    transform:rotate(-8deg) scale(1.08);
}

.card-content{
    flex:1;
}

.card-content small{
    display:block;
    font-size:.95rem;
    opacity:.9;
    margin-bottom:8px;
}

.card-content h2{
    font-size:2.5rem;
    font-weight:700;
    margin-bottom:6px;
}

.card-content span{
    font-size:.92rem;
    opacity:.92;
}

.total-card{
    background:linear-gradient(135deg,#3B82F6,#2563EB,#1D4ED8);
}

.service-card{
    background:linear-gradient(135deg,#FBBF24,#F59E0B,#D97706);
}

.ticket-card{
    background:linear-gradient(135deg,#38BDF8,#06B6D4,#0891B2);
}

.complete-card{
    background:linear-gradient(135deg,#4ADE80,#22C55E,#15803D);
}
/* =====================================
        PROGRESS PENYELESAIAN
===================================== */

.progress-modern{
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,.08);
}

.progress-circle{
    width:90px;
    height:90px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:1.3rem;
    font-weight:700;
    box-shadow:0 10px 25px rgba(37,99,235,.30);
}

.modern-progress{
    height:16px;
    border-radius:30px;
    background:#E5E7EB;
    overflow:hidden;
}

.modern-progress .progress-bar{
    border-radius:30px;
    background:linear-gradient(90deg,#22C55E,#16A34A);
}

.status-box{
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px;
    border-radius:18px;
    transition:.3s;
}

.status-box:hover{
    transform:translateY(-4px);
}

.status-box i{
    font-size:28px;
}

.status-box strong{
    display:block;
    font-size:1.3rem;
}

.status-box small{
    color:#64748B;
}

.status-success{
    background:#ECFDF5;
    color:#16A34A;
}

.status-warning{
    background:#FFF7ED;
    color:#D97706;
}

.status-info{
    background:#EFF6FF;
    color:#2563EB;
}

/* =====================================
            QUICK MENU
===================================== */

.quick-card{
    border-radius:24px;
}

.quick-title-icon{
    width:52px;
    height:52px;
    border-radius:15px;
    background:#EEF4FF;
    color:#2563EB;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:22px;
    margin-right:15px;
}

.quick-menu{
    text-decoration:none;
    border-radius:20px;
    color:#fff;
    min-height:150px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    transition:.35s;
    position:relative;
    overflow:hidden;
}

.quick-menu::before{
    content:"";
    position:absolute;
    width:140px;
    height:140px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    right:-45px;
    top:-45px;
}

.quick-menu:hover{
    color:#fff;
    transform:translateY(-6px);
    box-shadow:0 20px 35px rgba(0,0,0,.18);
}

.quick-menu i{
    font-size:38px;
    margin-bottom:18px;
}

.quick-menu h6{
    margin:0;
    text-align:center;
    line-height:1.5;
    font-weight:700;
}

.quick-blue{
    background:linear-gradient(135deg,#2563EB,#1D4ED8);
}

.quick-green{
    background:linear-gradient(135deg,#16A34A,#15803D);
}

.quick-gray{
    background:linear-gradient(135deg,#475569,#334155);
    min-height:120px;
}
/* =====================================
            CHART
===================================== */

.chart-card{
    border-radius:24px;
    box-shadow:0 12px 35px rgba(0,0,0,.08);
}

.chart-card canvas{
    max-height:330px;
}

.chart-badge{
    background:#EEF4FF;
    color:#2563EB;
    font-weight:600;
    border-radius:30px;
    padding:8px 18px;
}

/* =====================================
        TIMELINE AKTIVITAS
===================================== */

.activity-card{
    border-radius:24px;
    box-shadow:0 12px 35px rgba(0,0,0,.08);
}

.activity-item{
    display:flex;
    gap:18px;
    margin-bottom:25px;
}

.activity-item:last-child{
    margin-bottom:0;
}

.activity-icon{
    width:55px;
    height:55px;
    border-radius:16px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:22px;
    color:#fff;
    flex-shrink:0;
}

.activity-primary{
    background:linear-gradient(135deg,#2563EB,#1D4ED8);
}

.activity-success{
    background:linear-gradient(135deg,#22C55E,#15803D);
}

.activity-warning{
    background:linear-gradient(135deg,#F59E0B,#D97706);
}

.activity-info{
    background:linear-gradient(135deg,#06B6D4,#0891B2);
}

.activity-content h6{
    margin-bottom:4px;
    font-weight:700;
}

.activity-content p{
    margin-bottom:4px;
    color:#64748B;
    font-size:.92rem;
}

.activity-content small{
    color:#94A3B8;
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

Kelola seluruh sistem Helpdesk Diskominfo Kabupaten Pemalang.
Pantau statistik tiket, kelola layanan, pengguna, serta aktivitas
helpdesk dalam satu dashboard.

</p>

</div>

<div class="col-lg-4">

<div class="account-status">

<div class="status-icon">

<i class="bi bi-shield-check"></i>

</div>

<div>

<small>Status Sistem</small>

<h6 class="mb-1">

Administrator

</h6>

<span>

Seluruh fitur administrasi aktif.

</span>

</div>

</div>

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

<h2 class="counter" data-target="{{ $totalUser }}">
0
</h2>

<span>
Seluruh pengguna sistem.
</span>

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

<h2 class="counter" data-target="{{ $totalService }}">
0
</h2>

<span>
Layanan yang tersedia.
</span>

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

<h2 class="counter" data-target="{{ $totalTicket }}">
0
</h2>

<span>
Seluruh tiket yang masuk.
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

<h2 class="counter" data-target="{{ $completed }}">
0
</h2>

<span>
Tiket berhasil diselesaikan.
</span>

</div>

</div>

</div>

</div>
<div class="row g-4 mb-4">

    {{-- Progress Penyelesaian --}}
    <div class="col-lg-8">

        <div class="card progress-modern border-0 h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h4 class="fw-bold mb-1">
                            Progress Penyelesaian
                        </h4>

                        <small class="text-muted">
                            Ringkasan penyelesaian seluruh tiket Helpdesk.
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

                    tiket berhasil diselesaikan.

                </div>

                <div class="row g-3">

                    <div class="col-md-4">

                        <div class="status-box status-success">

                            <i class="bi bi-check-circle-fill"></i>

                            <div>

                                <strong>{{ $completed }}</strong>

                                <small>Completed</small>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="status-box status-warning">

                            <i class="bi bi-hourglass-split"></i>

                            <div>

                                <strong>{{ $todo }}</strong>

                                <small>To Do</small>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

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

    {{-- Quick Action --}}
    <div class="col-lg-4">

        <div class="card quick-card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div class="quick-title-icon">

                        <i class="bi bi-lightning-charge-fill"></i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Aksi Cepat
                        </h4>

                        <small class="text-muted">
                            Menu administrasi yang sering digunakan.
                        </small>

                    </div>

                </div>

                <div class="row g-3">

                    <div class="col-6">

                        <a href="{{ route('admin.user.index') }}"
                           class="quick-menu quick-blue">

                            <i class="bi bi-people-fill"></i>

                            <h6>Kelola<br>User</h6>

                        </a>

                    </div>

                    <div class="col-6">

                        <a href="{{ route('admin.service.index') }}"
                           class="quick-menu quick-green">

                            <i class="bi bi-tools"></i>

                            <h6>Kelola<br>Layanan</h6>

                        </a>

                    </div>

                    <div class="col-12">

                        <a href="{{ route('admin.ticket.index') }}"
                           class="quick-menu quick-gray">

                            <i class="bi bi-ticket-perforated-fill"></i>

                            <h6>Kelola Tiket</h6>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="row g-4">

    {{-- Statistik Tiket --}}
    <div class="col-lg-8">

        <div class="card chart-card border-0 h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h4 class="fw-bold mb-1">

                            Statistik Tiket

                        </h4>

                        <small class="text-muted">

                            Distribusi status tiket Helpdesk.

                        </small>

                    </div>

                    <span class="chart-badge">

                        {{ $totalTicket }} Tiket

                    </span>

                </div>

                <div id="chartData"

                     data-todo="{{ $todo }}"
                     data-progress="{{ $progress }}"
                     data-completed="{{ $completed }}">

                    <canvas id="ticketChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    {{-- Timeline Aktivitas --}}
    <div class="col-lg-4">

        <div class="card activity-card border-0 h-100">

            <div class="card-body p-4">

                <h4 class="fw-bold mb-4">

                    Aktivitas Sistem

                </h4>

                <div class="activity-item">

                    <div class="activity-icon activity-primary">

                        <i class="bi bi-people-fill"></i>

                    </div>

                    <div class="activity-content">

                        <h6>Total User</h6>

                        <p>

                            Saat ini terdapat

                            <strong>{{ $totalUser }}</strong>

                            pengguna terdaftar.

                        </p>

                        <small>Data realtime</small>

                    </div>

                </div>

                <div class="activity-item">

                    <div class="activity-icon activity-success">

                        <i class="bi bi-tools"></i>

                    </div>

                    <div class="activity-content">

                        <h6>Total Layanan</h6>

                        <p>

                            Sistem memiliki

                            <strong>{{ $totalService }}</strong>

                            layanan aktif.

                        </p>

                        <small>Data realtime</small>

                    </div>

                </div>

                <div class="activity-item">

                    <div class="activity-icon activity-warning">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                    <div class="activity-content">

                        <h6>Tiket Diproses</h6>

                        <p>

                            <strong>{{ $progress }}</strong>

                            tiket sedang dikerjakan.

                        </p>

                        <small>Update terbaru</small>

                    </div>

                </div>

                <div class="activity-item">

                    <div class="activity-icon activity-info">

                        <i class="bi bi-check-circle-fill"></i>

                    </div>

                    <div class="activity-content">

                        <h6>Tiket Selesai</h6>

                        <p>

                            <strong>{{ $completed }}</strong>

                            tiket telah selesai.

                        </p>

                        <small>Monitoring Helpdesk</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ===========================
    // CHART DATA
    // ===========================

    const chartElement = document.getElementById('chartData');

    if(chartElement){

        const todo = parseInt(chartElement.dataset.todo);
        const progress = parseInt(chartElement.dataset.progress);
        const completed = parseInt(chartElement.dataset.completed);

        const total = todo + progress + completed;

        const ctx = document.getElementById('ticketChart').getContext('2d');

        // Gradient
        const gradientTodo = ctx.createLinearGradient(0,0,0,400);
        gradientTodo.addColorStop(0,"#FACC15");
        gradientTodo.addColorStop(1,"#D97706");

        const gradientProgress = ctx.createLinearGradient(0,0,0,400);
        gradientProgress.addColorStop(0,"#38BDF8");
        gradientProgress.addColorStop(1,"#0284C7");

        const gradientCompleted = ctx.createLinearGradient(0,0,0,400);
        gradientCompleted.addColorStop(0,"#4ADE80");
        gradientCompleted.addColorStop(1,"#15803D");

        new Chart(ctx,{

            type:'doughnut',

            data:{

                labels:[
                    'To Do',
                    'In Progress',
                    'Completed'
                ],

                datasets:[{

                    data:[
                        todo,
                        progress,
                        completed
                    ],

                    backgroundColor:[
                        gradientTodo,
                        gradientProgress,
                        gradientCompleted
                    ],

                    borderColor:'#fff',

                    borderWidth:5,

                    hoverOffset:18

                }]

            },

            options:{

                responsive:true,

                maintainAspectRatio:false,

                cutout:'68%',

                animation:{
                    animateRotate:true,
                    duration:1800
                },

                plugins:{

                    legend:{

                        position:'bottom',

                        labels:{

                            usePointStyle:true,

                            pointStyle:'circle',

                            padding:20,

                            font:{
                                size:13,
                                weight:'600'
                            }

                        }

                    },

                    tooltip:{

                        backgroundColor:'#1E293B',

                        padding:12,

                        callbacks:{

                            label:function(context){

                                let value=context.raw;

                                let percent=((value/total)*100).toFixed(1);

                                return value+' Tiket ('+percent+'%)';

                            }

                        }

                    }

                }

            }

        });

    }

    // ===========================
    // COUNTER ANIMATION
    // ===========================

    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter=>{

        const target=parseInt(counter.dataset.target);

        let count=0;

        const speed=Math.max(15,1200/Math.max(target,1));

        function updateCounter(){

            if(count<target){

                count++;

                counter.innerText=count;

                setTimeout(updateCounter,speed);

            }else{

                counter.innerText=target;

            }

        }

        updateCounter();

    });

    // ===========================
    // CARD HOVER EFFECT
    // ===========================

    document.querySelectorAll('.modern-card').forEach(card=>{

        card.addEventListener('mouseenter',()=>{

            card.style.transition=".35s";

        });

    });

});
</script>

@endpush

@endsection