@extends('layouts.user')
@section('title','Edit Profil')
@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                        <i class="bi bi-person-circle"></i>
                        Profil Saya
                    </h4>

                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif

    <form action="{{ route('user.profile.update') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

<!-- Foto Profil -->
<!-- FOTO PROFIL -->
<div class="mb-3">

    <div class="text-center mb-3">

        @if($user->foto)

            <img
                src="{{ asset('storage/'.$user->foto) }}"
                class="rounded-circle border border-3 border-white shadow-sm"
                width="110"
                height="110"
                style="object-fit:cover;">

        @else

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563EB&color=ffffff&size=220"
                class="rounded-circle border border-3 border-white shadow-sm"
                width="110"
                height="110">

        @endif

    </div>

    <label class="form-label fw-semibold mb-2">

        <i class="bi bi-image text-primary me-2"></i>

        Foto Profil

    </label>

    <input
        type="file"
        name="foto"
        class="form-control shadow-sm"
        accept=".jpg,.jpeg,.png">

    <div class="form-text mb-0">

        <i class="bi bi-info-circle me-1"></i>

        Format: JPG, JPEG, PNG • Maksimal 2 MB

    </div>

</div>

<!-- NAMA -->
<div class="mb-3 mt-2">

                            <label class="form-label">

                                Nama

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name',$user->name) }}">

                            @error('name')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email',$user->email) }}">

                            @error('email')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                No HP

                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp',$user->no_hp) }}">

                            @error('no_hp')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Instansi

                            </label>

                            <input
                                type="text"
                                name="instansi"
                                class="form-control @error('instansi') is-invalid @enderror"
                                value="{{ old('instansi',$user->instansi) }}">

                            @error('instansi')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('user.dashboard') }}"
                               class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>

                            <button class="btn btn-primary">

                                <i class="bi bi-check-circle"></i>

                                Simpan Perubahan

                            </button>

                        </div>

                    </form>
<hr class="my-5">

<h4 class="mb-4">

    <i class="bi bi-shield-lock"></i>

    Ganti Password

</h4>

@if(session('success_password'))

<div class="alert alert-success alert-dismissible fade show">

<i class="bi bi-check-circle-fill"></i>

{{ session('success_password') }}

<button
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

@endif

<form
    action="{{ route('user.password.update') }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Password Lama</label>

        <input
            type="password"
            name="current_password"
            class="form-control"
            placeholder="Masukkan password lama"
            autocomplete="current-password">

        @error('current_password')

        <small class="text-danger">

            {{ $message }}

        </small>

        @enderror

    </div>

    <div class="mb-3">

        <label>Password Baru</label>

        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Minimal 8 karakter"
    autocomplete="new-password">

    </div>

    <div class="mb-4">

        <label>Konfirmasi Password Baru</label>

        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            placeholder="Ulangi password baru"
    autocomplete="new-password">

    </div>

    <button class="btn btn-warning">

        <i class="bi bi-key-fill"></i>

        Ganti Password

    </button>

</form>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection