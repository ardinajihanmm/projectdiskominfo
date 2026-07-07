@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Riwayat Pengajuan Tiket</h2>

        <a href="{{ route('user.ticket.create') }}" class="btn btn-primary">
            + Buat Tiket
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th>Kode</th>
                <th>Layanan</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($tickets as $ticket)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $ticket->kode_ticket }}</td>

                <td>
                    {{ $ticket->service->nama_layanan ?? '-' }}
                </td>

                <td>{{ $ticket->judul }}</td>

                <td>
                    @if($ticket->status == 'To Do')
                        <span class="badge bg-secondary">To Do</span>

                    @elseif($ticket->status == 'In Progress')
                        <span class="badge bg-warning text-dark">
                            In Progress
                        </span>

                    @elseif($ticket->status == 'Completed')
                        <span class="badge bg-success">Completed</span>

                    @else
                        <span class="badge bg-danger">
                            Rejected
                        </span>
                    @endif
                </td>

                <td>
                    {{ $ticket->created_at->format('d-m-Y H:i') }}
                </td>

                <td>

                    <a href="{{ route('user.ticket.detail',$ticket->id) }}"
                       class="btn btn-sm btn-info">
                        Detail
                    </a>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="text-center">
                    Belum ada pengajuan tiket.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection