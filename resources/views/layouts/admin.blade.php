@php

use App\Models\Notification;
use Illuminate\Support\Str;

if (random_int(1, 100) === 1) {
    Notification::where('created_at', '<', now()->subDays(30))->delete();
}

$notifications = Notification::where('user_id', auth()->id())
    ->latest()
    ->take(10)
    ->get();

$unread = $notifications->where('is_read', false)->count();
@endphp

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title', 'Admin - Helpdesk')</title>

        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            .offcanvas{
                width:430px !important;
            }

            .notification-card{
                display:flex;
                gap:15px;
                padding:18px 20px;
                border-bottom:1px solid #ECECEC;
                transition:.2s;
            }

            .notification-card:hover{
                background:#F8FAFC;
            }

            .notification-read{
                background:#f8fafc;
            }

            .notification-read h6,
            .notification-read p,
            .notification-read small{
                color:#6c757d !important;
            }

            .notification-icon{
                width:48px;
                height:48px;
                border-radius:50%;
                display:flex;
                justify-content:center;
                align-items:center;
                background:#EFF6FF;
                font-size:22px;
                flex-shrink:0;
            }

            .notification-card .btn{
                height:38px;
                border-radius:999px;
                display:inline-flex;
                align-items:center;
                gap:6px;
            }

            .notification-card .badge{
                height:38px;
                display:inline-flex;
                align-items:center;
                padding:0 18px;
                border-radius:999px;
            }
            .footer{
                padding:20px 30px;
                color:#64748B;
                font-size:14px;
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
                font-family:'Plus Jakarta Sans',sans-serif;
            }

            .logo-text h3{
                margin:0;
                color:#fff;
                font-size:1.65rem;
                font-weight:800;
                letter-spacing:-.02em;
                line-height:1.1;
                font-family:'Plus Jakarta Sans',sans-serif;
            }

            .logo-text small{
                display:block;
                color:rgba(255,255,255,.85);
                font-size:.82rem;
                line-height:1.35;
                font-weight:500;
                margin-top:4px;
                font-family:'Plus Jakarta Sans',sans-serif;
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

            .topbar{
                height:70px;
                background:white;
                display:flex;
                align-items:center;
                justify-content:space-between;
                padding:0 30px;
                box-shadow:0 2px 12px rgba(0,0,0,.05);

                position: sticky;
                top: 0;
                overflow: visible;
                z-index: 1000;
            }

            .welcome h5{
                margin:0;
                font-size:1.15rem;
                font-weight:700;
            }

            .welcome small{
                display:block;
                color:#64748b;
            }
            .sidebar.collapsed .profile{
                display:flex;
                justify-content:center;
                align-items:center;
                padding:18px 0 22px;
            }

            .sidebar-backdrop{
                position:fixed;
                inset:0;
                z-index:1040;
                display:block;
                background:rgba(15,23,42,.52);
                opacity:0;
                visibility:hidden;
                pointer-events:none;
                transition:opacity .3s ease,visibility .3s ease;
            }
            .sidebar-backdrop.show{
                opacity:1;
                visibility:visible;
                pointer-events:auto;
            }
            body.sidebar-open{
                overflow:hidden;
            }
            .content,
            .sidebar,
            .topbar{
                min-width:0;
            }
            .notification-card .flex-grow-1{
                min-width:0;
            }
            .notification-card h6,
            .notification-card p,
            .notification-card small{
                overflow-wrap:anywhere;
            }
            .notification-icon,
            .avatar{
                flex-shrink:0;
                aspect-ratio:1/1;
            }
            @media(max-width:1199.98px){
                .main{
                    padding:24px;
                }
            }
            @media(max-width:991.98px){
                body{
                    overflow-x:hidden;
                }
            .sidebar,
            .sidebar.collapsed{
                width:min(82vw,300px)!important;
                max-width:300px;
                z-index:1050;
                transform:translateX(-100%);
                box-shadow:16px 0 40px rgba(15,23,42,.24);
            }
            .sidebar.mobile-open{
                transform:translateX(0);
            }
            .sidebar.collapsed .logo{
                justify-content:center;
            }
            .sidebar.collapsed .logo-text{
                display:block;
            }
            .sidebar.collapsed .logo-pemalang{
                width:64px;
                height:64px;
            }
            .sidebar.collapsed .profile{
                display:block;
                padding:20px;
            }
            .sidebar.collapsed .profile h5,
            .sidebar.collapsed .profile small{
                display:block;
            }
            .sidebar.collapsed .avatar{
                width:90px;
                height:90px;
                margin:auto;
            }
            .sidebar.collapsed .menu a{
                justify-content:flex-start;
                padding:14px 18px;
            }
            .sidebar.collapsed .menu a span{
                display:inline;
            }
            .sidebar.collapsed .menu a i{
                margin:0;
                font-size:18px;
            }
            .sidebar.collapsed .logout button{
                padding:12px;
                font-size:inherit;
            }
            .sidebar.collapsed .logout button i{
                font-size:inherit;
            }
            .content,
            .sidebar.collapsed ~ .content{
                width:100%;
                min-height:100vh;
                margin-left:0!important;
            }
            .topbar{
                position:sticky!important;
                top:0;
                z-index:1030;
                min-height:64px;
                height:auto;
                padding:10px 16px;
                gap:8px;
                isolation:isolate;
            }
            #toggleSidebar{
                position:relative;
                z-index:2;
                flex-shrink:0;
                margin-right:4px!important;
                pointer-events:auto;
                touch-action:manipulation;
            }
            .topbar h5{
                min-width:0;
                max-width:46vw;
                overflow:hidden;
                text-overflow:ellipsis;
                white-space:nowrap;
                font-size:1rem;
            }
            .topbar > .d-flex{
                gap:8px!important;
            }
            .topbar .text-end{
                display:none;
            }
            .main{
                min-width:0;
                padding:20px 16px;
            }
            .footer{
                padding:16px;
                text-align:center;
            }
            .offcanvas{
                width:min(100vw,430px)!important;
            }
            .notification-card{
                padding:16px;
            }
            .notification-card .mt-3.d-flex{
                flex-wrap:wrap;
                gap:8px!important;
            }
            .notification-card .btn,
            .notification-card .badge{
                height:auto;
                min-height:38px;
                max-width:100%;
                white-space:normal;
                text-align:center;
            }
            .main .table-responsive,
            .main .card-body{
                overflow-x:auto;
                -webkit-overflow-scrolling:touch;
            }
            .main table{
                min-width:680px;
            }
            .main img,
            .main iframe,
            .main video{
                max-width:100%;
            }
            .main input,
            .main select,
            .main textarea,
            .main .form-control,
            .main .form-select{
                min-width:0;
                max-width:100%;
            }
            .modal-dialog{
                margin:12px;
            }
            }
            @media(max-width:767.98px){
                .main{
                    padding:18px 12px;
                }
            .main .card{
                max-width:100%;
            }
            .main .row{
                --bs-gutter-x:1rem;
            }
            .main form .d-flex.justify-content-between,
            .main form .d-flex.justify-content-end,
            .main .card-footer .d-flex.justify-content-between{
                display:grid!important;
                grid-template-columns:minmax(0,1fr)!important;
                gap:12px!important;
                width:100%;
            }
            .main form .d-flex.justify-content-between > *,
            .main form .d-flex.justify-content-end > *,
            .main .card-footer .d-flex.justify-content-between > *{
                width:100%!important;
                min-width:0!important;
                max-width:none!important;
                margin:0!important;
            }
            .main form .d-flex.justify-content-between .btn,
            .main form .d-flex.justify-content-end .btn,
            .main .card-footer .d-flex.justify-content-between .btn{
                width:100%!important;
                min-height:46px;
                display:inline-flex;
                align-items:center;
                justify-content:center;
                white-space:normal;
                text-align:center;
                transform:none!important;
            }
            .btn:hover,
            .card:hover{
                transform:none;
            }
            }
            @media(max-width:575.98px){
                .topbar{
                    padding:9px 12px;
                }
            .topbar h5{
                max-width:40vw;
                font-size:.94rem;
            }
            .main{
                padding:16px 10px;
            }
            .notification-card{
                padding:14px;
                gap:10px;
            }
            .notification-icon{
                width:40px;
                height:40px;
                min-width:40px;
                font-size:18px;
            }
            .notification-card p{
                font-size:.86rem;
            }
            .footer{
                padding:14px 10px;
                font-size:.78rem;
            }
            }
            @media(max-width:359.98px){
                .sidebar,
                .sidebar.collapsed{
                    width:88vw!important;
                }
            .topbar h5{
                max-width:34vw;
                font-size:.86rem;
            }
            }

        </style>

        @stack('styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        <div class="sidebar" id="sidebarMenu">

            <div class="logo">

                <img
                src="{{ asset('images/logo-pemalang.png') }}"
                class="logo-pemalang"
                alt="Logo Kabupaten Pemalang">

                <div class="logo-text">
                    <h3>Helpdesk</h3>
                    <small>
                        Pemkab Pemalang
                    </small>
                </div>

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

                    Admin Helpdesk

                </small>

            </div>

            <div class="menu">

                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>

                </a>

                <a href="{{ route('admin.ticket.index') }}"
                    class="{{ request()->routeIs('admin.ticket.*') ? 'active' : '' }}">

                    <i class="bi bi-ticket-perforated-fill"></i>
                    <span>Kelola Tiket</span>

                </a>

                <a href="{{ route('admin.service.index') }}"
                    class="{{ request()->routeIs('admin.service.*') ? 'active' : '' }}">

                    <i class="bi bi-tools"></i>
                    <span>Kelola Layanan</span>

                </a>

                <a href="{{ route('admin.user.index') }}"
                    class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">

                    <i class="bi bi-people-fill"></i>
                    <span>Data User</span>

                </a>

                <a href="{{ route('admin.profile') }}"
                    class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">

                    <i class="bi bi-person-circle"></i>
                    <span>Edit Profil</span>

                </a>

            </div>

            <div class="logout">

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button>

                        <i class="bi bi-box-arrow-right me-2"></i>

                        <span>Logout</span>

                    </button>

                </form>

            </div>

        </div>

        <div class="content">
            <div class="topbar">
                <!-- Tombol Toggle Sidebar -->
                <button type="button" class="btn btn-light border-0 me-3" id="toggleSidebar" aria-label="Buka menu" aria-controls="sidebarMenu" aria-expanded="false">
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

                © {{ date('Y') }} Helpdesk Pemkab Pemalang

            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                <div class="offcanvas offcanvas-end"
                tabindex="-1"
                id="notificationCanvas">

                <div class="offcanvas-header">

                <h5 class="fw-bold">

                <i class="bi bi-bell-fill text-primary"></i>

                Notifikasi

                </h5>

                <button type="button" class="btn-close"
                data-bs-dismiss="offcanvas">
                </button>

                </div>

                <div class="offcanvas-body p-0">

                @forelse($notifications as $notif)

                <div class="notification-card {{ $notif->is_read ? 'notification-read' : '' }}">

                <div class="notification-icon">

                @if(Str::contains($notif->judul,'Status'))

                <i class="bi bi-arrow-repeat text-primary"></i>

                @elseif(Str::contains($notif->judul,'Komentar'))

                <i class="bi bi-chat-dots-fill text-success"></i>

                @else

                <i class="bi bi-info-circle-fill text-warning"></i>

                @endif

                </div>

                <div class="flex-grow-1">

                <h6>{{ $notif->judul }}</h6>

                <p>{{ $notif->pesan }}</p>

                <small>{{ $notif->created_at->diffForHumans() }}</small>

                <div class="mt-3 d-flex align-items-center gap-2">

                <a href="{{ route('admin.notification',$notif->id) }}"
                class="btn btn-outline-primary btn-sm rounded-pill px-4">

                <i class="bi bi-eye"></i>

                Lihat Tiket

                </a>

               @if($notif->is_read)

                <span class="badge rounded-pill bg-success-subtle text-success border border-success">

                <i class="bi bi-check-circle-fill me-1"></i>

                Sudah Dibaca

                </span>

                @else

                <form action="{{ route('admin.notification.read',$notif->id) }}" method="POST">

                @csrf

                @method('PUT')

                <button type="submit" class="btn btn-sm btn-success rounded-pill px-4">

                <i class="bi bi-check2-circle me-1"></i>

                Tandai Dibaca

                </button>

                </form>

                @endif

                </div>

                </div>

                </div>

                @empty

                <div class="text-center py-5">

                <i class="bi bi-bell-slash fs-1 text-muted"></i>

                <p class="mt-3 mb-0">

                Belum ada notifikasi.

                </p>

                </div>

                @endforelse

                </div>

                </div>

                </div>
                @stack('scripts')
            <script>
                (() => {
                    const sidebar=document.querySelector('.sidebar');
                    const toggle=document.getElementById('toggleSidebar');
                    const backdrop=document.getElementById('sidebarBackdrop');
                    const mobileBreakpoint=992;
                    const isMobile=()=>window.innerWidth<mobileBreakpoint;

                    const setToggleState=isOpen=>{
                        if(!toggle){
                            return;
                        }
                    toggle.setAttribute('aria-expanded',String(isOpen));
                    toggle.setAttribute('aria-label',isOpen?'Tutup menu':'Buka menu');
                };

                const closeMobileSidebar=()=>{
                    sidebar?.classList.remove('mobile-open');
                    backdrop?.classList.remove('show');
                    document.body.classList.remove('sidebar-open');
                    setToggleState(false);
                };

                const openMobileSidebar=()=>{
                    sidebar?.classList.remove('collapsed');
                    sidebar?.classList.add('mobile-open');
                    backdrop?.classList.add('show');
                    document.body.classList.add('sidebar-open');
                    setToggleState(true);
                };

                if(sidebar){
                    if(isMobile()){
                        sidebar.classList.remove('collapsed');
                    }else if(localStorage.getItem('sidebar')==='collapsed'){
                    sidebar.classList.add('collapsed');
                }
                }

                toggle?.addEventListener('click',event=>{
                    event.preventDefault();

                    if(isMobile()){
                        if(sidebar?.classList.contains('mobile-open')){
                            closeMobileSidebar();
                        }else{
                        openMobileSidebar();
                    }
                return;
                }

                sidebar?.classList.toggle('collapsed');
                localStorage.setItem(
                'sidebar',
                sidebar?.classList.contains('collapsed')?'collapsed':'open'
                );
                });

                backdrop?.addEventListener('click',closeMobileSidebar);

                document.querySelectorAll('.sidebar .menu a').forEach(link=>{
                    link.addEventListener('click',()=>{
                        if(isMobile()){
                            closeMobileSidebar();
                        }
                });
                });

                document.addEventListener('keydown',event=>{
                    if(event.key==='Escape'){
                        closeMobileSidebar();
                    }
                });

                window.addEventListener('resize',()=>{
                    if(isMobile()){
                        sidebar?.classList.remove('collapsed');
                        closeMobileSidebar();
                        return;
                    }

                closeMobileSidebar();
                sidebar?.classList.toggle(
                'collapsed',
                localStorage.getItem('sidebar')==='collapsed'
                );
                });
                })();
            </script>
        </body>
    </html>
