<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Helpdesk')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

    body{
    background:#F1F5F9;
    font-family:'Segoe UI',sans-serif;
    overflow-x:hidden;
}

.sidebar{

    width:260px;
    height:100vh;

    background:linear-gradient(
        180deg,
        #0d6efd,
        #2563eb,
        #1e40af
    );

    display:flex;
    flex-direction:column;

    position:fixed;
    left:0;
    top:0;

    overflow-y:auto;
    overflow-x:hidden;

    box-shadow:8px 0 25px rgba(0,0,0,.08);

}

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-track{
    background:transparent;
}

.sidebar::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,.35);
    border-radius:20px;
}

.sidebar::-webkit-scrollbar-thumb:hover{
    background:rgba(255,255,255,.7);
}

.logo{

    padding:28px 20px 15px;

    text-align:center;

    color:white;

}

.logo h3{

    font-weight:700;

    margin-bottom:0;

    letter-spacing:1px;

}

.logo small{

    opacity:.8;

}

.profile{

    text-align:center;

    padding:20px;

}

.avatar{

    width:90px;
    height:90px;

    margin:auto;

    border-radius:50%;

    overflow:hidden;

    background:white;

    display:flex;

    justify-content:center;

    align-items:center;

    box-shadow:0 8px 20px rgba(0,0,0,.18);

    border:4px solid rgba(255,255,255,.3);

}

.avatar img{

    width:100%;
    height:100%;
    object-fit:cover;

}

.profile h5{

    color:white;

    margin-top:15px;

    margin-bottom:2px;

}

.profile small{

    color:#dbeafe;

}

.menu{

    padding:15px;

}

.menu a{

    color:white;

    text-decoration:none;

    display:flex;

    align-items:center;

    gap:12px;

    padding:14px 18px;

    margin-bottom:10px;

    border-radius:14px;

    transition:.3s;

    font-weight:500;

}

.menu a:hover{

    background:rgba(255,255,255,.15);

    transform:translateX(6px);

}

.menu a.active{

    background:white;

    color:#0d6efd;

    box-shadow:0 10px 20px rgba(0,0,0,.15);

}

.menu i{

    font-size:18px;

}

.logout{

    margin-top:auto;

    padding:20px;

}

.logout button{

    width:100%;

    border:none;

    border-radius:14px;

    padding:12px;

    background:#ef4444;

    color:white;

    font-weight:600;

    transition:.3s;

}

.logout button:hover{

    background:#dc2626;

    transform:translateY(-2px);

}

.menu{
    flex:1;
    padding:15px;
}

.sidebar-footer{
    padding:20px;
    margin-top:auto;
}
.content{
    margin-left:260px;
    height:100vh;
    display:flex;
    flex-direction:column;
    overflow:hidden;
}

.topbar{
    height:70px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
    box-shadow:0 2px 12px rgba(0,0,0,.05);

    position: relative;
    overflow: visible;
    z-index: 1000;
}
.main{
    flex:1;
    overflow-y:auto;
    padding:30px;
}

.footer{
    padding:20px 30px;
    color:#64748B;
    font-size:14px;
}

.dropdown-menu{
    width:360px;
    max-height:420px;
    overflow-y:auto;
    margin-top:12px !important;
}

.dropdown-item{
    white-space:normal !important;
    word-break:break-word;
}

.dropdown-item small{
    display:block;
    white-space:normal;
}

.offcanvas{

    width:430px !important;

}

.notification-card{

    display:flex;

    gap:15px;

    padding:18px 20px;

    text-decoration:none;

    color:#333;

    border-bottom:1px solid #ECECEC;

    transition:.2s;

}

.notification-card:hover{

    background:#F8FAFC;

}

.notification-icon{
    width:48px;
    height:48px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#EFF6FF;
    font-size:22px;
    flex-shrink:0;
}

.notification-card h6{
    margin:0;
    font-weight:700;
}

.notification-card p{
    margin:5px 0;
    color:#64748B;
    font-size:14px;
}

.notification-card small{
    color:#94A3B8;
}
  

.timeline-item{
    display:flex;
    gap:18px;
    margin-bottom:25px;
    position:relative;
}

.timeline-item:not(:last-child)::after{
    content:"";
    position:absolute;
    left:20px;
    top:48px;
    width:2px;
    height:55px;
    background:#D1D5DB;
}

