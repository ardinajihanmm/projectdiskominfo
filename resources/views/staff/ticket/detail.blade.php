@extends('layouts.staff')

@section('content')

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 1800,
        showConfirmButton: false
    });
});
</script>
@endif

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="bi bi-ticket-detailed-fill"></i>
            Detail Tiket
        </h2>

        <a href="{{ route('staff.ticket.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="row">

        <!-- Informasi -->
        <div class="col-lg-8">

            <div class="card detail-card mb-4">

                <div class="card-header detail-header">
                    <i class="bi bi-info-circle"></i>
                    Informasi Tiket
                </div>

                <div class="card-body">

                    <table class="table detail-table">

                        <tr>
                            <th width="220">Kode Tiket</th>
                            <td>{{ $ticket->kode_ticket }}</td>
                        </tr>

                        <tr>
                            <th>Pelapor</th>
                            <td>{{ $ticket->user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $ticket->user->email }}</td>
                        </tr>

                        <tr>
                            <th>No HP</th>
                            <td>{{ $ticket->user->no_hp }}</td>
                        </tr>

                        <tr>
                            <th>Instansi</th>
                            <td>{{ $ticket->user->instansi }}</td>
                        </tr>

                        <tr>
                            <th>Layanan</th>
                            <td>{{ $ticket->service->nama_layanan }}</td>
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
                            <td>

                                @if($ticket->prioritas=="Tinggi")
                                    <span class="badge bg-danger">{{ $ticket->prioritas }}</span>
                                @elseif($ticket->prioritas=="Sedang")
                                    <span class="badge bg-warning text-dark">{{ $ticket->prioritas }}</span>
                                @else
                                    <span class="badge bg-success">{{ $ticket->prioritas }}</span>
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>

                                @if($ticket->status=="To Do")
                                    <span class="badge bg-warning">To Do</span>
                                @elseif($ticket->status=="In Progress")
                                    <span class="badge bg-info">In Progress</span>
                                @else
                                    <span class="badge bg-success">Completed</span>
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                        </tr>

                        <tr>
    <th>Lampiran</th>

    <td>

        @if($ticket->attachments->count())

            @foreach($ticket->attachments as $file)

                <a href="{{ asset('storage/'.$file->path_file) }}"
                   class="btn btn-info btn-sm mb-2"
                   target="_blank">

                    <i class="bi bi-paperclip"></i>
                    {{ $file->nama_file }}

                </a>

                <br>

            @endforeach

        @else

            <span class="text-muted">
                Tidak ada lampiran
            </span>

        @endif

    </td>
</tr>
                    </table>

                </div>

            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">

            <div class="card status-card">

                <div class="card-header status-header">
                    <i class="bi bi-person-workspace"></i>
                    Penanganan
                </div>

                <div class="card-body">

                    <p>
                        <strong>Staff</strong><br>
                        {{ Auth::user()->name }}
                    </p>

                    <hr>

                    <p>

                        <strong>Status Saat Ini</strong><br>

                        @if($ticket->status=="To Do")
                            <span class="badge bg-warning">To Do</span>
                        @elseif($ticket->status=="In Progress")
                            <span class="badge bg-info">In Progress</span>
                        @else
                            <span class="badge bg-success">Completed</span>
                        @endif

                    </p>

                    <hr>

                    <form action="{{ route('staff.ticket.update',$ticket->id) }}" method="POST">
            

                        @csrf
                        @method('PUT')

                        <label class="form-label">
                            Ubah Status
                        </label>

                        <select class="form-select mb-3" name="status">

                            <option value="To Do" {{ $ticket->status=='To Do'?'selected':'' }}>
                                To Do
                            </option>

                            <option value="In Progress" {{ $ticket->status=='In Progress'?'selected':'' }}>
                                In Progress
                            </option>

                            <option value="Completed" {{ $ticket->status=='Completed'?'selected':'' }}>
                                Completed
                            </option>

                        </select>

                        <button class="btn btn-success w-100">
                            <i class="bi bi-check-circle"></i>
                            Simpan Status
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <!-- Komentar -->

    <div class="card comment-card mt-4">

        <div class="card-header comment-header">

            <i class="bi bi-chat-dots"></i>
            Diskusi Tiket

        </div>

        <div class="card-body">

            @forelse($ticket->comments as $comment)

                <div class="border rounded p-3 mb-3">

                    <strong>{{ $comment->user->name }}</strong>

                    <small class="float-end text-muted">

                        {{ $comment->created_at->format('d M Y H:i') }}

                    </small>

                    <hr>

                    {{ $comment->komentar }}

                </div>

            @empty

                <div class="alert alert-light">

                    Belum ada komentar.

                </div>

            @endforelse

            <form action="{{ route('staff.comment.store') }}" method="POST">

                @csrf

                <input type="hidden"
                       name="ticket_id"
                       value="{{ $ticket->id }}">

                <textarea
                    class="form-control mb-3"
                    rows="4"
                    name="komentar"
                    placeholder="Masukkan komentar..."
                    required></textarea>

                <button class="btn btn-primary">

                    <i class="bi bi-send"></i>
                    Kirim Komentar

                </button>

            </form>

        </div>

    </div>

  <!-- Timeline -->

<div class="card timeline-card mt-4">

    <div class="card-header timeline-header">
        <i class="bi bi-clock-history"></i>
        Timeline Aktivitas
    </div>

    <div class="card-body">

        <div class="timeline">

    {{-- Tiket dibuat --}}
    <div class="d-flex mb-4">
        <div class="me-3">
            <span class="badge bg-primary rounded-circle p-3">
                <i class="bi bi-plus-lg"></i>
            </span>
        </div>

        <div>
            <strong>Tiket dibuat</strong><br>
            <small class="text-muted">
                {{ $ticket->created_at->format('d M Y H:i') }}
            </small>
        </div>
    </div>

    {{-- Mulai dikerjakan --}}
    @if($ticket->started_at)
    <div class="d-flex mb-4">
        <div class="me-3">
            <span class="badge bg-info rounded-circle p-3">
                <i class="bi bi-play-fill"></i>
            </span>
        </div>

        <div>
            <strong>Tiket mulai dikerjakan</strong><br>
            <small>
                Oleh {{ $ticket->staff->name ?? Auth::user()->name }}
            </small><br>

            <small class="text-muted">
                {{ \Carbon\Carbon::parse($ticket->started_at)->format('d M Y H:i') }}
            </small>
        </div>
    </div>
    @endif

    {{-- Semua komentar --}}
    @foreach($ticket->comments as $comment)
    <div class="d-flex mb-4">

        <div class="me-3">
            <span class="badge bg-warning rounded-circle p-3">
                <i class="bi bi-chat-dots-fill"></i>
            </span>
        </div>

        <div>
            <strong>{{ $comment->user->name }}</strong>
            menambahkan komentar

            <div class="border rounded p-2 mt-2 bg-light">
                {{ $comment->komentar }}
            </div>

            <small class="text-muted">
                {{ $comment->created_at->format('d M Y H:i') }}
            </small>
        </div>

    </div>
    @endforeach

    {{-- Tiket selesai --}}
    @if($ticket->completed_at)
    <div class="d-flex">

        <div class="me-3">
            <span class="badge bg-success rounded-circle p-3">
                <i class="bi bi-check-lg"></i>
            </span>
        </div>

        <div>
            <strong>Tiket selesai</strong><br>

            <small class="text-muted">
                {{ \Carbon\Carbon::parse($ticket->completed_at)->format('d M Y H:i') }}
            </small>
        </div>

    </div>
    @endif

</div>

</div> {{-- container-fluid --}}

@endsection