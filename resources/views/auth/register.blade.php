@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container mt-5">

    <h2>Daftar Akun</h2>

    <form action="{{ url('/register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control">
        </div>

        <div class="mb-3">
            <label>Instansi (Opsional)</label>
            <input type="text" name="instansi" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button class="btn btn-success">
            Daftar
        </button>

    </form>

</div>
@endsection