.timeline-icon{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#EFF6FF;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    font-size:18px;
}

.timeline-content{
    flex:1;
}

.timeline-content h6{
    margin-bottom:5px;
    font-weight:600;
}

.timeline-content p{
    margin-bottom:6px;
    color:#64748B;
    font-size:14px;
}

.step-wrapper{
    position:relative;
}

.step-wrapper::before{
    content:"";
    position:absolute;
    top:24px;
    left:12%;
    right:12%;
    height:3px;
    background:#D1D5DB;
    z-index:0;
}

.step-item{
    position:relative;
    z-index:2;
}

.step-number{
    width:56px;
    height:56px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    color:#fff;
    font-size:22px;
    font-weight:700;
    box-shadow:0 8px 18px rgba(0,0,0,.12);
}

.step-title{
    margin-top:20px;
    margin-bottom:10px;
    font-weight:700;
}

.step-desc{
    color:#6B7280;
    font-size:15px;
    line-height:1.6;
    max-width:180px;
    margin:auto;
}
.timeline-item{
    position:relative;
    padding-left:60px;
    padding-bottom:25px;
}

.timeline-item:last-child{
    padding-bottom:0;
}

.timeline-item::before{
    content:"";
    position:absolute;
    left:20px;
    top:42px;
    width:2px;
    height:100%;
    background:#E5E7EB;
}

.timeline-item:last-child::before{
    display:none;
}

