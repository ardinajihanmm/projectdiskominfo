@extends('layouts.user')

@section('title','Edit Profil')
@section('content')
<div class="container-fluid py-4">

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show shadow-sm">

    <i class="bi bi-check-circle-fill me-2"></i>

    {{ session('success') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

@if(session('success_password'))

<div class="alert alert-success alert-dismissible fade show shadow-sm">

    <i class="bi bi-check-circle-fill me-2"></i>

    {{ session('success_password') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="row g-4">

    {{-- ================= PROFIL ================= --}}

    <div class="col-lg-4">

        <div class="card border-0 shadow-lg rounded-5 overflow-hidden h-100">

            <div class="text-center py-5 text-white"
                style="background:linear-gradient(135deg,#2563EB,#4F8DFD);">

                @if($user->foto)

                    <img
                        src="{{ asset('storage/'.$user->foto) }}"
                        class="profile-foto rounded-circle">

                @else

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563EB&color=ffffff&size=220"
                        class="profile-foto rounded-circle">

                @endif

                <h3 class="fw-bold mt-4 mb-1">

                    {{ $user->name }}

                </h3>

                <span class="badge bg-light text-primary rounded-pill px-4 py-2">

                    <i class="bi bi-person-check-fill me-1"></i>

                    Pengguna Helpdesk

                </span>

            </div>

            <div class="card-body">

                <div class="list-group list-group-flush">

                    <div class="list-group-item border-0 py-3">

                        <div class="d-flex align-items-center">

                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">

                                <i class="bi bi-envelope-fill text-primary fs-5"></i>

                            </div>

                            <div>

                                <small class="text-muted">

                                    Email

                                </small>

                                <div class="fw-semibold">

                                    {{ $user->email }}

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="list-group-item border-0 py-3">

                        <div class="d-flex align-items-center">

                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">

                                <i class="bi bi-phone-fill text-success fs-5"></i>

                            </div>

                            <div>

                                <small class="text-muted">

                                    Nomor HP

                                </small>

                                <div class="fw-semibold">

                                    {{ $user->no_hp ?: '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="list-group-item border-0 py-3">

                        <div class="d-flex align-items-center">

                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">

                                <i class="bi bi-building-fill text-warning fs-5"></i>

                            </div>

                            <div>

                                <small class="text-muted">

                                    Instansi

                                </small>

                                <div class="fw-semibold">

                                    {{ $user->instansi ?: '-' }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <button
                    class="btn btn-warning w-100 rounded-pill py-3 mt-4 shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#passwordModal">

                    <i class="bi bi-shield-lock-fill me-2"></i>

                    Ganti Password

                </button>

            </div>

        </div>

    </div>

    {{-- ================= FORM ================= --}}

    <div class="col-lg-8">

        <div class="card border-0 shadow-lg rounded-5 overflow-hidden">

            <div class="card-header border-0 text-white py-4"
                style="background:linear-gradient(135deg,#2563EB,#4F8DFD);">

                <h4 class="mb-0 fw-bold">

                    <i class="bi bi-pencil-square me-2"></i>

                    Edit Profil

                </h4>

            </div>

            <div class="card-body p-4">

<form
action="{{ route('user.profile.update') }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')
{{-- ================= FOTO ================= --}}

<div class="mb-4">

    <label class="form-label fw-semibold">

        <i class="bi bi-camera-fill text-primary me-2"></i>

        Foto Profil

    </label>

    <input
        type="file"
        name="foto"
        class="form-control"
        accept=".jpg,.jpeg,.png">

    <small class="text-muted">

        Format JPG, JPEG, PNG • Maksimal 2 MB

    </small>

</div>

<div class="row g-4">

    {{-- Nama --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">

            Nama Lengkap

        </label>

        <div class="input-group">

            <span class="input-group-text">

                <i class="bi bi-person-fill"></i>

            </span>

            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name',$user->name) }}"
                placeholder="Masukkan nama lengkap">

        </div>

        @error('name')

        <div class="invalid-feedback d-block">

            {{ $message }}

        </div>

        @enderror

    </div>

    {{-- Email --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">

            Email

        </label>

        <div class="input-group">

            <span class="input-group-text">

                <i class="bi bi-envelope-fill"></i>

            </span>

            <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email',$user->email) }}"
                placeholder="Masukkan email">

        </div>

        @error('email')

        <div class="invalid-feedback d-block">

            {{ $message }}

        </div>

        @enderror

    </div>

    {{-- Nomor HP --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">

            Nomor HP

        </label>

        <div class="input-group">

            <span class="input-group-text">

                <i class="bi bi-telephone-fill"></i>

            </span>

            <input
                type="text"
                name="no_hp"
                class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp',$user->no_hp) }}"
                placeholder="Contoh: 081234567890">

        </div>

        @error('no_hp')

        <div class="invalid-feedback d-block">

            {{ $message }}

        </div>

        @enderror

    </div>

    {{-- Instansi --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">

            Instansi

        </label>

        <div class="input-group">

            <span class="input-group-text">

                <i class="bi bi-building-fill"></i>

            </span>

            <input
                type="text"
                name="instansi"
                class="form-control @error('instansi') is-invalid @enderror"
                value="{{ old('instansi',$user->instansi) }}"
                placeholder="Masukkan nama instansi">

        </div>

        @error('instansi')

        <div class="invalid-feedback d-block">

            {{ $message }}

        </div>

        @enderror

    </div>

</div>

<hr class="my-4">

<div class="d-flex justify-content-between align-items-center">

    <a
        href="{{ route('user.dashboard') }}"
        class="btn btn-outline-secondary rounded-pill px-4">

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </a>

    <button
        type="submit"
        class="btn btn-primary rounded-pill px-5 shadow-sm">

        <i class="bi bi-floppy-fill me-2"></i>

        Simpan Perubahan

    </button>

</div>

</form>

</div>

</div>

</div>
<!-- Modal Ganti Password -->

<div
    class="modal fade"
    id="passwordModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <div
                class="modal-header border-0 text-white"
                style="background:linear-gradient(135deg,#2563EB,#4F8DFD);">

                <h5 class="modal-title fw-bold">

                    <i class="bi bi-shield-lock-fill me-2"></i>

                    Ganti Password

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form
                action="{{ route('user.password.update') }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Password Lama

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-lock-fill"></i>

                            </span>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control"
                                placeholder="Masukkan password lama"
                                autocomplete="current-password">

                        </div>

                        @error('current_password')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Password Baru

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-key-fill"></i>

                            </span>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password">

                        </div>

                    </div>

                    <div>

                        <label class="form-label fw-semibold">

                            Konfirmasi Password Baru

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-check-circle-fill"></i>

                            </span>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password">

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button
                        type="button"
                        class="btn btn-light border rounded-pill px-4"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-4">

                        <i class="bi bi-key-fill me-2"></i>

                        Simpan Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection