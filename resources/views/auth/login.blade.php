@extends('layouts.app')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --primary:#2563eb;
    --primary-light:#3b82f6;
    --primary-dark:#1d4ed8;
    --secondary:#3b82f6;
    --text:#0f172a;
    --muted:#64748b;
    --border:#e2e8f0;

    --radius-lg:24px;
    --radius-md:20px;
    --radius-sm:12px;

    --shadow-sm:0 4px 16px rgba(15,23,42,.06);
    --shadow-md:0 16px 36px rgba(37,99,235,.14);
    --shadow-lg:0 26px 60px rgba(37,99,235,.18);
}

/* RESET */
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; min-height:100%; }

/* BODY */
body {
    font-family:'Plus Jakarta Sans',sans-serif;
    display:flex; justify-content:center; align-items:center;
    min-height:100vh; padding:30px; overflow-y:auto;
    background:
        radial-gradient(circle at top right, rgba(255,255,255,.15) 0%, transparent 32%),
        radial-gradient(circle at bottom left, rgba(255,255,255,.10) 0%, transparent 32%),
        linear-gradient(135deg,var(--primary),var(--primary-light));
}

/* DECORATION */
body::before {
    content:""; position:fixed; width:470px; height:470px;
    border-radius:50%; background:rgba(255,255,255,.08);
    top:-160px; right:-160px; z-index:0;
}
body::after {
    content:""; position:fixed; width:330px; height:330px;
    border-radius:50%; background:rgba(255,255,255,.06);
    bottom:-120px; left:-120px; z-index:0;
}

/* CONTAINER */
.container { width:100%; display:flex; justify-content:center; align-items:center; }

/* CARD */
.login-card {
    width:100%; max-width:500px; background:#fff;
    border-radius:var(--radius-lg); padding:28px 34px;
    box-shadow:var(--shadow-lg); position:relative; z-index:1;
}
.login-card:hover {
    transform:translateY(-4px);
    box-shadow:0 30px 65px rgba(37,99,235,.25);
}

/* HEADER */
.logo-pemalang { width:64px; height:64px; object-fit:contain; margin-bottom:9px; }
.login-title { font-size:2.15rem; font-weight:800; color:var(--primary); letter-spacing:-.02em; margin-bottom:2px; }
.login-instansi { font-size:.92rem; font-weight:700; color:var(--primary); }
.login-subtitle { margin:5px auto 0; font-size:.92rem; line-height:1.7; color:var(--muted); }
.login-divider { margin:10px 0 18px; opacity:.12; }

