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
    display:flex;
    align-items:center;
    justify-content:center;
    gap:14px;
    padding:22px 18px 26px;
}

.logo-pemalang{
    width:64px;
    height:64px;
    object-fit:contain;
    flex-shrink:0;
}

.logo-text{
    text-align:left;
}

.logo-text h3{
    margin:0;
    color:#fff;
    font-size:1.65rem;
    font-weight:800;
    line-height:1.1;
}

.logo-text small{
    display:block;
    color:rgba(255,255,255,.85);
    font-size:.82rem;
    line-height:1.35;
    font-weight:500;
    margin-top:4px;
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
    transition:all .25s ease;
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

-number{
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
.latest-ticket-card{

    border-radius:28px;

}

.ticket-icon{

    width:65px;
    height:65px;

    border-radius:18px;

    background:#eef4ff;

    color:#2563eb;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:28px;

}

.ticket-info{

    display:flex;

    align-items:center;

    gap:14px;

    background:#f8fafc;

    border-radius:16px;

    padding:16px 18px;

    height:100%;

}

.ticket-info i{

    font-size:24px;

}

.ticket-info small{

    display:block;

    color:#64748b;

    margin-bottom:4px;

}

.ticket-info strong{

    font-size:15px;

    font-weight:600;

}

.latest-ticket-card .badge{

    font-size:15px;

}

.featured-ticket{

    border:1px solid #e5e7eb;

    border-radius:20px;

    padding:30px;

    transition:.3s;
     margin-top:30px;
    

}


.featured-ticket:hover{

    box-shadow:0 20px 40px rgba(0,0,0,.08);

    transform:translateY(-3px);

}

.featured-header{

    display:flex;

    justify-content:space-between;

    align-items:flex-start;

    gap:20px;

}

.featured-header h3{

    font-size:1.5rem;

    font-weight:700;

    margin-bottom:6px;

}

.timeline-card{

    border-radius:24px;

    overflow:hidden;

}

.timeline-header{

    padding:22px 24px;

    border-bottom:1px solid #edf2f7;

    background:white;

}

.timeline-body{

    padding:24px;

    max-height:500px;

    overflow-y:auto;

}

.timeline-item-modern{

    display:flex;

    gap:18px;

    position:relative;

    padding-bottom:25px;

}

.timeline-item-modern:last-child{

    padding-bottom:0;

}

.timeline-item-modern:not(:last-child)::before{

    content:"";

    position:absolute;

    left:19px;

    top:42px;

    width:2px;

    height:calc(100% - 18px);

    background:#dbeafe;

}

.timeline-dot{

    width:40px;

    height:40px;

    min-width:40px;

    border-radius:50%;

    background:linear-gradient(135deg,#3b82f6,#2563eb);

    color:white;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:17px;

    box-shadow:0 10px 25px rgba(37,99,235,.25);

}

.timeline-card-item{

    flex:1;

    background:#f8fafc;

    border-radius:18px;

    padding:16px;

    transition:.3s;

}

.timeline-card-item:hover{

    transform:translateY(-3px);

    background:white;

    box-shadow:0 12px 28px rgba(0,0,0,.08);

}

.timeline-card-item h6{

    margin-bottom:6px;

    font-weight:700;

}

.timeline-card-item p{

    margin-bottom:8px;

    color:#64748b;

    font-size:.92rem;

    line-height:1.5;

}

.timeline-card-item small{

    color:#94a3b8;

}
.guide-card{

    border-radius:28px;

    overflow:hidden;

}

.guide-badge{

    display:inline-flex;

    align-items:center;

    background:#eef4ff;

    color:#2563eb;

    padding:8px 18px;

    border-radius:999px;

    font-weight:600;

}

.guide-timeline{

    position:relative;

}

.guide-line{

    position:absolute;

    top:48px;

    left:12%;

    right:12%;

    height:4px;

    background:#dbeafe;

    z-index:0;

}

.guide-step{

    position:relative;

    z-index:2;

}

.guide-icon{

    width:88px;

    height:88px;

    margin:auto;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:34px;

    color:white;

    margin-bottom:18px;

    transition:.35s;

}

.guide-step:hover .guide-icon{

    transform:translateY(-8px) scale(1.08);

}

.blue{

    background:linear-gradient(135deg,#3b82f6,#2563eb);

}

.green{

    background:linear-gradient(135deg,#22c55e,#15803d);

}

.orange{

    background:linear-gradient(135deg,#f59e0b,#ea580c);

}

.cyan{

    background:linear-gradient(135deg,#06b6d4,#0284c7);

}

.step-number{

    display:inline-flex;

    align-items:center;

    justify-content:center;

    min-width:110px;

    height:38px;

    padding:0 18px;

    border-radius:999px;

    background:#f1f5f9;

    font-size:.9rem;

    font-weight:700;

    color:#64748b;

    white-space:nowrap;

    margin-top:18px;

}

.guide-step h5{

    font-weight:700;

    margin-bottom:12px;

}

.guide-step p{

    color:#64748b;

    line-height:1.7;

    font-size:.94rem;

}

.guide-tip{

    background:#fff7ed;

    border-left:5px solid #f59e0b;

    padding:18px 22px;

    border-radius:16px;

    color:#92400e;

}
.modern-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.estimate-time{
background:#EEF4FF;
color:#2563eb;
padding:12px 20px;
border-radius:40px;
font-weight:600;
}

.modern-input{
border-radius:14px;
padding:14px 16px;
border:1px solid #dbe3ef;
}

.modern-input:focus{
border-color:#2563eb;
box-shadow:0 0 0 .2rem rgba(37,99,235,.15);
}

.upload-box{
border:2px dashed #d6e2ff;
border-radius:20px;
padding:35px;
text-align:center;
background:#fafcff;
}

.upload-icon{
font-size:45px;
color:#2563eb;
margin-bottom:15px;
}

.tips-box{
display:flex;
gap:15px;
align-items:flex-start;
padding:18px;
background:#FFF8E8;
border-radius:16px;
}
.table{
    margin:0;
}

.table thead th{
    padding:18px 20px;
    font-size:.9rem;
    color:#6b7280;
    border:none;
}

.table tbody td{
    padding:22px 20px;
    vertical-align:middle;
}

.table tbody tr{
    transition:.25s;
}

.table tbody tr:hover{
    background:#f8fbff;
}

.input-group-text,
.form-control,
.form-select{
    border-radius:12px;
}

.card{
    border-radius:18px;
}

.badge{
    font-size:.82rem;
    font-weight:600;
    padding:9px 16px;
}

.btn-primary{
    border-radius:12px;
}

.btn-outline-secondary{
    border-radius:12px;
}
.sidebar{
    transition:all .35s ease;
}

.content{
    transition:all .35s ease;
}
.sidebar.collapsed{
    width:85px;
}
.sidebar.collapsed .logo{
    justify-content:center;
}

.sidebar.collapsed .logo-text{
    display:none;
}

.sidebar.collapsed .logo-pemalang{
    width:50px;
    height:50px;
}
.sidebar.collapsed .profile h5,
.sidebar.collapsed .profile small{
    display:none;
}

.sidebar.collapsed .avatar{
    width:60px;
    height:60px;
}
.sidebar.collapsed .menu a{
    justify-content:center;
    padding:16px;
}

.sidebar.collapsed .menu a span{
    display:none;
}

.sidebar.collapsed .menu a i{
    margin:0;
    font-size:22px;
}
.sidebar.collapsed .logout button{
    font-size:0;
    padding:15px;
}

.sidebar.collapsed .logout button i{
    font-size:22px;
    margin:0 !important;
}
.sidebar.collapsed + .content{
    margin-left:85px;
}
    </style>

</head>


<body>

<div class="sidebar">

    <div class="logo">

    <img
        src="{{ asset('images/logo-pemalang.png') }}"
        class="logo-pemalang"
        alt="Logo Kabupaten Pemalang">

    <div class="logo-text">
        <h3>Helpdesk</h3>
        <small>
            Diskominfo<br>
            Kabupaten Pemalang
        </small>
    </div>

</div>
<div class="profile">

    <div class="avatar">

        @if(Auth::user()->foto)

            <img
                src="{{ asset('storage/'.Auth::user()->foto) }}"
                alt="Foto Profil"
                class="w-100 h-100 rounded-circle"
                style="object-fit:cover;">

        @else

            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

        @endif

    </div>

    <h5 class="mt-3 mb-1 fw-bold">

        {{ Auth::user()->name }}

    </h5>

    <small class="text-light opacity-75">

        Pengguna Helpdesk

</small>

</div>

<div class="menu">

    <a href="{{ route('user.dashboard') }}"
       class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">

        <i class="bi bi-speedometer2"></i>

        <span>Dashboard</span>

    </a>

    <a href="{{ route('user.ticket.create') }}"
       class="{{ request()->routeIs('user.ticket.create') ? 'active' : '' }}">

        <i class="bi bi-plus-circle-fill"></i>

        <span>Ajukan Layanan</span>

    </a>

    <a href="{{ route('user.ticket.history') }}"
       class="{{ request()->routeIs('user.ticket.history') ? 'active' : '' }}">

        <i class="bi bi-ticket-perforated-fill"></i>

        <span>Riwayat Tiket</span>

    </a>

    <a href="{{ route('user.profile') }}"
       class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">

        <i class="bi bi-person-circle"></i>

        <span>Ajukan Layanan</span>

    </a>

</div>

<div class="logout">

    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <button type="submit">

            <i class="bi bi-box-arrow-right me-2"></i>

            <span>Logout</span>

        </button>

    </form>

</div>

</div>

<div class="content">

    <!-- Topbar -->
<div class="topbar">
 <!-- Tombol Toggle Sidebar -->
    <button class="btn btn-light border-0 me-3" id="toggleSidebar">
        <i class="bi bi-list fs-3"></i>
    </button>
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

    © {{ date('Y') }} HelpDesk Diskominfo Kabupaten Pemalang

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



const sidebar = document.querySelector('.sidebar');
const toggle = document.getElementById('toggleSidebar');

if(localStorage.getItem('sidebar') === 'collapsed'){
    sidebar.classList.add('collapsed');
}

toggle.addEventListener('click',()=>{

    sidebar.classList.toggle('collapsed');

    localStorage.setItem(
        'sidebar',
        sidebar.classList.contains('collapsed')
            ? 'collapsed'
            : 'open'
    );

});
</script>
</body>
</html>