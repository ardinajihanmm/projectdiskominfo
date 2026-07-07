@extends('layouts.staff')

@section('content')

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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <!-- Informasi -->
        <div class="col-lg-8">

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-primary text-white">
                    <i class="bi bi-info-circle"></i>
                    Informasi Tiket
                </div>

                <div class="card-body">

                    <table class="table table-bordered">

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

                                @if($ticket->attachment)

                                    <a href="{{ asset('storage/'.$ticket->attachment->file_path) }}"
                                       class="btn btn-info btn-sm"
                                       target="_blank">

                                        <i class="bi bi-paperclip"></i>
                                        Lihat Lampiran

                                    </a>

                                @else

                                    Tidak ada lampiran

                                @endif

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header bg-success text-white">
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

                    <form action="{{ route('staff.ticket.status',$ticket->id) }}" method="POST">

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

    <div class="card shadow-sm mt-4">

        <div class="card-header bg-dark text-white">

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

<div class="card shadow-sm mt-4">

    <div class="card-header bg-secondary text-white">
        <i class="bi bi-clock-history"></i>
        Timeline Aktivitas
    </div>

    <div class="card-body">

        <div class="alert alert-secondary mb-0">
            Timeline aktivitas belum diaktifkan.
        </div>

    </div>

</div> {{-- container-fluid --}}

@endsection