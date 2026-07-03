@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2>Login</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary">
            Login
        </button>

    </form>

    <p class="mt-3">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar</a>
    </p>

</div>

@endsection