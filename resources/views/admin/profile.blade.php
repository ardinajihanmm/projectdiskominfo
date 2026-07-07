@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>Edit Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">

        <div class="col-md-6">

            <div class="card mb-4">
                <div class="card-header">
                    Edit Profil
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ Auth::user()->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ Auth::user()->email }}">
                        </div>

                        <button class="btn btn-primary">
                            Simpan Profil
                        </button>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Ganti Password
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.password.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password"
                                   name="old_password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password"
                                   name="password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control">
                        </div>

                        <button class="btn btn-success">
                            Ganti Password
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection