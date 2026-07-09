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
    min-height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#2563EB;
    color:#fff;
    box-shadow:4px 0 15px rgba(37,99,235,.25);
}

.brand{
    background:transparent;
    padding:25px;
    text-align:center;
    border-bottom:none;
}

.brand h4{
    margin:10px 0 0;
    font-weight:700;
}

.profile-box{
    text-align:center;
    padding:22px 20px;
    border-bottom:none;
    background:transparent;
}

.profile-box img{
    width:75px;
    height:75px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #FFFFFF;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}

.profile-box h6{
    margin-top:12px;
    margin-bottom:4px;
    color:#FFFFFF;
    font-weight:700;
}

.profile-box small{
    color:#DBEAFE;
    font-size:14px;
    letter-spacing:.5px;
}
.menu{
    padding:15px 10px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    color:white;
    text-decoration:none;
    padding:14px 18px;
    border-radius:12px;
    margin-bottom:8px;
    transition:.25s;
}

.menu a:hover{
    background:#1D4ED8;
    color:white;
}

.menu a.active{
    background:#1E40AF;
    color:white;
    font-weight:600;
}

.menu i{
    width:22px;
    text-align:center;
    font-size:18px;
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

.logout-btn{
    width:100%;
    border:none;
    background:none;
    color:#E2E8F0;
    padding:13px 18px;
    border-radius:10px;
    text-align:left;
    transition:.25s;
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
  
.logout-btn:hover{
    background:#EF4444;
    color:white;
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

    </style>

</head>


<body>

<div class="sidebar">

    <div class="brand">

        <i class="bi bi-headset fs-1"></i>

        <h4>Portal Layanan TIK</h4>

    </div>

    <div class="profile-box">

        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=EFF6FF&color=1D4ED8&bold=true&size=128">

        <h6>{{ auth()->user()->name }}</h6>

        <small>User</small>

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

            <i class="bi bi-ticket-detailed-fill"></i>

            Riwayat Tiket

        </a>

        <a href="{{ route('user.profile') }}"
           class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">

            <i class="bi bi-person-circle"></i>

            Profil

        </a>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button class="logout-btn">

                <i class="bi bi-box-arrow-right"></i>

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

    © {{ date('Y') }} Service Desk Diskominfo

</div>

<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="notificationCanvas">

    <div class="offcanvas-header">

        <h5>

            <i class="bi bi-bell-fill text-primary"></i>

            Notifikasi

        </h5>

        <button
            class="btn-close"
            data-bs-dismiss="offcanvas">
        </button>

    </div>

    <div class="offcanvas-body p-0">

        @forelse($notifications as $notif)

        <a
            href="{{ route('user.ticket.detail',$notif->ticket_id) }}"
            class="notification-card">

            <div class="notification-icon">

                @if(Str::contains($notif->judul,'Komentar'))

                    <i class="bi bi-chat-dots-fill text-success"></i>

                @elseif(Str::contains($notif->judul,'Status'))

                    <i class="bi bi-arrow-repeat text-primary"></i>

                @else

                    <i class="bi bi-info-circle-fill text-warning"></i>

                @endif

            </div>

            <div class="flex-grow-1">

                <h6>

                    {{ $notif->judul }}

                </h6>

                <p>

                    {{ $notif->pesan }}

                </p>

                <small class="text-muted">

                    {{ $notif->created_at->diffForHumans() }}

                </small>

            </div>

        </a>

        @empty

        <div class="text-center py-5">

            <i class="bi bi-bell-slash fs-1 text-secondary"></i>

            <p class="mt-3">

                Belum ada notifikasi.

            </p>

        </div>

        @endforelse
        <div class="p-3 border-top">
    <button class="btn btn-primary w-100">
        <i class="bi bi-check2-all"></i>
        Tandai Semua Sudah Dibaca

    </button>

</div>

</div>
</div> 
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>