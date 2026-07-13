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

    <div class="row">

{{-- FOTO PROFIL --}}
<div class="col-lg-4">

    <div class="card profile-card shadow-lg border-0">

        <div class="profile-header text-center">

            <img
                src="{{ auth()->user()->foto
                    ? asset('storage/'.auth()->user()->foto)
                    : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=2563eb&color=fff&size=200' }}"
                class="profile-avatar">

            <h3 class="fw-bold mb-2">
                {{ auth()->user()->name }}
            </h3>

            <span class="profile-role">
                STAFF
            </span>

        </div>

        <div class="card-body">

            <div class="profile-info">

                <div class="info-item">
                    <i class="bi bi-envelope-fill text-primary"></i>

                    <div>
                        <small>Email</small>
                        <strong>{{ auth()->user()->email }}</strong>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-telephone-fill text-success"></i>

                    <div>
                        <small>Nomor HP</small>
                        <strong>{{ auth()->user()->no_hp ?? '-' }}</strong>
                    </div>
                </div>

                <div class="info-item">
                    <i class="bi bi-building text-warning"></i>

                    <div>
                        <small>Instansi</small>
                        <strong>{{ auth()->user()->instansi ?? '-' }}</strong>
                    </div>
                </div>

            </div>

            <a href="#" class="btn btn-warning w-100 rounded-pill mt-4">
                <i class="bi bi-shield-lock-fill"></i>
                Ganti Password
            </a>

        </div>

    </div>

</div>

        {{-- FORM --}}
        <div class="col-lg-8">

            {{-- EDIT PROFIL --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header profile-form-header">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i>
                        Edit Profil
                    </h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('staff.profile.update') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Foto Profil
                            </label>

                            <input
                                type="file"
                                name="foto"
                                class="form-control"
                                accept=".jpg,.jpeg,.png">

                            <small class="text-muted">
                                Format JPG, JPEG, PNG (Maksimal 2 MB)
                            </small>
                        </div>

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

                    <form action="{{ route('staff.profile.password') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input
                                type="password"
                                name="password_lama"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
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

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session('error') }}'
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

@endsection