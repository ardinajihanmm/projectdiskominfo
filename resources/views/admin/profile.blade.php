@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">

    <!-- PROFILE CARD -->
    <div class="col-lg-4">

        <div class="card shadow border-0 rounded-4">

            <div class="card-body text-center">

                @if(Auth::user()->photo)

                    <img src="{{ asset('storage/profile/'.Auth::user()->photo) }}"
                         class="rounded-circle shadow mb-3"
                         width="140"
                         height="140"
                         style="object-fit:cover;">

                @else

                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff&size=256"
                         class="rounded-circle shadow mb-3"
                         width="140"
                         height="140">

                @endif

                <h3 class="fw-bold mb-1">
                    {{ Auth::user()->name }}
                </h3>

                <span class="badge bg-primary px-3 py-2 mb-3">
                    {{ ucfirst(Auth::user()->role) }}
                </span>

                <hr>

                <div class="text-start">

                    <p>
                        <i class="bi bi-envelope-fill text-primary"></i>
                        <strong>Email</strong><br>
                        {{ Auth::user()->email }}
                    </p>

                    <p>
                        <i class="bi bi-telephone-fill text-success"></i>
                        <strong>No HP</strong><br>
                        {{ Auth::user()->no_hp ?? '-' }}
                    </p>

                    <p>
                        <i class="bi bi-building text-warning"></i>
                        <strong>Instansi</strong><br>
                        {{ Auth::user()->instansi ?? '-' }}
                    </p>

                </div>

                <button
                    class="btn btn-warning w-100 mt-3"
                    data-bs-toggle="modal"
                    data-bs-target="#passwordModal">

                    <i class="bi bi-key-fill"></i>
                    Ganti Password

                </button>

            </div>

        </div>

    </div>

    <!-- FORM -->
    <div class="col-lg-8">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0">
                    <i class="bi bi-person-fill"></i>
                    Edit Profil
                </h4>

            </div>

            <div class="card-body">

                <form
                    action="{{ route('admin.profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ Auth::user()->name }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ Auth::user()->email }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Nomor HP
                                </label>

                                <input type="text"
                                    name="no_hp"
                                    class="form-control"
                                    value="{{ Auth::user()->no_hp }}">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Instansi
                                </label>

                                <input type="text"
                                    name="instansi"
                                    class="form-control"
                                    value="{{ Auth::user()->instansi }}">

                            </div>

                            <div class="col-12 mb-4">

                                <label class="form-label">
                                    Foto Profil
                                </label>

                                <input type="file"
                                    name="photo"
                                    class="form-control">

                            </div>

                        </div>

                        <button class="btn btn-primary px-4">

                            <i class="bi bi-save"></i>
                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
   <!-- Modal Ganti Password -->
<div class="modal fade" id="passwordModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">
                    <i class="bi bi-key-fill"></i>
                    Ganti Password
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('admin.password.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Password Lama</label>

                        <input
                            type="password"
                            name="old_password"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password Baru</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Konfirmasi Password</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        <i class="bi bi-key-fill"></i>
                        Simpan Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection 