@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>

body{
    background:#f4f6fb;
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

}

/* ===========================
        Dashboard Header
=========================== */

.dashboard-title{
    font-size:30px;
    font-weight:700;
    color:#2c3e50;
}

.dashboard-subtitle{
    color:#6c757d;
    font-size:15px;
}

/* ===========================
        Statistic Card
=========================== */

.stat-card{
    border:none;
    border-radius:22px;
    overflow:hidden;
    transition:.35s;
    box-shadow:0 .4rem 1rem rgba(0,0,0,.08);
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 .8rem 1.6rem rgba(0,0,0,.15);
}

.stat-icon{
    width:70px;
    height:70px;
    border-radius:50%;
    background:rgba(255,255,255,.25);

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:28px;
}

.stat-number{
    font-size:36px;
    font-weight:700;
    margin:0;
}

.stat-label{
    opacity:.9;
    margin-bottom:6px;
}

/* Gradient */

.bg-user{

background:linear-gradient(135deg,#4e73df,#224abe);

}

.bg-service{

background:linear-gradient(135deg,#1cc88a,#13855c);

}

.bg-ticket{

background:linear-gradient(135deg,#343a40,#212529);

}

/* ===========================
        Status Card
=========================== */

.status-card{

border:none;
border-radius:18px;
box-shadow:0 .3rem .8rem rgba(0,0,0,.08);
transition:.3s;

}

.status-card:hover{

transform:translateY(-5px);

}

.status-number{

font-size:32px;
font-weight:bold;

}

/* ===========================
        Progress Card
=========================== */

.progress-card{

border:none;
border-radius:20px;
box-shadow:0 .4rem 1rem rgba(0,0,0,.08);

}

.progress{

height:14px;
border-radius:20px;

}

.progress-bar{

border-radius:20px;

}
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

}

.card-content{
    flex:1;
}

.card-content h2{

    font-size:2.7rem;
    font-weight:700;

}

.card-content small{

    display:block;

    font-size:.95rem;

    opacity:.9;

}

.card-content span{

    opacity:.92;

}

.total-card{

background:linear-gradient(
135deg,
#3B82F6,
#2563EB,
#1D4ED8
);

}

.service-card{

background:linear-gradient(
135deg,
#FBBF24,
#F59E0B,
#D97706
);

}

.ticket-card{

background:linear-gradient(
135deg,
#38BDF8,
#06B6D4,
#0891B2
);

}

.complete-card{

background:linear-gradient(
135deg,
#4ADE80,
#22C55E,
#15803D
);

}

.modern-panel{

    background:#fff;
    border-radius:24px;
    padding:28px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);

}

.panel-title{

    font-size:1.1rem;
    font-weight:700;
    margin-bottom:25px;

    display:flex;
    align-items:center;
    gap:10px;

}

.quick-btn{

    display:flex;
    align-items:center;
    gap:18px;

    padding:18px;

    border-radius:18px;

    text-decoration:none;

    color:#1e293b;

    margin-bottom:18px;

    transition:.3s;

}

.quick-btn:hover{

    transform:translateX(8px);

}

.quick-btn>i:first-child{

    width:55px;
    height:55px;

    border-radius:16px;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:24px;

    color:#fff;

}

.quick-btn i:last-child{

    margin-left:auto;

    font-size:20px;

}

.btn-user>i:first-child{

    background:#2563eb;

}

.btn-service>i:first-child{

    background:#10b981;

}

.btn-ticket>i:first-child{

    background:#111827;

}

.status-box{

    border-radius:18px;

    padding:18px;

    color:#fff;

}

.status-box h3{

    margin-top:8px;

    font-size:30px;

    font-weight:700;

}

.warning{

    background:linear-gradient(135deg,#f59e0b,#d97706);

}

.info{

    background:linear-gradient(135deg,#3b82f6,#2563eb);

}

.success{

    background:linear-gradient(135deg,#22c55e,#16a34a);

}

</style>

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="dashboard-header mb-4">

    <div class="row align-items-center">

        <div class="col-lg-12">

            <div class="dashboard-badge mb-3">

                <i class="bi bi-house-door-fill"></i>

                Dashboard

            </div>

            <h1 class="dashboard-title">

                Selamat Datang,

                <span>{{ Auth::user()->name }}</span>

            </h1>

            <p class="dashboard-desc">

                Kelola seluruh sistem Helpdesk Diskominfo mulai dari
                data user, layanan, tiket hingga monitoring proses
                penyelesaian tiket.

            </p>

        </div>

  <div class="row g-4 mb-4">

    <div class="col-lg-3">

        <div class="modern-card total-card">

            <div class="icon-box">

                <i class="bi bi-people-fill"></i>

            </div>

            <div class="card-content">

                <small>Total User</small>

                <h2 class="counter"
                    data-target="{{ $totalUser }}">
                    {{ $totalUser }}
                </h2>

                <span>Seluruh pengguna sistem.</span>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="modern-card service-card">

            <div class="icon-box">

                <i class="bi bi-tools"></i>

            </div>

            <div class="card-content">

                <small>Total Layanan</small>

                <h2 class="counter"
                    data-target="{{ $totalService }}">
                    {{ $totalService }}
                </h2>

                <span>Layanan tersedia.</span>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="modern-card ticket-card">

            <div class="icon-box">

                <i class="bi bi-ticket-perforated-fill"></i>

            </div>

            <div class="card-content">

                <small>Total Tiket</small>

                <h2 class="counter"
                    data-target="{{ $totalTicket }}">
                    {{ $totalTicket }}
                </h2>

                <span>Tiket yang masuk.</span>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="modern-card complete-card">

            <div class="icon-box">

                <i class="bi bi-check-circle-fill"></i>

            </div>

            <div class="card-content">

                <small>Completed</small>

                <h2 class="counter"
                    data-target="{{ $completed }}">
                    {{ $completed }}
                </h2>

                <span>Tiket berhasil selesai.</span>

            </div>

        </div>

    </div>

</div>
{{-- =========================
        QUICK ACTION + CHART
========================= --}}

<div class="row g-4 mb-4">

    <div class="col-lg-4">

        <div class="modern-panel h-100">

            <div class="panel-title">
                <i class="bi bi-lightning-charge-fill text-warning"></i>
                Quick Action
            </div>

            <a href="{{ route('admin.user.index') }}" class="quick-btn btn-user">
                <i class="bi bi-people-fill"></i>
                <div>
                    <strong>Kelola User</strong>
                    <small>Tambah & edit pengguna</small>
                </div>
                <i class="bi bi-arrow-right"></i>
            </a>

            <a href="{{ route('admin.service.index') }}" class="quick-btn btn-service">
                <i class="bi bi-tools"></i>
                <div>
                    <strong>Kelola Layanan</strong>
                    <small>Data seluruh layanan</small>
                </div>
                <i class="bi bi-arrow-right"></i>
            </a>

            <a href="{{ route('admin.ticket.index') }}" class="quick-btn btn-ticket">
                <i class="bi bi-ticket-perforated-fill"></i>
                <div>
                    <strong>Kelola Tiket</strong>
                    <small>Lihat semua tiket</small>
                </div>
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="modern-panel h-100">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="panel-title mb-0">
                    <i class="bi bi-pie-chart-fill text-primary"></i>
                    Statistik Tiket
                </div>

                <span class="badge bg-primary rounded-pill px-3 py-2">

                    {{ $totalTicket }} Tiket

                </span>

            </div>

            <div class="row align-items-center">

                <div class="col-md-7">

                    <div id="chartData"
                         data-todo="{{ $todo }}"
                         data-progress="{{ $progress }}"
                         data-completed="{{ $completed }}"
                         style="height:320px;">

                        <canvas id="ticketChart"></canvas>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="status-box warning">

                        <span>To Do</span>

                        <h3>{{ $todo }}</h3>

                    </div>

                    <div class="status-box info mt-3">

                        <span>In Progress</span>

                        <h3>{{ $progress }}</h3>

                    </div>

                    <div class="status-box success mt-3">

                        <span>Completed</span>

                        <h3>{{ $completed }}</h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
        SYSTEM OVERVIEW
========================= --}}

<div class="row g-4 mt-2">

    <div class="col-lg-8">

        <div class="modern-panel">

            <div class="panel-title">
                <i class="bi bi-activity text-primary"></i>
                Aktivitas Sistem
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="modern-card total-card py-3">
                        <div class="icon-box">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="card-content">
                            <small>Total User</small>
                            <h3>{{ $totalUser }}</h3>
                            <span>Pengguna aktif dalam sistem</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="modern-card service-card py-3">
                        <div class="icon-box">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div class="card-content">
                            <small>Total Layanan</small>
                            <h3>{{ $totalService }}</h3>
                            <span>Layanan tersedia</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="modern-card ticket-card py-3">
                        <div class="icon-box">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </div>
                        <div class="card-content">
                            <small>Total Tiket</small>
                            <h3>{{ $totalTicket }}</h3>
                            <span>Tiket yang masuk</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="modern-card complete-card py-3">
                        <div class="icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="card-content">
                            <small>Completed</small>
                            <h3>{{ $completed }}</h3>
                            <span>Tiket berhasil diselesaikan</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="modern-panel h-100">

            <div class="panel-title">
                <i class="bi bi-bar-chart-fill text-success"></i>
                System Overview
            </div>

            <div class="overview-box">

                <small>Penyelesaian Tiket</small>

                <h2>
                    {{ $totalTicket==0 ? 0 : round(($completed/$totalTicket)*100) }}%
                </h2>

                <div class="progress mt-3">

                    <div class="progress-bar bg-success"
                        style="width: {{ $totalTicket==0 ? 0 : round(($completed/$totalTicket)*100) }}%">
                    </div>

                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-between mb-3">
                <span>To Do</span>
                <strong class="text-warning">{{ $todo }}</strong>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <span>In Progress</span>
                <strong class="text-info">{{ $progress }}</strong>
            </div>

            <div class="d-flex justify-content-between">
                <span>Completed</span>
                <strong class="text-success">{{ $completed }}</strong>
            </div>

        </div>

    </div>

</div>


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const chart = document.getElementById('chartData');

    const todo = parseInt(chart.dataset.todo);
    const progress = parseInt(chart.dataset.progress);
    const completed = parseInt(chart.dataset.completed);

    const total = todo + progress + completed;

    const ctx = document.getElementById('ticketChart').getContext('2d');

    // Gradient warna
    const gradient1 = ctx.createLinearGradient(0,0,0,400);
    gradient1.addColorStop(0,"#FFD54F");
    gradient1.addColorStop(1,"#F9A825");

    const gradient2 = ctx.createLinearGradient(0,0,0,400);
    gradient2.addColorStop(0,"#4FC3F7");
    gradient2.addColorStop(1,"#0288D1");

    const gradient3 = ctx.createLinearGradient(0,0,0,400);
    gradient3.addColorStop(0,"#66BB6A");
    gradient3.addColorStop(1,"#2E7D32");

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
                    gradient1,
                    gradient2,
                    gradient3
                ],

                borderWidth:5,

                borderColor:'#fff',

                hoverOffset:20

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            cutout:'70%',

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

                    backgroundColor:"#212529",

                    padding:12,

                    titleFont:{
                        size:14
                    },

                    bodyFont:{
                        size:13
                    },

                    callbacks:{

                        label:function(context){

                            let value=context.raw;

                            let percent=((value/total)*100).toFixed(1);

                            return " "+value+" Tiket ("+percent+"%)";

                        }

                    }

                }

            }
        }
    });
    const counters=document.querySelectorAll('.stat-number,.status-number');
    counters.forEach(counter=>{
        const target=parseInt(counter.innerText);
        let count=0;
        const speed=Math.max(10,1000/Math.max(target,1));
        const update=()=>{
            if(count<target){
                count++;
                counter.innerText=count;
                setTimeout(update,speed);
            }else{
                counter.innerText=target;
            }
        }
        update();
    });
    document.querySelectorAll('.card').forEach(card=>{
        card.addEventListener('mouseenter',()=>{
            card.style.transition=".3s";
        });
    });
});
</script>
@endpush
@endsection