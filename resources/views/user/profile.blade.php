@extends('layouts.user')

@section('title', 'Profile')

@section('content')

<div class="container mt-4">

    <h2>Profile</h2>

    <form>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Instansi</label>
            <input type="text" class="form-control">
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

    </form>

</div>

@endsection