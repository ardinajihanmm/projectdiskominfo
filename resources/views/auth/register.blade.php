@extends('layouts.app')

@section('content')

<style>
body{
    background: linear-gradient(135deg,#0d6efd,#4f8dfd);
    min-height:100vh;
}

.register-card{
    max-width:550px;
    margin:50px auto;
    background:#fff;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
    padding:35px;
}

.register-card h2{
    color:#0d6efd;
    text-align:center;
    font-weight:bold;
    margin-bottom:30px;
}

.input-group-text{
    background:#0d6efd;
    color:white;
}

.btn-register{
    background:#0d6efd;
    color:white;
    font-weight:bold;
    border:none;
    transition:.3s;
}

.btn-register:hover{
    background:#0b5ed7;
    transform:translateY(-2px);
}

.form-control{
    border-radius:8px;
}
</style>

<div class="container">

    <div class="register-card">

        <h2>
            <i class="bi bi-person-plus-fill"></i>
            Register
        </h2>

        <form action="{{ route('register') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </span>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-telephone-fill"></i>
                    </span>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Instansi</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-building"></i>
                    </span>

                    <input
                        type="text"
                        name="instansi"
                        class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required>

                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                        onclick="togglePassword('password',this)">

                        <i class="bi bi-eye"></i>

                    </button>

                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        required>

                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                        onclick="togglePassword('password_confirmation',this)">

                        <i class="bi bi-eye"></i>

                    </button>

                </div>

            </div>

            <button class="btn btn-register w-100">
                <i class="bi bi-person-check-fill"></i>
                Register
            </button>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>

    </div>

</div>

<script>

function togglePassword(id,btn){

    let input=document.getElementById(id);
    let icon=btn.querySelector("i");

    if(input.type==="password"){

        input.type="text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");

    }else{

        input.type="password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");

    }

}

</script>

@endsection