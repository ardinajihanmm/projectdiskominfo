@extends('layouts.admin')

@section('title', 'Edit Profil')

@section('content')
<div class="container-fluid py-4">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    {{ session('error') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">

<!-- ================= PROFILE CARD ================= -->
<div class="col-lg-4">

    <div class="card border-0 shadow-lg rounded-5 overflow-hidden">

        <!-- Header -->
        <div class="text-center py-5 text-white"
            style="background:linear-gradient(135deg,#2563eb,#4f8dfd);">

            @if(Auth::user()->foto)

              <img src="{{ asset('storage/profile/'.Auth::user()->foto) }}?v={{ time() }}"
                 class="profile-foto rounded-circle border border-4 border-white shadow">

            @else

                <div
                    class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center shadow"
                    style="width:140px;height:140px;">

                    <i class="bi bi-person-fill text-primary"
                        style="font-size:70px;"></i>

                </div>

            @endif

            <h3 class="fw-bold mt-4 mb-1">

                {{ Auth::user()->name }}

            </h3>

            <span class="badge bg-light text-primary rounded-pill px-4 py-2">

                <i class="bi bi-patch-check-fill me-1"></i>

                {{ ucfirst(Auth::user()->role) }}

            </span>

        </div>

        <!-- Body -->
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

                                {{ Auth::user()->email }}

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

                                {{ Auth::user()->no_hp ?? '-' }}

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

                                {{ Auth::user()->instansi ?? '-' }}

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

<!-- ================= FORM EDIT PROFILE ================= -->
<div class="col-lg-8">

    <div class="card border-0 shadow-lg rounded-5 overflow-hidden">

        <div class="card-header border-0 text-white py-4"
            style="background:linear-gradient(135deg,#2563eb,#4f8dfd);">

            <h4 class="mb-0 fw-bold">

                <i class="bi bi-pencil-square me-2"></i>

                Edit Profil Administrator

            </h4>

        </div>

        <div class="card-body p-4">

            <form
                action="{{ route('admin.profile.update') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Nama -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-person-fill text-primary me-2"></i>

                            Nama Lengkap

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-person"></i>

                            </span>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ Auth::user()->name }}"
                                required>

                        </div>

                    </div>

                    <!-- Email -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-envelope-fill text-danger me-2"></i>

                            Email

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-envelope"></i>

                            </span>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ Auth::user()->email }}"
                                required>

                        </div>

                    </div>

                    <!-- No HP -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-phone-fill text-success me-2"></i>

                            Nomor HP

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-phone"></i>

                            </span>

                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                value="{{ Auth::user()->no_hp }}">

                        </div>

                    </div>

                    <!-- Instansi -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-building-fill text-warning me-2"></i>

                            Instansi

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-building"></i>

                            </span>

                            <input
                                type="text"
                                name="instansi"
                                class="form-control"
                                value="{{ Auth::user()->instansi }}">

                        </div>

                    </div>

                    <!-- Upload Foto -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">

                            <i class="bi bi-camera-fill text-info me-2"></i>

                            Foto Profil

                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control">

                        <small class="text-muted">

                            Format JPG, PNG, JPEG.

                        </small>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end">

                    <button
                        class="btn btn-primary rounded-pill px-5 py-2">

                        <i class="bi bi-floppy-fill me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>
<!-- =================== MODAL GANTI PASSWORD =================== -->

<div class="modal fade"
     id="passwordModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header text-white border-0"
                style="background:linear-gradient(135deg,#f59e0b,#fbbf24);">

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

            <form action="{{ route('admin.password.update') }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <!-- Password Lama -->

                    <label class="fw-semibold mb-2">

                        <i class="bi bi-lock-fill text-warning me-2"></i>

                        Password Lama

                    </label>

                    <div class="input-group mb-3">

                        <span class="input-group-text">

                            <i class="bi bi-key-fill"></i>

                        </span>

                        <input
                            type="password"
                            class="form-control"
                            placeholder="Masukkan password lama"
                            id="oldPassword"
                            name="old_password"
                            required>

                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            onclick="togglePassword('oldPassword',this)">

                            <i class="bi bi-eye-fill"></i>

                        </button>

                    </div>

                    <!-- Password Baru -->

                    <label class="fw-semibold mb-2">

                        <i class="bi bi-shield-fill-lock text-primary me-2"></i>

                        Password Baru

                    </label>

                    <div class="input-group mb-3">

                        <span class="input-group-text">

                            <i class="bi bi-lock-fill"></i>

                        </span>

                        <input
                            type="password"
                            class="form-control"
                            placeholder="Masukkan password baru"
                            id="newPassword"
                            name="password"
                            required>

                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            onclick="togglePassword('newPassword',this)">

                            <i class="bi bi-eye-fill"></i>

                        </button>

                    </div>

                    <!-- Konfirmasi -->

                    <label class="fw-semibold mb-2">

                        <i class="bi bi-check-circle-fill text-success me-2"></i>

                        Konfirmasi Password

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-check2-square"></i>

                        </span>

                        <input
                            type="password"
                            class="form-control"
                            placeholder="Ulangi password baru"
                            id="confirmPassword"
                            name="password_confirmation"
                            required>

                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            onclick="togglePassword('confirmPassword',this)">

                            <i class="bi bi-eye-fill"></i>

                        </button>

                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4">

                    <button
                        type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">

                        <i class="bi bi-x-circle me-1"></i>

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning rounded-pill px-4">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        Simpan Password

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
}

.input-group-text{
    border-right:none;
    background:#fff;
}

.form-control{
    border-left:none;
}

.form-control:focus{

    box-shadow:none;

    border-color:#86b7fe;

}

.list-group-item{

    transition:.25s;

}

.list-group-item:hover{

    background:#f8f9fa;

}

.btn{

    transition:.25s;

}

.btn:hover{

    transform:translateY(-2px);

}
.profile-foto{
    width:240px;
    height:240px;
    border-radius:50%;
    object-fit:cover;
    object-position:center;
    border:6px solid #fff;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    display:block;
    margin:0 auto;
}

</style>
<script>

function togglePassword(id, button){

    let input=document.getElementById(id);

    let icon=button.querySelector("i");

    if(input.type==="password"){

        input.type="text";

        icon.classList.remove("bi-eye-fill");

        icon.classList.add("bi-eye-slash-fill");

    }else{

        input.type="password";

        icon.classList.remove("bi-eye-slash-fill");

        icon.classList.add("bi-eye-fill");

    }

}

</script>
@endsection 