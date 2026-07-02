@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')

<div class="container mt-4">

    <h2>Dashboard User</h2>

    <div class="card">
        <div class="card-body">

            <h5>Selamat Datang</h5>

            <p>
                Silakan ajukan layanan atau lihat riwayat pengajuan.
            </p>

            <a href="{{ url('/user/ticket/create') }}" class="btn btn-primary">
                Ajukan Layanan
            </a>

            <a href="{{ url('/user/ticket') }}" class="btn btn-secondary">
                Riwayat
            </a>

        </div>
    </div>

</div>

@endsection