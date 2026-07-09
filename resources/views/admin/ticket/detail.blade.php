@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h3 class="mb-4">
        <i class="bi bi-ticket-detailed-fill"></i>
        Detail Tiket
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

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
                    <th>Lampiran</th>
                    <td>

                        @if($ticket->attachments->count())

                            @foreach($ticket->attachments as $file)

                                <a href="{{ asset('storage/'.$file->path_file) }}"
                                   target="_blank"
                                   class="btn btn-info btn-sm mb-2">

                                    <i class="bi bi-paperclip"></i>
                                    Lihat Lampiran

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

            <hr>

            {{-- Update Status & Prioritas --}}
            <form action="{{ route('admin.ticket.update',$ticket->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Status
                        </label>

                        <select name="status" class="form-select">

                            <option value="To Do"
                                {{ $ticket->status=='To Do' ? 'selected' : '' }}>
                                To Do
                            </option>

                            <option value="In Progress"
                                {{ $ticket->status=='In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="Completed"
                                {{ $ticket->status=='Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Prioritas
                         </label>

                         <select name="prioritas" class="form-select">

                            <option value="Rendah"
                                {{ $ticket->prioritas == 'Rendah' ? 'selected' : '' }}>
                                Rendah
                            </option>

                            <option value="Sedang"
                                {{ $ticket->prioritas == 'Sedang' ? 'selected' : '' }}>
                                Sedang
                            </option>

                            <option value="Tinggi"
                                {{ $ticket->prioritas == 'Tinggi' ? 'selected' : '' }}>
                                Tinggi
                            </option>

                        </select>
                    </div>

                </div>

                <button class="btn btn-success">
                    <i class="bi bi-check-circle"></i>
                    Simpan Status & Prioritas
                </button>

            </form>

            <hr>

            {{-- Assign Staff --}}
            <form action="{{ route('admin.ticket.assign',$ticket->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Assign Staff
                    </label>

                    <select name="staff_id" class="form-select">

                        <option value="">
                            -- Pilih Staff --
                        </option>

                        @foreach($staffs as $staff)

                            <option value="{{ $staff->id }}"
                                {{ $ticket->staff_id == $staff->id ? 'selected' : '' }}>

                                {{ $staff->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-person-check-fill"></i>
                    Assign Staff
                </button>

                <a href="{{ route('admin.ticket.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection