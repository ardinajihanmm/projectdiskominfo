@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Dashboard Admin</h2>

    <div class="row mt-4">

        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total User</h5>
                    <h2>{{ $totalUser }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Layanan</h5>
                    <h2>{{ $totalService }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5>Total Tiket</h5>
                    <h2>{{ $totalTicket }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-4 mb-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h5>To Do</h5>
                    <h2>{{ $todo }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-info">
                <div class="card-body text-center">
                    <h5>In Progress</h5>
                    <h2>{{ $progress }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h5>Done</h5>
                    <h2>{{ $done }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection