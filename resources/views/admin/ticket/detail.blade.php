@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h3 class="mb-4">Detail Tiket</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table">

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
                    <th>Prioritas</th>
                    <td>{{ $ticket->prioritas }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-warning">
                            {{ $ticket->status }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Lampiran</th>
                    <td>

                        @if($ticket->attachment)

                            <a href="{{ asset('storage/'.$ticket->attachment->file_path) }}"
                               target="_blank"
                               class="btn btn-info btn-sm">

                                <i class="bi bi-paperclip"></i>
                                Lihat Lampiran

                            </a>

                        @else

                            <span class="text-muted">
                                Tidak ada lampiran
                            </span>

                        @endif

                    </td>
                </tr>

            </table>

            <hr>

            <form action="{{ route('admin.ticket.assign',$ticket->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
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