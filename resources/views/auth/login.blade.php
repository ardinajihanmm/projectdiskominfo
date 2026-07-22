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
}

html,
body {
    width: 100%;
    min-height: 100%;
}

body {
    margin: 0;
    min-height: 100vh;
    min-height: 100svh;
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

.login-page {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 100vh;
    min-height: 100svh;
    padding: 30px;
}

.login-card {
    width: 100%;
    max-width: 500px;
    padding: 28px 34px;
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    animation: cardEnter .6s ease both;
    transition: transform .25s ease, box-shadow .25s ease;
}

.login-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 30px 65px rgba(37, 99, 235, .25);
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
    max-width: 410px;
    margin: 5px auto 0;
    color: var(--muted);
    font-size: .92rem;
    line-height: 1.7;
}

.login-divider {
    margin: 10px 0 18px;
    opacity: .12;
}

.form-label {
    margin-bottom: 6px;
    color: var(--text);
    font-size: .9rem;
    font-weight: 600;
}

.input-group {
    margin: 2px 0 10px;
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
    display: flex;
    flex: 0 0 48px;
    align-items: center;
    justify-content: center;
    width: 48px;
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
    display: flex;
    flex: 0 0 56px;
    align-items: center;
    justify-content: center;
    width: 56px;
    color: var(--muted);
    background: #fff;
    border: 0;
}

.password-toggle:hover,
.password-toggle:focus {
    color: var(--primary);
    background: #f8fafc;
}

.form-check {
    margin-bottom: 5px;
}

.form-check-input {
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

.form-check-label {
    color: var(--text);
    font-size: .9rem;
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

@keyframes cardEnter {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .login-page {
        padding: 18px;
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
    .login-page {
        align-items: flex-start;
        padding: 14px;
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
    .register-link,
    .form-check-label {
        font-size: .84rem;
    }

    .login-divider {
        margin: 9px 0 15px;
    }

    .form-label {
        font-size: .84rem;
    }

    .input-group,
    .input-group:focus-within {
        transform: none;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .input-group-text {
        flex-basis: 44px;
        width: 44px;
    }

    .form-control,
    .btn-login {
        height: 46px;
    }

    .password-toggle {
        flex-basis: 48px;
        width: 48px;
    }

    .alert {
        padding: 10px 12px;
        font-size: .84rem;
    }
}

@media (max-width: 360px) {
    .login-page {
        padding: 10px;
    }

    .login-card {
        padding: 19px 14px;
        border-radius: 16px;
    }

    .login-title {
        font-size: 1.6rem;
    }

    .login-subtitle {
        line-height: 1.55;
    }

    .input-group-text {
        flex-basis: 40px;
        width: 40px;
    }

    .password-toggle {
        flex-basis: 44px;
        width: 44px;
    }

    .form-control {
        padding-right: 8px;
        font-size: 13px;
    }
}

@media (max-height: 650px) {
    .login-page {
        align-items: flex-start;
        padding-top: 16px;
        padding-bottom: 16px;
    }
}

@media (hover: none) {
    .login-card:hover,
    .btn-login:hover {
        transform: none;
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

<div class="login-page">
    <div class="login-card">
        <div class="text-center">
            <img
                src="{{ asset('images/logo-pemalang.png') }}"
                class="logo-pemalang"
                alt="Logo Kabupaten Pemalang">
            <h1 class="login-title">Helpdesk</h1>
            <div class="login-instansi">Pemkab Pemalang</div>
            <p class="login-subtitle">
                Silakan masuk menggunakan akun Anda untuk mengakses layanan dan memantau progres pengajuan Anda.
            </p>
        </div>
        <hr class="login-divider">
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $errors->first() }}
            </div>
        @endif

        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control"
                        placeholder="Masukkan alamat email"
                        autocomplete="email"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required>
                    <button
                        type="button"
                        class="btn password-toggle"
                        id="passwordToggle"
                        aria-label="Tampilkan password"
                        aria-pressed="false">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
            </div>
            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Sistem
            </button>
        </form>
        <div class="register-link">
            Belum memiliki akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
        <div class="login-footer">© {{ date('Y') }} Helpdesk Pemkab Pemalang</div>
    </div>
</div>

<script>
(() => {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const loginForm = document.getElementById('loginForm');
    if (passwordInput && passwordToggle) {
        passwordToggle.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            const icon = passwordToggle.querySelector('i');
            passwordInput.type = isHidden ? 'text' : 'password';
            passwordToggle.setAttribute('aria-pressed', String(isHidden));
            passwordToggle.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            if (icon) {
                icon.classList.toggle('bi-eye-fill', !isHidden);
                icon.classList.toggle('bi-eye-slash-fill', isHidden);
            }
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', () => {
            const submitButton = loginForm.querySelector('.btn-login');
            if (!submitButton) {
                return;
            }
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sedang Masuk...';
        });
    }
})();
</script>
<a href="{{ route('landing') }}" class="btn-home-float" title="Kembali ke Beranda">
    <i class="bi bi-house-door-fill"></i>
</a>
@endsection
