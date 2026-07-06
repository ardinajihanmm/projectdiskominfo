<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Helpdesk Diskominfo')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#f5f6fa;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#0d6efd;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 20px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.15);
        }

        .content{
            flex:1;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar">

        <h4 class="text-white text-center py-4">
            Helpdesk
        </h4>

        <a href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('admin.ticket.index') }}">
            Kelola Tiket
        </a>

        <a href="{{ route('admin.service.index') }}">
            Kelola Layanan
        </a>

        <a href="{{ route('admin.user.index') }}">
            Data User
        </a>

    </div>

    <!-- Content -->
    <div class="content">

        <!-- Navbar -->
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

        <div class="container-fluid mt-4">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>