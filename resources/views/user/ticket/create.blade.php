@extends('layouts.user')

@section('title', 'Pengajuan Layanan')

@section('content')

<div class="container mt-4">

    <h2>Pengajuan Layanan</h2>

    <form enctype="multipart/form-data">

        <div class="mb-3">
            <label>Layanan</label>

            <select class="form-control">

                <option>Wifi Desa</option>
                <option>Domain desa.id</option>
                <option>Jaringan Intra Pemerintah</option>
                <option>Website</option>
                <option>Pusat Data</option>
                <option>Subdomain</option>
                <option>SPLP IPPD</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Lampiran</label>
            <input type="file" class="form-control">
        </div>

        <button class="btn btn-success">
            Kirim
        </button>

    </form>

</div>

@endsection