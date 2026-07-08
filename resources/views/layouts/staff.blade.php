<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Staff')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            background:#f5f6fa;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:260px;
            background:#0d6efd;
            color:#fff;
            flex-shrink:0;
        }

        .sidebar h4{
            padding:25px;
            text-align:center;
        }

        .sidebar a{
            display:block;
            color:#fff;
            text-decoration:none;
            padding:14px 25px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.15);
        }

        .main{
            flex:1;
        }

        .content{
            padding:25px;
        }
    </style>

</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">

        <h4>Helpdesk</h4>

        <a href="{{ route('staff.dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('staff.kanban') }}">
            <i class="bi bi-kanban-fill"></i>
            Kanban Board
        </a>

        <a href="{{ route('staff.activity') }}">
            <i class="bi bi-clock-history"></i>
            Timeline Aktivitas
        </a>

        <a href="{{ route('staff.profile') }}">
            <i class="bi bi-person-circle"></i>
            Edit Profil
        </a>

        <a href="{{ route('staff.profile') }}#password">
            <i class="bi bi-shield-lock"></i>
            Ganti Password
        </a>

    </div>
    <!-- Main -->
    <div class="main">

        <nav class="navbar navbar-light bg-white shadow-sm px-4">

            <span>
                Selamat Datang,
                <strong>{{ Auth::user()->name }}</strong>
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>

        </nav>

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>