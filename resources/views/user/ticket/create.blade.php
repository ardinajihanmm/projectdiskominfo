@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Buat Pengajuan Tiket</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.ticket.store') }}"
      method="POST"
      enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label class="form-label">Layanan</label>
            <select name="service_id" class="form-control" required>
                <option value="">-- Pilih Layanan --</option>

                @foreach($services as $service)
                    <option value="{{ $service->id }}">
                        {{ $service->nama_layanan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Pengajuan</label>
            <input
                type="text"
                name="judul"
                class="form-control"
                value="{{ old('judul') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea
                name="deskripsi"
                rows="6"
                class="form-control"
                required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">
                Lampiran (Opsional)
            </label>

            <input
                type="file"
                name="lampiran"
                class="form-control"
                accept=".jpg,.jpeg,.png,.pdf">

            <small class="text-muted">
                Format: JPG, JPEG, PNG, PDF (Maks. 2 MB)
            </small>
        </div>

        <button type="submit" class="btn btn-primary">
            Kirim Tiket
        </button>

        <a href="{{ route('user.dashboard') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection