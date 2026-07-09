@extends('layouts.admin')

@section('content')

<style>

body{
    background:#f4f6fb;
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

</style>

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="dashboard-title">
                Dashboard Admin
            </h2>

            <div class="dashboard-subtitle">

                Selamat datang kembali,
                <strong>{{ Auth::user()->name }}</strong>

            </div>

        </div>

        <div class="text-end">

            <small class="text-muted">
                {{ now()->format('l, d F Y') }}
            </small>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="row g-4">

        {{-- User --}}
        <div class="col-lg-4">

            <div class="card stat-card bg-user text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="stat-label">
                                Total User
                            </div>

                            <h1 class="stat-number">

                                {{ $totalUser }}

                            </h1>

                        </div>

                        <div class="stat-icon">

                            <i class="bi bi-people-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Layanan --}}
        <div class="col-lg-4">

            <div class="card stat-card bg-service text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="stat-label">

                                Total Layanan

                            </div>

                            <h1 class="stat-number">

                                {{ $totalService }}

                            </h1>

                        </div>

                        <div class="stat-icon">

                            <i class="bi bi-tools"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Tiket --}}
        <div class="col-lg-4">

            <div class="card stat-card bg-ticket text-white">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="stat-label">

                                Total Tiket

                            </div>

                            <h1 class="stat-number">

                                {{ $totalTicket }}

                            </h1>

                        </div>

                        <div class="stat-icon">

                            <i class="bi bi-ticket-perforated-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Status Ticket --}}
    <div class="row g-4 mt-1">

        <div class="col-md-4">

            <div class="card status-card border-start border-5 border-warning">

                <div class="card-body">

                    <div class="text-muted">

                        To Do

                    </div>

                    <div class="status-number text-warning">

                        {{ $todo }}

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card status-card border-start border-5 border-info">

                <div class="card-body">

                    <div class="text-muted">

                        In Progress

                    </div>

                    <div class="status-number text-info">

                        {{ $progress }}

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card status-card border-start border-5 border-success">

                <div class="card-body">

                    <div class="text-muted">

                        Completed

                    </div>

                    <div class="status-number text-success">

                        {{ $completed }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Progress --}}
    <div class="card progress-card mt-4">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between">

                <h5 class="mb-3">

                    Progress Penyelesaian Tiket

                </h5>

                <strong>

                    {{ $totalTicket == 0 ? 0 : round(($completed/$totalTicket)*100) }}%

                </strong>

            </div>

            <div class="progress">

                <div class="progress-bar bg-success"

                     style="width: {{ $totalTicket == 0 ? 0 : round(($completed/$totalTicket)*100) }}%">

                </div>

            </div>

            <div class="mt-2 text-muted">

                {{ $completed }} tiket telah selesai dari total {{ $totalTicket }} tiket.

            </div>

        </div>

    </div>

{{-- =========================
        QUICK ACTION
========================= --}}

<div class="row mt-4">

    <div class="col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold">
                    <i class="bi bi-lightning-charge-fill text-warning me-2"></i>
                    Quick Action
                </h5>

            </div>

            <div class="card-body">

                <a href="{{ route('admin.user.index') }}"
                   class="btn btn-primary w-100 mb-3 py-3 rounded-4">

                    <i class="bi bi-people-fill me-2"></i>

                    Kelola User

                </a>

                <a href="{{ route('admin.service.index') }}"
                   class="btn btn-success w-100 mb-3 py-3 rounded-4">

                    <i class="bi bi-tools me-2"></i>

                    Kelola Layanan

                </a>

                <a href="{{ route('admin.ticket.index') }}"
                   class="btn btn-dark w-100 mb-3 py-3 rounded-4">

                    <i class="bi bi-ticket-perforated-fill me-2"></i>

                    Kelola Tiket

                </a>

            </div>

        </div>

    </div>





    {{-- =========================
            CHART
    ========================= --}}

    <div class="col-lg-8">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold">

                    <i class="bi bi-pie-chart-fill text-primary me-2"></i>

                    Statistik Tiket

                </h5>

            </div>

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-7">

                        <div id="chartData"

                            data-todo="{{ $todo }}"
                            data-progress="{{ $progress }}"
                            data-completed="{{ $completed }}"

                            style="height:370px;">

                            <canvas id="ticketChart"></canvas>

                        </div>

                    </div>





                    <div class="col-md-5">

                        <div class="card border-warning border-2 rounded-4 mb-3">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <small class="text-muted">

                                            To Do

                                        </small>

                                        <h3 class="fw-bold text-warning">

                                            {{ $todo }}

                                        </h3>

                                    </div>

                                    <i class="bi bi-hourglass-split fs-2 text-warning"></i>

                                </div>

                            </div>

                        </div>





                        <div class="card border-info border-2 rounded-4 mb-3">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <small class="text-muted">

                                            In Progress

                                        </small>

                                        <h3 class="fw-bold text-info">

                                            {{ $progress }}

                                        </h3>

                                    </div>

                                    <i class="bi bi-arrow-repeat fs-2 text-info"></i>

                                </div>

                            </div>

                        </div>





                        <div class="card border-success border-2 rounded-4">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <small class="text-muted">

                                            Completed

                                        </small>

                                        <h3 class="fw-bold text-success">

                                            {{ $completed }}

                                        </h3>

                                    </div>

                                    <i class="bi bi-check-circle-fill fs-2 text-success"></i>

                                </div>

                            </div>

                        </div>





                    </div>

                </div>

            </div>

        </div>

    </div>

</div>





{{-- =========================
        RINGKASAN
========================= --}}

<div class="row mt-4">

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold">

                    <i class="bi bi-info-circle-fill text-primary me-2"></i>

                    Ringkasan Sistem

                </h5>

            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">

                    <span>Total User</span>

                    <strong>{{ $totalUser }}</strong>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <span>Total Layanan</span>

                    <strong>{{ $totalService }}</strong>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <span>Total Tiket</span>

                    <strong>{{ $totalTicket }}</strong>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <span>Tiket Selesai</span>

                    <span class="badge bg-success fs-6">

                        {{ $completed }}

                    </span>

                </div>

            </div>

        </div>

    </div>





    <div class="col-lg-6">

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold">

                    <i class="bi bi-clock-history text-danger me-2"></i>

                    Status Tiket

                </h5>

            </div>

            <div class="card-body">

                <div class="mb-4">

                    <div class="d-flex justify-content-between">

                        <span>To Do</span>

                        <strong>{{ $todo }}</strong>

                    </div>

                    <div class="progress mt-2">

                        <div class="progress-bar bg-warning"

                            style="width: {{ $totalTicket ? ($todo/$totalTicket)*100 : 0 }}%">

                        </div>

                    </div>

                </div>





                <div class="mb-4">

                    <div class="d-flex justify-content-between">

                        <span>In Progress</span>

                        <strong>{{ $progress }}</strong>

                    </div>

                    <div class="progress mt-2">

                        <div class="progress-bar bg-info"

                            style="width: {{ $totalTicket ? ($progress/$totalTicket)*100 : 0 }}%">

                        </div>

                    </div>

                </div>





                <div>

                    <div class="d-flex justify-content-between">

                        <span>Completed</span>

                        <strong>{{ $completed }}</strong>

                    </div>

                    <div class="progress mt-2">

                        <div class="progress-bar bg-success"

                            style="width: {{ $totalTicket ? ($completed/$totalTicket)*100 : 0 }}%">

                        </div>

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