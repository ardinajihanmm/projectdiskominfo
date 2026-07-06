@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Kelola Tiket</h2>
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
                <th>User</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($tickets as $ticket)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->judul }}</td>

                <td>

                    @if($ticket->status=='To Do')
                        <span class="badge bg-warning text-dark">To Do</span>

                    @elseif($ticket->status=='In Progress')
                        <span class="badge bg-info">In Progress</span>

                    @else
                        <span class="badge bg-success">Done</span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('admin.ticket.show',$ticket->id) }}"
                        class="btn btn-info btn-sm">
                        Detail
                    </a>

                    <a href="{{ route('admin.ticket.edit',$ticket->id) }}"
                        class="btn btn-warning btn-sm">
                        Ubah Status
                    </a>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center">
                    Belum ada tiket.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection