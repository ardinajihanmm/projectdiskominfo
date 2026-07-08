@extends('layouts.staff')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-person-circle"></i>
            Profil Staff
        </h2>
        <small class="text-muted">
            Kelola informasi akun dan ubah password.
        </small>
    </div>

    <div class="row">

        {{-- FOTO PROFIL --}}
        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0d6efd&color=fff&size=200"
                        class="rounded-circle mb-3"
                        width="140">

                    <h4 class="fw-bold mb-1">
                        {{ auth()->user()->name }}
                    </h4>

                    <span class="badge bg-primary">
                        STAFF
                    </span>

                    <hr>

                    <div class="text-start">

                        <p class="mb-2">
                            <i class="bi bi-envelope-fill text-primary"></i>
                            {{ auth()->user()->email }}
                        </p>

                        <p class="mb-2">
                            <i class="bi bi-telephone-fill text-success"></i>
                            {{ auth()->user()->no_hp ?? '-' }}
                        </p>

                        <p class="mb-0">
                            <i class="bi bi-building text-warning"></i>
                            {{ auth()->user()->instansi ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- FORM --}}
        <div class="col-lg-8">

            {{-- EDIT PROFIL --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i>
                        Edit Profil
                    </h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('staff.profile.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', auth()->user()->name) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email', auth()->user()->email) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No HP</label>
                                <input
                                    type="text"
                                    name="no_hp"
                                    class="form-control"
                                    value="{{ old('no_hp', auth()->user()->no_hp) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Instansi</label>
                                <input
                                    type="text"
                                    name="instansi"
                                    class="form-control"
                                    value="{{ old('instansi', auth()->user()->instansi) }}">
                            </div>

                        </div>

                        <button class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            Simpan Perubahan
                        </button>

                    </form>

                </div>

            </div>

            {{-- PASSWORD --}}
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-shield-lock"></i>
                        Ganti Password
                    </h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('staff.profile.password') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label>Password Lama</label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Password Baru</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Konfirmasi Password</label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control">

                        </div>

                        <button class="btn btn-success">

                            <i class="bi bi-key-fill"></i>

                            Ubah Password

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection