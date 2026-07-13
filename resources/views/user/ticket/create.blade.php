@extends('layouts.user')

@section('title','Ajukan Layanan')

@section('content')

<div class="container py-4">

    {{-- Header --}}
    <div class="modern-header mb-4">

        <div>

            <h2 class="fw-bold mb-2">
                <i class="bi bi-send-plus-fill text-primary me-2"></i>
                Ajukan Layanan
            </h2>

            <p class="text-muted mb-0">
                Lengkapi formulir berikut untuk menyampaikan permohonan layanan kepada Helpdesk Diskominfo.
            </p>

        </div>


    </div>

    @if ($errors->any())

    <div class="alert alert-danger rounded-4">

        <strong>Periksa kembali data Anda.</strong>

        <ul class="mb-0 mt-2">

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

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body p-5">

<h5 class="fw-bold mb-4">

    Informasi Pengajuan

</h5>


{{-- layanan --}}
<div class="mb-4">

<label class="form-label fw-semibold">

    Pilih Layanan <span class="text-danger">*</span>

</label>

<select name="service_id"
        class="form-select modern-input"
        required>

<option value="">

Pilih jenis layanan

</option>

@foreach($services as $service)

<option value="{{ $service->id }}">

{{ $service->nama_layanan }}

</option>

@endforeach

</select>

</div>


{{-- judul --}}
<div class="mb-4">

<label class="form-label fw-semibold">

Judul Pengajuan <span class="text-danger">*</span>

</label>

<input
type="text"
name="judul"
class="form-control modern-input"
placeholder="Contoh: Permohonan Pembuatan Email Dinas"
value="{{ old('judul') }}"
required>

</div>


{{-- deskripsi --}}
<div class="mb-4">

<label class="form-label fw-semibold">

Deskripsi Permasalahan <span class="text-danger">*</span>

</label>

<textarea
name="deskripsi"
rows="6"
class="form-control modern-input"
placeholder="Jelaskan permasalahan atau kebutuhan Anda secara lengkap agar petugas lebih mudah membantu."
required>{{ old('deskripsi') }}</textarea>

<div class="form-text">

Semakin lengkap informasi yang diberikan, semakin cepat pengajuan diproses.

</div>

</div>


{{-- upload --}}
<h5 class="fw-bold mt-5 mb-4">

Lampiran

</h5>

<div class="upload-box">

<div class="upload-icon">

<i class="bi bi-cloud-arrow-up-fill"></i>

</div>

<h6>

Unggah Lampiran (Opsional)

</h6>

<p class="text-muted mb-3">

Foto atau dokumen pendukung dapat membantu petugas memahami permasalahan Anda.

</p>

<input
type="file"
name="lampiran"
class="form-control modern-input"
accept=".jpg,.jpeg,.png,.pdf">

<small class="text-muted">

Format: JPG, PNG, PDF • Maksimal 2 MB

</small>

</div>


{{-- tips --}}
<div class="tips-box mt-4">

<i class="bi bi-lightbulb-fill text-warning"></i>

<div>

<strong>Tips</strong>

<p class="mb-0">

Pastikan judul dan deskripsi sesuai dengan kebutuhan Anda agar proses penanganan menjadi lebih cepat.

</p>

</div>

</div>


<div class="d-flex justify-content-end gap-3 mt-5">

<a href="{{ route('user.dashboard') }}"
class="btn btn-light px-4 py-2 rounded-pill">

Kembali

</a>

<button
type="submit"
class="btn btn-primary px-5 py-2 rounded-pill">

<i class="bi bi-send-fill me-2"></i>

Kirim Pengajuan

</button>

</div>

</div>

</div>

</form>

</div>

@endsection