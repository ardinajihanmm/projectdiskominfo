@extends('layouts.user')

@section('title', 'Riwayat Pengajuan')

@section('content')

<div class="container mt-4">

    <h2>Riwayat Pengajuan</h2>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Kode</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>-</td>
                <td>-</td>
                <td>To Do</td>
                <td>Sedang</td>

                <td>

                    <a href="#" class="btn btn-info btn-sm">

                        Detail

                    </a>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection