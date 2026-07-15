@extends('layouts.staff')

@section('title', 'Profil Staff')

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

<div class="row g-4">

{{-- FOTO PROFIL --}}
<div class="col-lg-4">

    <div class="card border-0 shadow-lg rounded-5 overflow-hidden">

        <!-- Header -->
        <div class="text-center py-5 text-white"
            style="background:linear-gradient(135deg,#2563eb,#4f8dfd);">

 @if(Auth::user()->foto)

<img
    src="{{ asset('storage/'.Auth::user()->foto) }}?v={{ time() }}"
    class="profile-foto"
    alt="Foto Profil">

@else

<div
    class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center shadow"
    style="width:180px;height:180px;">

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

<div class="card-body">

    <div class="list-group list-group-flush">

        <div class="list-group-item border-0 py-3">
            <div class="d-flex align-items-center">

                <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                    <i class="bi bi-envelope-fill text-primary fs-5"></i>
                </div>

                <div>
                    <small class="text-muted">Email</small>
                    <div class="fw-semibold">
                        {{ auth()->user()->email }}
                    </div>
                </div>

            </div>
        </div>

        <div class="list-group-item border-0 py-3">
            <div class="d-flex align-items-center">

                <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                    <i class="bi bi-telephone-fill text-success fs-5"></i>
                </div>

                <div>
                    <small class="text-muted">Nomor HP</small>
                    <div class="fw-semibold">
                        {{ auth()->user()->no_hp ?? '-' }}
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
                    <small class="text-muted">Instansi</small>
                    <div class="fw-semibold">
                        {{ auth()->user()->instansi ?? '-' }}
                    </div>
                </div>

            </div>
        </div>

    </div>
<button
    type="button"
    class="btn btn-warning w-100 rounded-pill mt-4"
    data-bs-toggle="modal"
    data-bs-target="#passwordModal">

    <i class="bi bi-shield-lock-fill"></i>
    Ganti Password
</button>

        </div>

    </div>

</div>

{{-- FORM --}}
<div class="col-lg-8">

{{-- ================= FORM EDIT PROFILE ================= --}}


    <div class="card border-0 shadow-lg rounded-5 overflow-hidden">

        <div class="card-header border-0 text-white py-4"
            style="background:linear-gradient(135deg,#2563eb,#4f8dfd);">

            <h4 class="mb-0 fw-bold">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Profil
            </h4>

        </div>

        <div class="card-body p-4">

            <form
                action="{{ route('staff.profile.update') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Nama --}}
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
                                value="{{ old('name', auth()->user()->name) }}"
                                required>

                        </div>

                    </div>

                    {{-- Email --}}
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
                                value="{{ old('email', auth()->user()->email) }}"
                                required>

                        </div>

                    </div>

                    {{-- Nomor HP --}}
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
                                value="{{ old('no_hp', auth()->user()->no_hp) }}">

                        </div>

                    </div>

                    {{-- Instansi --}}
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
                                value="{{ old('instansi', auth()->user()->instansi) }}">

                        </div>

                    </div>

                    {{-- Upload Foto --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            <i class="bi bi-camera-fill text-info me-2"></i>
                            Foto Profil
                        </label>

                        <input
                            id="foto"
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png">

                        <small class="text-muted">
                            Format JPG, PNG, JPEG. Maksimal 2 MB.
                        </small>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end">

                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-5 py-2">

                        <i class="bi bi-floppy-fill me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div> {{-- card-body --}}
    </div> {{-- card --}}
</div> {{-- col-lg-8 --}}

</div> {{-- row --}}
</div> {{-- container-fluid --}}

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

            <form action="{{ route('staff.profile.password') }}"
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
                            name="password_lama"
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
                            placeholder="Minimal 6 karakter"
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
    width:180px;
    height:180px;
    border-radius:50%;
    object-fit:cover;
    object-position:center;
    border:6px solid #fff;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    display:block;
    margin:0 auto;
}

/* Hilangkan ikon mata bawaan Microsoft Edge */
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
    display: none;
}

/* Hilangkan ikon bawaan browser Chromium */
input[type="password"]::-webkit-credentials-auto-fill-button,
input[type="password"]::-webkit-textfield-decoration-container {
    display: none !important;
}


</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 1800,
    showConfirmButton: false
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session('error') }}'
});
</script>
@endif

@if ($errors->any())
<script>
Swal.fire({
    icon: 'warning',
    title: 'Upload Gagal',
    text: '{{ $errors->first() }}'
});
</script>
@endif

<script>
document.getElementById('foto').addEventListener('change', function () {

    const file = this.files[0];

    if (file && file.size > 2 * 1024 * 1024) {

        Swal.fire({
            icon: 'warning',
            title: 'Ukuran Foto Terlalu Besar',
            text: 'Ukuran foto maksimal 2 MB.'
        });

        this.value = '';
    }
});
</script>

<script>
function togglePassword(id, button){
    let input = document.getElementById(id);
    let icon = button.querySelector("i");

    if(input.type === "password"){
        input.type = "text";
        icon.classList.replace("bi-eye-fill","bi-eye-slash-fill");
    }else{
        input.type = "password";
        icon.classList.replace("bi-eye-slash-fill","bi-eye-fill");
    }
}
</script>

@endsection