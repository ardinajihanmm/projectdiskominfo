@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">
            <i class="bi bi-person-gear text-primary"></i>
            Edit Data User
        </h2>

        <p class="text-muted mb-0">
            Perbarui informasi pengguna Helpdesk Diskominfo.
        </p>

    </div>

    <a href="{{ route('admin.user.index') }}"
       class="btn btn-outline-secondary rounded-pill px-4">

        <i class="bi bi-arrow-left"></i>
        Kembali

    </a>

</div>

{{-- Error --}}
@if ($errors->any())

<div class="alert alert-danger rounded-4 border-0 shadow-sm">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    <strong>Terjadi kesalahan:</strong>

    <ul class="mt-2 mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="card border-0 shadow rounded-4">

<div class="card-body p-4">

<form action="{{ route('admin.user.update',$user->id) }}"
      method="POST">

@csrf
@method('PUT')
<div class="row">

    {{-- Nama --}}
    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-person-fill text-primary me-1"></i>
            Nama Lengkap
        </label>

        <div class="input-group">

            <span class="input-group-text bg-primary text-white">
                <i class="bi bi-person"></i>
            </span>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}"
                required>

        </div>

    </div>

    {{-- Email --}}
    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-envelope-fill text-danger me-1"></i>
            Email
        </label>

        <div class="input-group">

            <span class="input-group-text bg-danger text-white">
                <i class="bi bi-envelope"></i>
            </span>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
                required>

        </div>

    </div>

    {{-- Nomor HP --}}
    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-telephone-fill text-success me-1"></i>
            Nomor HP
        </label>

        <div class="input-group">

            <span class="input-group-text bg-success text-white">
                <i class="bi bi-phone"></i>
            </span>

            <input
                type="text"
                name="no_hp"
                class="form-control"
                value="{{ old('no_hp', $user->no_hp) }}">

        </div>

    </div>

    {{-- Instansi --}}
    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-building text-warning me-1"></i>
            Instansi
        </label>

        <div class="input-group">

            <span class="input-group-text bg-warning text-dark">
                <i class="bi bi-buildings"></i>
            </span>

            <input
                type="text"
                name="instansi"
                class="form-control"
                value="{{ old('instansi', $user->instansi) }}">

        </div>

    </div>

    {{-- Role --}}
    <div class="col-md-12 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-shield-lock-fill text-info me-1"></i>
            Role Pengguna
        </label>

        <div class="input-group">

            <span class="input-group-text bg-info text-white">
                <i class="bi bi-person-badge-fill"></i>
            </span>

            <select
                name="role"
                class="form-select">

                <option value="admin"
                    {{ $user->role=='admin' ? 'selected' : '' }}>
                     Administrator
                </option>

                <option value="staff"
                    {{ $user->role=='staff' ? 'selected' : '' }}>
                    Staff
                </option>

                <option value="user"
                    {{ $user->role=='user' ? 'selected' : '' }}>
                    User
                </option>

            </select>

        </div>

    </div>
        {{-- Tombol --}}
    <div class="d-flex justify-content-between align-items-center mt-2">

        <a href="{{ route('admin.user.index') }}"
           class="btn btn-light border rounded-pill px-4">

            <i class="bi bi-arrow-left-circle"></i>
            Kembali

        </a>

        <button
            type="submit"
            class="btn btn-primary rounded-pill px-5">

            <i class="bi bi-check-circle-fill"></i>
            Simpan Perubahan

        </button>

    </div>

</form>

</div>

</div>

</div>

<style>

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-4px);
    box-shadow:0 18px 40px rgba(0,0,0,.08)!important;
}

.form-control,
.form-select{

    border-radius:12px;
    border:1px solid #dee2e6;
    padding:.7rem .9rem;

}

.form-control:focus,
.form-select:focus{

    border-color:#0d6efd;
    box-shadow:0 0 0 .15rem rgba(13,110,253,.15);

}

.input-group-text{

    border:none;
    width:50px;
    justify-content:center;
    border-radius:12px 0 0 12px;

}

.btn{

    transition:.25s;

}

.btn:hover{

    transform:translateY(-2px);

}

</style>

@endsection