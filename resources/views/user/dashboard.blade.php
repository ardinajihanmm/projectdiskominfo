@extends('layouts.app')

@section('content')

<h2>Dashboard User</h2>

<p>Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card text-bg-primary">
            <div class="card-body text-center">
                <h5>Total Pengajuan</h5>
                <h2>{{ $totalTicket }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-bg-warning">
            <div class="card-body text-center">
                <h5>To Do</h5>
                <h2>{{ $todo }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-bg-info">
            <div class="card-body text-center">
                <h5>In Progress</h5>
                <h2>{{ $progress }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-bg-success">
            <div class="card-body text-center">
                <h5>Completed</h5>
                <h2>{{ $completed }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('user.ticket.create') }}" class="btn btn-primary">
        Ajukan Layanan
    </a>

    <a href="{{ route('user.ticket.history') }}" class="btn btn-secondary">
        Riwayat Pengajuan
    </a>
</div>

@endsection