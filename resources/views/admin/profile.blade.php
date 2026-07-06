@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">
        <i class="bi bi-person-circle"></i>
        Profil Admin
    </h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            Edit Profil
        </div>

        <div class="card-body">

            <form action="{{ route('admin.profile.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ auth()->user()->name }}"
                        required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ auth()->user()->email }}"
                        required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ auth()->user()->no_hp }}">
                </div>

                <div class="mb-3">
                    <label>Instansi</label>
                    <input
                        type="text"
                        name="instansi"
                        class="form-control"
                        value="{{ auth()->user()->instansi }}">
                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection