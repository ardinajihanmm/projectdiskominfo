<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin - Helpdesk')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    margin:0;
    background:#f4f7fb;
    font-family:'Segoe UI',sans-serif;
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

.content{

    margin-left:260px;

    min-height:100vh;

}

.topbar{

    height:75px;

    background:white;

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:0 35px;

    box-shadow:0 3px 12px rgba(0,0,0,.05);

}

.welcome h5{

    margin:0;

    font-weight:700;

}

.welcome small{

    color:#6c757d;

}

.clock{

    color:#6c757d;

    font-size:14px;

}

.main{

    padding:30px;

}

</style>

@stack('styles')

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

@if(Auth::user()->foto)

    <img src="{{ asset('storage/profile/' . Auth::user()->foto) }}?v={{ time() }}"
         alt="Profile"
         class="w-100 h-100 rounded-circle"
         style="object-fit:cover;">

@else

    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

@endif

</div>

<h5>

{{ Auth::user()->name }}

</h5>

<small>

Administrator

</small>

</div>

<div class="menu">

<a href="{{ route('admin.dashboard') }}"
class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

<i class="bi bi-speedometer2"></i>

Dashboard

</a>

<a href="{{ route('admin.ticket.index') }}"
class="{{ request()->routeIs('admin.ticket.*') ? 'active' : '' }}">

<i class="bi bi-ticket-perforated-fill"></i>

Kelola Tiket

</a>

<a href="{{ route('admin.service.index') }}"
class="{{ request()->routeIs('admin.service.*') ? 'active' : '' }}">

<i class="bi bi-tools"></i>

Kelola Layanan

</a>

<a href="{{ route('admin.user.index') }}"
class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">

<i class="bi bi-people-fill"></i>

Data User

</a>

<a href="{{ route('admin.profile') }}"
class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">

<i class="bi bi-person-circle"></i>

Edit Profil

</a>

</div>

<div class="logout">

<form action="{{ route('logout') }}" method="POST">

@csrf

<button>

<i class="bi bi-box-arrow-right me-2"></i>

Logout

</button>

</form>

</div>

</div>

<div class="content">

<div class="topbar">

<div class="welcome">

<h5>

Selamat Datang, {{ Auth::user()->name }}

</h5>

<small>

Portal Helpdesk Administrator

</small>

</div>

<div class="clock">

<i class="bi bi-calendar3"></i>

{{ now()->format('d F Y') }}

</div>

</div>

<div class="main">

@yield('content')

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>