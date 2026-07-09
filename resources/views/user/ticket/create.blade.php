@extends('layouts.user')

@section('content')
@section('title','Ajukan Layanan')

<div class="container mt-4">

    <div class="mb-4">

    <h2 class="fw-bold">

        <i class="bi bi-send-plus-fill text-primary"></i>

        Ajukan Layanan

    </h2>

    <p class="text-muted mb-0">

        Lengkapi formulir berikut untuk mengirim permohonan layanan kepada Tim Diskominfo.

    </p>

</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4">

    <form action="{{ route('user.ticket.store') }}"
      method="POST"
      enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
           <label class="form-label fw-semibold">

    <i class="bi bi-grid-fill text-primary"></i>

    Pilih Layanan

</label>
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
            <label class="form-label fw-semibold">

    <i class="bi bi-card-heading text-primary"></i>

    Judul Pengajuan

</label>
            <input
                type="text"
                name="judul"
                class="form-control"
                placeholder="Contoh: Permohonan Pembuatan Email Dinas"
                value="{{ old('judul') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">

    <i class="bi bi-chat-left-text-fill text-primary"></i>

    Deskripsi Permasalahan

</label>
            <textarea
                name="deskripsi"
                rows="6"
                class="form-control"
                placeholder="Jelaskan kebutuhan atau permasalahan Anda secara lengkap..."
                required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">

    <label class="form-label fw-semibold">

        <i class="bi bi-paperclip text-primary"></i>

        Lampiran (Opsional)

    </label>

    <input
        type="file"
        name="lampiran"
        class="form-control form-control-lg"
        accept=".jpg,.jpeg,.png,.pdf">

    <small class="text-muted">

        JPG • PNG • PDF • Maksimal 2 MB

    </small>

</div>

        <div class="d-flex justify-content-end gap-2 mt-4">

<a href="{{ route('user.dashboard') }}"
class="btn btn-outline-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

<button type="submit"
class="btn btn-primary px-4">

<i class="bi bi-send-fill"></i>

Kirim Tiket

</button>

</div>

</div>

</div>

@endsection