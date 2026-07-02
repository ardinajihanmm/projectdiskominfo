@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <h2>Login</h2>

    <form action="{{ url('/login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button class="btn btn-primary">
            Login
        </button>
    </form>

    <p class="mt-3">
        Belum punya akun?
        <a href="{{ url('/register') }}">Daftar</a>
    </p>
</div>
@endsection