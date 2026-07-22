@extends('layouts.app')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root {
    --primary: #2563eb;
    --primary-light: #3b82f6;
    --primary-dark: #1d4ed8;
    --text: #0f172a;
    --muted: #64748b;
    --border: #e2e8f0;
    --radius-lg: 24px;
    --radius-md: 20px;
    --radius-sm: 12px;
    --shadow-lg: 0 26px 60px rgba(37, 99, 235, .18);
}
.btn-home-float {
    position: fixed;
    right: 30px;
    bottom: 30px;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 10px 25px rgba(37, 99, 235, .35);
    text-decoration: none;
    z-index: 999;
    transition: .3s;
}

.btn-home-float:hover {
    color: #fff;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 35px rgba(37, 99, 235, .45);
}

@media (max-width: 576px) {
    .btn-home-float {
        right: 18px;
        bottom: 18px;
        width: 48px;
        height: 48px;
        font-size: 20px;
    }
}
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html,
body {
    width: 100%;
    min-height: 100%;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    min-height: 100dvh;
    padding: 30px;
    overflow-x: hidden;
    overflow-y: auto;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, .15) 0%, transparent 32%),
        radial-gradient(circle at bottom left, rgba(255, 255, 255, .10) 0%, transparent 32%),
        linear-gradient(135deg, var(--primary), var(--primary-light));
}

body::before,
body::after {
    position: fixed;
    z-index: 0;
    content: '';
    border-radius: 50%;
    pointer-events: none;
}

body::before {
    top: -160px;
    right: -160px;
    width: 470px;
    height: 470px;
    background: rgba(255, 255, 255, .08);
}

body::after {
    bottom: -120px;
    left: -120px;
    width: 330px;
    height: 330px;
    background: rgba(255, 255, 255, .06);
}

.container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 100%;
    padding: 0;
}

.login-card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 500px;
    padding: 28px 34px;
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    transition: transform .25s ease, box-shadow .25s ease;
}

@media (hover: hover) {
    .login-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 30px 65px rgba(37, 99, 235, .25);
    }
}

.logo-pemalang {
    width: 64px;
    height: 64px;
    margin-bottom: 9px;
    object-fit: contain;
}

.login-title {
    margin-bottom: 2px;
    color: var(--primary);
    font-size: 2.15rem;
    font-weight: 800;
    letter-spacing: -.02em;
}

.login-instansi {
    color: var(--primary);
    font-size: .92rem;
    font-weight: 700;
}

.login-subtitle {
    margin: 5px auto 0;
    color: var(--muted);
    font-size: .92rem;
    line-height: 1.7;
}

.login-divider {
    margin: 15px 0;
    opacity: .12;
}

.form-label {
    margin-bottom: 6px;
    color: var(--text);
    font-size: .9rem;
    font-weight: 600;
}

.input-group {
    margin: 2px 0;
    overflow: hidden;
    border: 1.5px solid var(--border);
    border-radius: 999px;
    transition: border-color .25s ease, box-shadow .25s ease, transform .25s ease;
}

.input-group:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 5px rgba(37, 99, 235, .14);
    transform: scale(1.01);
}

.input-group-text {
    width: 48px;
    flex: 0 0 48px;
    justify-content: center;
    color: #fff;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border: 0;
}

.form-control {
    min-width: 0;
    height: 48px;
    padding-right: 12px;
    font-size: 14px;
    border: 0;
    box-shadow: none !important;
}

.form-control:hover {
    background: #fafcff;
}

.form-control:focus {
    background: #fff;
}

.form-control::placeholder {
    color: #94a3b8;
}

.password-toggle {
    width: 52px;
    flex: 0 0 52px;
    color: var(--muted);
    background: #fff;
    border: 0;
}

.password-toggle:hover,
.password-toggle:focus {
    color: var(--primary);
    background: #f8fafc;
}

.btn-login {
    width: 100%;
    height: 48px;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: .2px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border: 0;
    border-radius: 999px;
    box-shadow: 0 14px 28px -10px rgba(37, 99, 235, .55);
    transition: transform .25s ease, background .25s ease, box-shadow .25s ease;
}

.btn-login:hover {
    color: #fff;
    background: linear-gradient(135deg, var(--primary-dark), var(--primary));
    box-shadow: 0 18px 32px -10px rgba(37, 99, 235, .6);
    transform: translateY(-3px);
}

.btn-login:active {
    transform: scale(.98);
}

.btn-login:disabled {
    cursor: not-allowed;
    opacity: .75;
}

.register-link {
    margin-top: 12px;
    color: var(--muted);
    font-size: .9rem;
    text-align: center;
}

.register-link a {
    color: var(--primary);
    font-weight: 700;
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}

.login-footer {
    margin-top: 10px;
    color: #94a3b8;
    font-size: .8rem;
    text-align: center;
}