.timeline-icon{
    position:absolute;
    left:0;
    top:0;
    width:42px;
    height:42px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#EFF6FF;
    font-size:18px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.timeline-content h6{
    margin-bottom:4px;
    font-weight:700;
}

.timeline-content p{
    margin-bottom:6px;
    color:#6B7280;
    font-size:14px;
}

.timeline-content small{
    color:#9CA3AF;
}
.timeline-card .card-body{
    max-height:350px;
    overflow-y:auto;
}
.table thead th{

font-size:.85rem;

font-weight:700;

text-transform:uppercase;

letter-spacing:.5px;

color:#6c757d;

border-bottom:1px solid #dee2e6;

}
.table tbody tr{

transition:.25s;

}

.table tbody tr:hover{

background:#f8fbff;

}

.notification-card{
    transition: all .25s ease;
}

.notification-read{
    background:#f8fafc;
}

.notification-read h6,
.notification-read p,
.notification-read small{
    color: #6c757d !important;
}
.notification-card .btn{
    height:38px;
    border-radius:999px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    white-space: nowrap;
    font-weight:600;      /* Tambahkan ini */
}

.notification-card .badge{
    height:38px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:0 18px;
    border-radius:999px;
    font-size:.9rem;
    font-weight:600;      /* Tambahkan ini */
}

.notification-card{
    transition:.2s;
}

.notification-card:hover{
    background:#f8fafc;
}

.notification-card .btn{
    transition:.2s;
}

.notification-card .btn:hover{
    transform:translateY(-1px);
}
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

.bg-total{

background:linear-gradient(135deg,#2563EB,#1D4ED8);

}

.bg-todo{

background:linear-gradient(135deg,#F59E0B,#D97706);

}

.bg-progress{

background:linear-gradient(135deg,#06B6D4,#0891B2);

}

.bg-completed{

background:linear-gradient(135deg,#22C55E,#15803D);

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

    align-items:center;

    justify-content:center;

    font-size:30px;

}

.account-status small{

    opacity:.8;

    display:block;

    margin-bottom:5px;

}

.account-status h6{

    font-size:1.2rem;

    font-weight:700;

}

.account-status span{

    font-size:.9rem;

    opacity:.9;

}
.modern-card{

    position:relative;
    overflow:hidden;

    display:flex;
    align-items:center;
    gap:22px;

    min-height:180px;
    height:180px;

    padding:28px;

    border-radius:24px;

    color:#fff;

    transition:.35s cubic-bezier(.4,0,.2,1);

    box-shadow:0 15px 30px rgba(0,0,0,.12);

}
.card-content{

    flex:1;

    display:flex;

    flex-direction:column;

    justify-content:center;

    height:100%;

}
.modern-card span{

    display:block;

    min-height:52px;

    line-height:1.5;

    font-size:.95rem;

    opacity:.95;

}
.modern-card h2{

    margin:8px 0 12px;

    font-size:3rem;

    font-weight:700;

    line-height:1;

}
.modern-card:hover{

    transform:translateY(-10px) scale(1.02);

    box-shadow:0 30px 60px rgba(0,0,0,.18);

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

background:rgba(255,255,255,.06);

left:-30px;

bottom:-30px;

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
    transition:.4s;

}
.modern-card:hover .icon-box{

transform:rotate(-8deg) scale(1.12);

background:rgba(255,255,255,.28);

}
.modern-card small{

    display:block;

    font-size:.95rem;

    opacity:.9;

    margin-bottom:8px;

    letter-spacing:.3px;

}

.modern-card h2{

    font-size:2.4rem;

    font-weight:700;

    margin-bottom:6px;

}

.modern-card span{

    font-size:.9rem;

    opacity:.92;

}

.total-card{

background:linear-gradient(
135deg,
#3B82F6,
#2563EB,
#1D4ED8
);
box-shadow:0 20px 45px rgba(37,99,235,.35);


}

.waiting-card{

background:linear-gradient(
135deg,
#FBBF24,
#F59E0B,
#D97706
);
box-shadow:0 20px 45px rgba(245,158,11,.35);

}

.progress-card{
background:linear-gradient(
135deg,
#38BDF8,
#06B6D4,
#0891B2
);
box-shadow:0 20px 45px rgba(6,182,212,.35);

}

.complete-card{

background:linear-gradient(
135deg,
#4ADE80,
#22C55E,
#15803D
);
box-shadow:0 20px 45px rgba(34,197,94,.35);
}
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

    box-shadow:0 10px 25px rgba(37,99,235,.3);

}

.modern-progress{

    height:16px;

    border-radius:30px;

    background:#e5e7eb;

}

.modern-progress .progress-bar{

    border-radius:30px;

    background:linear-gradient(90deg,#22c55e,#16a34a);

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

    transform:translateY(-3px);

}

.status-box i{

    font-size:28px;

}

.status-box strong{

    display:block;

    font-size:1.3rem;

}

.status-box small{

    color:#6b7280;

}

.status-success{

    background:#ecfdf5;

    color:#16a34a;

}

.status-warning{

    background:#fffbeb;

    color:#d97706;

}

.status-info{

    background:#ecfeff;

    color:#0891b2;

}
.quick-card{

    border-radius:24px;

}

.quick-title-icon{

    width:50px;

    height:50px;

    border-radius:15px;

    background:#eef4ff;

    color:#2563eb;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:22px;

    margin-right:15px;

}

.quick-menu{

    text-decoration:none;

    border-radius:20px;

    color:white;

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

    transform:translateY(-6px);

    color:white;

    box-shadow:0 20px 35px rgba(0,0,0,.18);

}

.quick-menu i{

    font-size:38px;

    margin-bottom:18px;

}

.quick-menu h6{

    margin:0;

    text-align:center;

    font-size:1rem;

    font-weight:700;

    line-height:1.5;

}

.quick-blue{

    background:linear-gradient(135deg,#2563eb,#1d4ed8);

}

.quick-green{

    background:linear-gradient(135deg,#16a34a,#15803d);

}

.quick-gray{

    background:linear-gradient(135deg,#475569,#334155);

    min-height:120px;

}
    </style>

</head>


<body>

<div class="sidebar">

<div class="logo">

<h3>

Helpdesk

</h3>

<small>

Diskominfo

</small>

</div>

<div class="profile">

<div class="avatar">

@if(Auth::user()->photo)

<img src="{{ asset('storage/'.Auth::user()->photo) }}">

@else

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

@endif

</div>

<h5>

{{ Auth::user()->name }}

</h5>

<small>

User

</small>

</div>

<div class="menu">

    <a href="{{ route('user.dashboard') }}"
       class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

        <i class="bi bi-speedometer2"></i>

        Dashboard

    </a>

    <a href="{{ route('user.ticket.create') }}"
       class="{{ request()->routeIs('user.ticket.create') ? 'active' : '' }}">

        <i class="bi bi-plus-circle-fill"></i>

        Ajukan Layanan

    </a>

    <a href="{{ route('user.ticket.history') }}"
       class="{{ request()->routeIs('user.ticket.history') ? 'active' : '' }}">

        <i class="bi bi-ticket-perforated-fill"></i>

        Riwayat Tiket

    </a>

    <a href="{{ route('user.profile') }}"
       class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">

        <i class="bi bi-person-circle"></i>

        Profil

    </a>

</div>

<div class="logout">

    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <button type="submit">

            <i class="bi bi-box-arrow-right me-2"></i>

            Logout

        </button>

    </form>

</div>

</div>

<div class="content">

    <!-- Topbar -->
<div class="topbar">

    <h5 class="mb-0 fw-bold">

        @yield('title','Dashboard')

    </h5>

    <div class="d-flex align-items-center ms-auto gap-3">

        <button
            class="btn btn-light position-relative border-0"
            data-bs-toggle="offcanvas"
            data-bs-target="#notificationCanvas">

            <i class="bi bi-bell fs-5"></i>

            @if($notificationCount>0)

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                {{ $notificationCount }}

            </span>

            @endif

        </button>

        <div class="text-end">

            <strong>{{ auth()->user()->name }}</strong>

            <br>

            <small class="text-muted">

                {{ ucfirst(auth()->user()->role) }}

            </small>

        </div>

    </div>

</div>
        
<div class="main">

    @yield('content')

</div>

<div class="footer">

    © {{ date('Y') }} HelpDesk Diskominfo Kota Pemalang

</div>

<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="notificationCanvas">

    <div class="offcanvas-header">

        <h5 class="fw-bolder mb-0">

    <i class="bi bi-bell-fill text-primary me-2"></i>

    Notifikasi

</h5>

        <button
            class="btn-close"
            data-bs-dismiss="offcanvas">
        </button>

    </div>

    <div class="offcanvas-body p-0">

        
    @forelse($notifications as $notif)

<div class="notification-card {{ $notif->is_read ? 'notification-read' : '' }}">

    <div class="d-flex">

        <div class="notification-icon me-3">

            @if(Str::contains($notif->judul,'Komentar'))

                <i class="bi bi-chat-dots-fill text-success"></i>

            @elseif(Str::contains($notif->judul,'Status'))

                <i class="bi bi-arrow-repeat text-primary"></i>

            @else

                <i class="bi bi-info-circle-fill text-warning"></i>

            @endif

        </div>

        <div class="flex-grow-1">

            <h6 class="mb-1 fw-bold">

                {{ $notif->judul }}

            </h6>

            <p class="mb-2">

                {{ $notif->pesan }}

            </p>

            <small class="text-muted">

                {{ $notif->created_at->diffForHumans() }}

            </small>

            <div class="mt-3 d-flex align-items-center gap-3">
                <a href="{{ route('user.ticket.detail',$notif->ticket_id) }}"
  class="btn btn-sm btn-light border rounded-pill px-4 py-2">

                    <i class="bi bi-eye"></i>

                    Lihat Tiket

                </a>

                @if(!$notif->is_read)

                    <form action="{{ route('user.notification.read',$notif->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <button
    type="submit"
    class="btn btn-sm btn-success rounded-pill px-4 py-2">

    <i class="bi bi-check2-circle me-1"></i>

    Tandai Dibaca

</button>

                    </form>

                @else

<span class="badge rounded-pill bg-success-subtle text-success border border-success px-3 py-2">
    <i class="bi bi-check-circle-fill me-1"></i>
    Sudah Dibaca
</span>

@endif

            </div>

        </div>

    </div>

</div>

@empty

<div class="text-center py-5">

    <i class="bi bi-bell-slash fs-1 text-secondary"></i>

    <p class="mt-3 mb-0">

        Belum ada notifikasi.

    </p>

</div>

@endforelse

</div>

</div>
</div> 
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

document.querySelectorAll('.counter').forEach(counter=>{

    const target=parseInt(counter.dataset.target);

    let current=0;

    const increment=Math.max(1,Math.ceil(target/50));

    const update=()=>{

        current+=increment;

        if(current>=target){

            counter.innerText=target;

        }else{

            counter.innerText=current;

            requestAnimationFrame(update);

        }

    };

    update();

});

</script>
</body>
</html>