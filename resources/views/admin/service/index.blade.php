@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Layanan</h2>

        <a href="{{ route('admin.service.create') }}" class="btn btn-primary">
            + Tambah Layanan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Bidang</th>
                <th>Nama Layanan</th>
                <th>SLA</th>
                <th>Status</th>
                <th width="170">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($services as $service)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $service->department->nama_bidang ?? '-' }}</td>

                <td>{{ $service->nama_layanan }}</td>

                <td>{{ $service->sla }} Hari</td>

                <td>
                    @if($service->status)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </td>

                <td>

                    <a href="{{ route('admin.service.edit',$service->id) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.service.destroy',$service->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus layanan ini?')">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center">
                    Belum ada data layanan.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
@endsection