.alert {
    border: 0;
    border-radius: var(--radius-sm);
}

input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #fff inset;
}

input::-ms-reveal,
input::-ms-clear {
    display: none;
}

input[type='password']::-webkit-credentials-auto-fill-button,
input[type='password']::-webkit-textfield-decoration-container {
    display: none !important;
}

@media (max-width: 768px) {
    body {
        align-items: flex-start;
        padding: 18px;
    }

    .container {
        min-height: calc(100dvh - 36px);
    }

    .login-card {
        max-width: 100%;
        padding: 26px 24px;
        border-radius: var(--radius-md);
    }

    .logo-pemalang {
        width: 60px;
        height: 60px;
    }

    .login-title {
        font-size: 2rem;
    }

    .login-subtitle {
        font-size: .9rem;
    }
}

@media (max-width: 480px) {
    body {
        padding: 12px;
    }

    .container {
        min-height: calc(100dvh - 24px);
    }

    .login-card {
        padding: 22px 18px;
        border-radius: 18px;
    }

    .logo-pemalang {
        width: 54px;
        height: 54px;
        margin-bottom: 6px;
    }

    .login-title {
        font-size: 1.75rem;
    }

    .login-instansi,
    .login-subtitle,
    .register-link {
        font-size: .84rem;
    }

    .login-divider {
        margin: 12px 0;
    }

    .form-label {
        font-size: .84rem;
    }

    .input-group-text {
        width: 44px;
        flex-basis: 44px;
    }

    .form-control,
    .btn-login {
        height: 46px;
    }

    .form-control {
        font-size: 13px;
    }

    .password-toggle {
        width: 46px;
        flex-basis: 46px;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        transform: none;
    }
}

@media (max-width: 360px) {
    body {
        padding: 8px;
    }

    .container {
        min-height: calc(100dvh - 16px);
    }

    .login-card {
        padding: 20px 14px;
        border-radius: 16px;
    }

    .input-group-text {
        width: 40px;
        flex-basis: 40px;
    }

    .password-toggle {
        width: 42px;
        flex-basis: 42px;
    }

    .form-control {
        padding-right: 8px;
        font-size: 12.5px;
    }
}

@media (max-height: 760px) {
    body {
        align-items: flex-start;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        scroll-behavior: auto !important;
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
}
</style>

<div class="container">
    <div class="login-card">
        <div class="text-center">
            <img src="{{ asset('images/logo-pemalang.png') }}" class="logo-pemalang" alt="Logo Kabupaten Pemalang">
            <h1 class="login-title">Helpdesk</h1>
            <div class="login-instansi">Pemkab Pemalang</div>
            <p class="login-subtitle">Silakan lengkapi data berikut untuk membuat akun.</p>
        </div>
        <hr class="login-divider">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $errors->first() }}
            </div>
        @endif
        <form id="registerForm" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Masukkan nama lengkap" autocomplete="name" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Masukkan alamat email" autocomplete="email" inputmode="email" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="no_hp">Nomor HP</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" class="form-control" placeholder="08xxxxxxxxxx" autocomplete="tel" inputmode="tel" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="instansi">Instansi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
                    <input type="text" id="instansi" name="instansi" value="{{ old('instansi') }}" class="form-control" placeholder="Nama instansi (opsional)" autocomplete="organization">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 6 karakter" autocomplete="new-password" required>
                    <button type="button" class="btn password-toggle" onclick="togglePassword('password', this)" aria-label="Tampilkan password">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi password" autocomplete="new-password" required>
                    <button type="button" class="btn password-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan konfirmasi password">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-login">
                <i class="bi bi-person-plus-fill me-2"></i>Daftar Akun
            </button>
        </form>
        <div class="register-link">
            Sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
        <div class="login-footer">© {{ date('Y') }} Helpdesk Pemkab Pemalang</div>
    </div>
</div>

<script>
function togglePassword(id, button) {
    const input = document.getElementById(id);
    const icon = button.querySelector('i');
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    icon.classList.toggle('bi-eye-fill', !isPassword);
    icon.classList.toggle('bi-eye-slash-fill', isPassword);
    button.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
}

const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', function () {
        const button = this.querySelector('.btn-login');
        if (!button) return;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Membuat Akun...';
    });
}

window.addEventListener('load', function () {
    const card = document.querySelector('.login-card');
    if (!card || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    card.animate(
        [
            { opacity: 0, transform: 'translateY(20px)' },
            { opacity: 1, transform: 'translateY(0)' }
        ],
        { duration: 600, easing: 'ease', fill: 'both' }
    );
});
</script>
<a href="{{ route('landing') }}" class="btn-home-float" title="Kembali ke Beranda">
    <i class="bi bi-house-door-fill"></i>
</a>
@endsection