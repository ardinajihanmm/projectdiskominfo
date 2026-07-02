@extends('layouts.app')

@section('title', 'Portal Layanan Diskominfo')

@section('content')

<div class="container mt-5">

    <h1>Portal Layanan Diskominfo Kabupaten Pemalang</h1>

    <p>
        Selamat datang di Portal Layanan Diskominfo Kabupaten Pemalang.
    </p>

    <a href="{{ url('/login') }}" class="btn btn-primary">
        Login
    </a>

    <a href="{{ url('/register') }}" class="btn btn-success">
        Daftar
    </a>

    <hr>

    <h3>Layanan</h3>

    <ul>
        <li>Wifi Desa</li>
        <li>Domain desa.id</li>
        <li>Jaringan Intra Pemerintah</li>
        <li>Website</li>
        <li>Pusat Data</li>
        <li>Subdomain</li>
        <li>SPLP IPPD</li>
    </ul>

</div>

@endsection