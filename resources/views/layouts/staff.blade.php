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

        /* ================= SIDEBAR ================= */

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

.sidebar::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,.35);
    border-radius:20px;
}

.logo{
    padding:28px 20px 15px;
    text-align:center;
    color:#fff;
}

.logo h3{
    color:#fff;
    font-weight:700;
    margin-bottom:0;
    letter-spacing:1px;
}

.logo small{
    color:#dbeafe;
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

.profile{
    text-align:center;
    padding:20px;
}

.profile h5{
    color:#fff;
    margin-top:15px;
    margin-bottom:2px;
}

.profile small{
    color:#dbeafe;
}

        .profile p{
            margin:0;
            font-size:18px;
        }

.menu{
    padding:15px;
}

.menu a{
    color:#fff;
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
    background:#fff;
    color:#0d6efd;
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

        .menu i{
            font-size:20px;
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
        /* ================= CONTENT ================= */

.main{
    padding:30px;
}

.content{
    margin-left:260px;
    min-height:100vh;
}

.topbar{
    height:75px;
    background:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 35px;
    box-shadow:0 3px 12px rgba(0,0,0,.05);
}


    </style>

</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">

        <div class="logo">
            <h3>Helpdesk</h3>
            <small>Diskominfo</small>
        </div>

        <div class="profile">

            <div class="avatar">
                @if(Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}?v={{ time() }}"
                        alt="Profile">
                @else
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                @endif
            </div>

            <h5 class="mt-3 mb-1">
                {{ Auth::user()->name }}
            </h5>

            <small>Staff</small>

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
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>

        </div>

    </div>

    {{-- Content --}}
    <div class="content">

        <div class="topbar">

            <div class="welcome">
                <h5>Selamat Datang, {{ Auth::user()->name }}</h5>
                <small>Portal Helpdesk Staff</small>
            </div>

            <div class="d-flex align-items-center">

                <button
                    class="btn position-relative me-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#notifCanvas">

                    <i class="bi bi-bell fs-4"></i>

                    @if(isset($notificationCount) && $notificationCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $notificationCount }}
                        </span>
                    @endif

                </button>

                <div class="clock">
                    <i class="bi bi-calendar3"></i>
                    {{ now()->format('d F Y') }}
                </div>

            </div>

        </div>

        <div class="main">
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