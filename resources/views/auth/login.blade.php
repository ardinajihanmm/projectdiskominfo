@extends('layouts.app')

@section('content')

<style>
body{
    background: linear-gradient(135deg,#0d6efd,#4f8dfd);
    min-height:100vh;
}

.login-card{
    max-width:520px;
    margin:60px auto;
    background:#fff;
    border-radius:20px;
    padding:35px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

.login-card h2{
    text-align:center;
    color:#0d6efd;
    font-weight:bold;
    margin-bottom:30px;
}

.form-label{
    font-weight:600;
}

.input-group-text{
    background:#0d6efd;
    color:#fff;
    border:none;
}

.form-control{
    border-radius:8px;
}

.btn-login{
    background:#0d6efd;
    color:white;
    font-weight:bold;
    border:none;
    transition:.3s;
}

.btn-login:hover{
    background:#0b5ed7;
    transform:translateY(-2px);
}

.register-link{
    text-align:center;
    margin-top:20px;
}

.register-link a{
    text-decoration:none;
    font-weight:bold;
}

.logo-icon{
    font-size:60px;
    color:#0d6efd;
    margin-bottom:10px;
}

.alert{
    border-radius:10px;
}
</style>

<div class="container">

    <div class="login-card">

        <div class="text-center">

            <i class="bi bi-headset logo-icon"></i>

            <h2>Helpdesk Login</h2>

            <p class="text-muted">
                Silakan masuk ke akun Anda
            </p>

        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan alamat email"
                        autocomplete="email"
                        required>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password Anda"
                        autocomplete="current-password"
                        required>

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="togglePassword()">

                        <i id="eyeIcon" class="bi bi-eye"></i>

                    </button>

                </div>

            </div>

            <button class="btn btn-login w-100 py-2">

                <i class="bi bi-box-arrow-in-right"></i>

                Login

            </button>

        </form>

        <div class="register-link">

            Belum punya akun?

            <a href="{{ route('register') }}">
                Daftar Sekarang
            </a>

        </div>

    </div>

</div>

<script>

function togglePassword(){

    let password=document.getElementById('password');
    let icon=document.getElementById('eyeIcon');

    if(password.type==="password"){

        password.type="text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");

    }else{

        password.type="password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");

    }

}

</script>

@endsection