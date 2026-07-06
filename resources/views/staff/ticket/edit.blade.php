@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>Edit Status Tiket</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.ticket.update', $ticket->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kode Tiket</label>
                    <input type="text" class="form-control"
                           value="{{ $ticket->kode_ticket }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pelapor</label>
                    <input type="text" class="form-control"
                           value="{{ $ticket->user->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Layanan</label>
                    <input type="text" class="form-control"
                           value="{{ $ticket->service->nama_layanan }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control"
                           value="{{ $ticket->judul }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="To Do"
                            {{ $ticket->status == 'To Do' ? 'selected' : '' }}>
                            To Do
                        </option>

                        <option value="In Progress"
                            {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="Done"
                            {{ $ticket->status == 'Done' ? 'selected' : '' }}>
                            Done
                        </option>

                    </select>
                </div>

                <button class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Simpan
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