<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Helpdesk')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
<a class="navbar-brand"
   href="
   @if(auth()->user()->role == 'admin')
        {{ route('admin.dashboard') }}
   @elseif(auth()->user()->role == 'staff')
        {{ route('staff.dashboard') }}
   @else
        {{ route('user.dashboard') }}
   @endif
   ">
    Helpdesk Diskominfo
</a>

        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>