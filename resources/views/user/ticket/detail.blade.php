@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Detail Pengajuan Tiket</h2>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Kode Ticket</th>
                    <td>{{ $ticket->kode_ticket }}</td>
                </tr>

                <tr>
                    <th>Layanan</th>
                    <td>{{ $ticket->service->nama_layanan ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Judul</th>
                    <td>{{ $ticket->judul }}</td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $ticket->deskripsi }}</td>
                </tr>

                <tr>
                    <th>Prioritas</th>
                    <td>{{ $ticket->prioritas }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if($ticket->status == 'To Do')
                            <span class="badge bg-secondary">To Do</span>
                        @elseif($ticket->status == 'In Progress')
                            <span class="badge bg-warning text-dark">In Progress</span>
                        @elseif($ticket->status == 'Done')
                            <span class="badge bg-success">Done</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $ticket->created_at->format('d-m-Y H:i') }}</td>
                </tr>

            </table>

            <h5 class="mt-4">Lampiran</h5>

            @if($ticket->attachments->count())

                <ul>

                    @foreach($ticket->attachments as $file)

                        <li>
                            <a href="{{ asset('storage/'.$file->path_file) }}"
                               target="_blank">
                                {{ $file->nama_file }}
                            </a>
                        </li>

                    @endforeach

                </ul>

            @else

                <p class="text-muted">
                    Tidak ada lampiran.
                </p>

            @endif

            <h5 class="mt-4">Komentar</h5>

            @if($ticket->comments->count())

                @foreach($ticket->comments as $comment)

                    <div class="border rounded p-3 mb-2">

                        <strong>
                            {{ $comment->user->name }}
                        </strong>

                        <small class="text-muted">
                            ({{ $comment->created_at->format('d-m-Y H:i') }})
                        </small>

                        <hr>

                        {{ $comment->isi }}

                    </div>

                @endforeach

            @else

                <div class="alert alert-secondary">
                    Belum ada komentar.
                </div>

            @endif

            <a href="{{ route('user.ticket.history') }}"
                class="btn btn-secondary mt-3">
                Kembali
            </a>

        </div>
    </div>

</div>

@endsection