/* FORM */
.form-label { font-size:.9rem; font-weight:600; color:var(--text); margin-bottom:6px; }
.input-group {
    margin:2px 0 10px; border-radius:999px; overflow:hidden;
    transition:.25s; border:1.5px solid var(--border);
}
.input-group:focus-within {
    transform:scale(1.01);
    box-shadow:0 0 0 5px rgba(37,99,235,.14);
    border-color:var(--primary);
}
.input-group-text {
    width:48px; justify-content:center;
    background:linear-gradient(135deg,var(--primary),var(--primary-light));
    color:#fff; border:none;
}
.form-control {
    height:48px; border:none; font-size:14px; box-shadow:none!important;
}
.form-control:hover { background:#fafcff; }
.form-control:focus { background:#fff; }
.form-control::placeholder { color:#94a3b8; }

/* PASSWORD BUTTON */
.password-toggle { width:56px; border:none; background:#fff; }
.password-toggle:hover { background:#f8fafc; }

/* CHECKBOX */
.form-check { margin-bottom:5px; }
.form-check-input { cursor:pointer; }
.form-check-input:checked { background:var(--primary); border-color:var(--primary); }

/* BUTTON */
.btn-login {
    width:100%; height:48px; border:none; border-radius:999px;
    background:linear-gradient(135deg,var(--primary),var(--primary-light));
    color:#fff; font-weight:600; font-size:15px; letter-spacing:.2px;
    transition:.25s; box-shadow:0 14px 28px -10px rgba(37,99,235,.55);
}
.btn-login:hover {
    transform:translateY(-3px);
    background:linear-gradient(135deg,var(--primary-dark),var(--primary));
    box-shadow:0 18px 32px -10px rgba(37,99,235,.6);
}
.btn-login:active { transform:scale(.98); }

/* REGISTER */
.register-link { margin-top:12px; text-align:center; color:var(--muted); font-size:.9rem; }
.register-link a { color:var(--primary); font-weight:700; text-decoration:none; }
.register-link a:hover { text-decoration:underline; }

/* FOOTER */
.login-footer { margin-top:10px; text-align:center; color:#94a3b8; font-size:.80rem; }

/* ALERT */
.alert { border:none; border-radius:var(--radius-sm); }

/* AUTOFILL */
input:-webkit-autofill { -webkit-box-shadow:0 0 0 1000px white inset; }

/* HIDE EDGE PASSWORD ICON */
input::-ms-reveal, input::-ms-clear { display:none; }
input[type=password]::-webkit-credentials-auto-fill-button,
input[type=password]::-webkit-textfield-decoration-container { display:none!important; }

/* MOBILE */
@media (max-width:768px) {
    body { padding:18px; }
    .login-card { max-width:100%; padding:28px; border-radius:var(--radius-md); }
    .logo-pemalang { width:62px; height:62px; }
    .login-title { font-size:2rem; }
    .login-subtitle { font-size:.9rem; }
}
</style>
<div class="container">
    <div class="login-card">

        {{-- ================= HEADER ================= --}}
        <div class="text-center">
            <img src="{{ asset('images/logo-pemalang.png') }}" class="logo-pemalang" alt="Logo Kabupaten Pemalang">
            <h1 class="login-title">Helpdesk</h1>
            <div class="login-instansi">Pemkab Pemalang</div>
            <p class="login-subtitle">
                Silakan masuk menggunakan akun Anda untuk mengakses layanan,
                memantau progres pengajuan Anda.
            </p>
        </div>

        <hr class="login-divider">

        {{-- ================= ALERT ================= --}}
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $errors->first() }}
            </div>
        @endif

        {{-- ================= FORM ================= --}}
        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                           placeholder="Masukkan alamat email" autocomplete="email" required>
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Masukkan password" autocomplete="current-password" required>
                    <button type="button" class="btn password-toggle" onclick="togglePassword()">
                        <i id="eyeIcon" class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </div>

            {{-- REMEMBER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
            </div>

            {{-- LOGIN BUTTON --}}
            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Sistem
            </button>
        </form>

        {{-- ================= REGISTER ================= --}}
        <div class="register-link">
            Belum memiliki akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>

        {{-- ================= FOOTER ================= --}}
        <div class="login-footer">© {{ date('Y') }} Helpdesk Pemkab Pemalang</div>
    </div>
</div>

<script>
function togglePassword(){
    const input=document.getElementById("password");
    const icon=document.getElementById("eyeIcon");
    if(input.type==="password"){
        input.type="text";
        icon.classList.replace("bi-eye-fill","bi-eye-slash-fill");
    }else{
        input.type="password";
        icon.classList.replace("bi-eye-slash-fill","bi-eye-fill");
    }
}

// Fokus efek
document.querySelectorAll(".form-control").forEach(input=>{
    input.addEventListener("focus",function(){
        this.parentElement.style.transition=".3s";
        this.parentElement.style.transform="scale(1.01)";
        this.parentElement.style.boxShadow="0 0 0 4px rgba(37,99,235,.10)";
    });
    input.addEventListener("blur",function(){
        this.parentElement.style.transform="scale(1)";
        this.parentElement.style.boxShadow="none";
    });
});

// Disable double submit
document.getElementById("loginForm").addEventListener("submit",function(){
    const btn=document.querySelector(".btn-login");
    btn.disabled=true;
    btn.innerHTML=`<span class="spinner-border spinner-border-sm me-2"></span> Sedang Masuk...`;
});

// Fade animation
window.addEventListener("load",()=>{
    const card=document.querySelector(".login-card");
    card.style.opacity="0";
    card.style.transform="translateY(20px)";
    setTimeout(()=>{
        card.style.transition=".6s ease";
        card.style.opacity="1";
        card.style.transform="translateY(0)";
    },100);
});
</script>
@endsection
