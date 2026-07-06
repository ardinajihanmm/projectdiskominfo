@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>Tambah User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control"
                value="{{ old('no_hp') }}">
        </div>

        <div class="mb-3">
            <label>Instansi</label>
            <input type="text" name="instansi" class="form-control"
                value="{{ old('instansi') }}">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password"
                class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="user">User</option>
            </select>
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('admin.user.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection