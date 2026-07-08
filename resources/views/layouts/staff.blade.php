<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Staff')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#f5f7fb;
            font-family:'Segoe UI',sans-serif;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{
            width:280px;
            background:#2563eb;
            color:#fff;
            display:flex;
            flex-direction:column;
            padding:30px 20px;
        }

        .logo{
            text-align:center;
            margin-bottom:30px;
        }

        .logo i{
            font-size:42px;
        }

        .logo h3{
            margin-top:12px;
            font-weight:700;
        }

        .avatar{
            width:95px;
            height:95px;
            border-radius:50%;
            background:#eef4ff;
            color:#2563eb;
            border:4px solid rgba(255,255,255,.4);
            margin:auto;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:38px;
            font-weight:bold;
        }

        .profile{
            text-align:center;
            margin-bottom:35px;
        }

        .profile small{
            display:block;
            margin-top:10px;
            font-weight:600;
        }

        .profile p{
            margin:0;
            font-size:18px;
        }

        .menu{
            flex:1;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:14px;
            color:white;
            text-decoration:none;
            padding:16px 20px;
            border-radius:16px;
            margin-bottom:12px;
            transition:.3s;
            font-size:16px;
        }

        .menu a:hover{
            background:#1d4ed8;
        }

        .menu a.active{
            background:#2945b8;
            font-weight:600;
        }

        .menu i{
            font-size:20px;
        }

        .logout{
            margin-top:auto;
        }

        .logout button{
            width:100%;
            border:none;
            background:#ef4444;
            color:white;
            padding:14px;
            border-radius:12px;
            font-weight:600;
            transition:.3s;
        }

        .logout button:hover{
            background:#dc2626;
        }

        /* ================= CONTENT ================= */

        .main{
            flex:1;
        }

        .navbar{
            background:white;
            padding:18px 30px;
            box-shadow:0 3px 12px rgba(0,0,0,.08);
        }

        .content{
            padding:30px;
        }

    </style>

</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->

    <div class="sidebar">

        <div class="logo">

            <i class="bi bi-headset"></i>

            <h3>Portal Layanan TIK</h3>

        </div>

        <div class="profile">

            <div class="avatar">

                {{ strtoupper(substr(Auth::user()->name,0,2)) }}

            </div>

            <small>

                {{ Auth::user()->username ?? 'staff' }}

            </small>

            <p>

                {{ Auth::user()->name }}

            </p>

        </div>

        <div class="menu">

            <a href="{{ route('staff.dashboard') }}"
               class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

            <a href="{{ route('staff.kanban') }}"
               class="{{ request()->routeIs('staff.kanban') ? 'active' : '' }}">

                <i class="bi bi-kanban-fill"></i>

                Kanban Board

            </a>

            <a href="{{ route('staff.ticket.index') }}"
               class="{{ request()->routeIs('staff.ticket.*') ? 'active' : '' }}">

                <i class="bi bi-ticket-detailed-fill"></i>

                Daftar Tiket

            </a>

            <a href="{{ route('staff.profile') }}"
               class="{{ request()->routeIs('staff.profile*') ? 'active' : '' }}">

                <i class="bi bi-person-circle"></i>

                Profil

            </a>

        </div>

        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button type="submit">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </button>

            </form>

        </div>

    </div>

    <!-- Main -->

    <div class="main">

        <nav class="navbar bg-white shadow-sm px-4">

            <h5 class="mb-0 fw-bold">
                @yield('title','Dashboard')
            </h5>

            <div class="d-flex align-items-center ms-auto">

                {{-- NOTIF --}}
                <button
                    class="btn position-relative me-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#notifCanvas">

                    <i class="bi bi-bell fs-4"></i>

                    @if(isset($notificationCount) && $notificationCount>0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                            {{ $notificationCount }}

                        </span>
                    @endif

                </button>

                {{-- USER --}}
                <div class="text-end">

                    <strong>{{ Auth::user()->name }}</strong>
                    <br>

                    <small class="text-muted">
                        {{ ucfirst(Auth::user()->role) }}
                    </small>

                </div>

            </div>

        </nav>

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="offcanvas offcanvas-end"
        tabindex="-1"
        id="notifCanvas">

        <div class="offcanvas-header">

            <h5>
                <i class="bi bi-bell-fill"></i>
                Notifikasi
            </h5>

            <button
                class="btn-close"
                data-bs-dismiss="offcanvas">
            </button>

        </div>

        <div class="offcanvas-body">

            @forelse($notifications ?? [] as $notif)

            <div class="d-flex mb-4">

                <div class="me-3">

                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex justify-content-center align-items-center"
                        style="width:50px;height:50px">

                        <i class="bi bi-arrow-repeat text-primary fs-4"></i>

                    </div>

                </div>

                <div class="flex-grow-1">

                    <strong>{{ $notif->judul }}</strong>

                    <div class="text-muted">

                        {{ $notif->pesan }}

                    </div>

                    <small class="text-secondary">

                        {{ $notif->created_at->diffForHumans() }}

                    </small>

                </div>

            </div>

            <hr>

            @empty

            <div class="text-center py-5">

                <i class="bi bi-bell-slash fs-1 text-muted"></i>

                <p class="mt-3 text-muted">
                    Belum ada notifikasi.
                </p>

            </div>

            @endforelse
        </div>

    </div>
</body>
</html>