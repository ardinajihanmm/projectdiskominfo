@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-pencil-square text-primary"></i>
                Edit Layanan
            </h2>

            <p class="text-muted mb-0">
                Perbarui informasi layanan Helpdesk Diskominfo.
            </p>
        </div>

        <a href="{{ route('admin.service.index') }}"
           class="btn btn-light border rounded-pill px-4 shadow-sm">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger rounded-4 shadow-sm">

            <strong>
                <i class="bi bi-exclamation-triangle-fill"></i>
                Terjadi Kesalahan
            </strong>

            <hr>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-white border-0 py-4">

            <h4 class="fw-bold mb-0">

                <i class="bi bi-grid-3x3-gap-fill text-primary"></i>

                Informasi Layanan

            </h4>

        </div>

        <div class="card-body p-4">

            <form action="{{ route('admin.service.update',$service->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')
<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-building-fill text-primary me-2"></i>
            Bidang
        </label>

        <input
            type="text"
            name="nama_bidang"
            list="bidangList"
            class="form-control rounded-4 shadow-sm"
            placeholder="Ketik nama bidang (bisa pilih yang sudah ada atau tulis baru)"
            value="{{ old('nama_bidang', $service->department->nama_bidang ?? '') }}"
            autocomplete="off"
            required>

        <datalist id="bidangList">
            @foreach($departments as $department)
                <option value="{{ $department->nama_bidang }}">
            @endforeach
        </datalist>

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">
            <i class="bi bi-router-fill text-success me-2"></i>
            Nama Layanan
        </label>

        <input
            type="text"
            name="nama_layanan"
            class="form-control rounded-4 shadow-sm"
            value="{{ old('nama_layanan',$service->nama_layanan) }}"
            required>

    </div>

</div>

<div class="mb-4">

    <label class="form-label fw-semibold">

        <i class="bi bi-card-text text-warning me-2"></i>

        Deskripsi

    </label>

    <textarea
        name="deskripsi"
        rows="6"
        class="form-control rounded-4 shadow-sm"
        required>{{ old('deskripsi',$service->deskripsi) }}</textarea>

</div>

<div class="mb-4">

    <label class="form-label fw-semibold">
        <i class="bi bi-image-fill text-primary me-2"></i>
        Icon Layanan
    </label>

    @if($service->icon)
        <div class="mb-2 d-flex align-items-center gap-3">
            <img src="{{ asset('storage/'.$service->icon) }}"
                 alt="Icon saat ini"
                 style="width:60px;height:60px;object-fit:contain;border:1px solid #e2e8f0;border-radius:12px;padding:6px;">

            <div class="form-check">
                <input class="form-check-input"
                       type="checkbox"
                       name="hapus_icon"
                       value="1"
                       id="hapusIcon">
                <label class="form-check-label" for="hapusIcon">
                    Hapus icon ini
                </label>
            </div>
        </div>
    @endif

    <input type="file"
           name="icon"
           class="form-control rounded-4 shadow-sm"
           accept="image/*">

    <small class="text-muted">Format: JPG, PNG, WEBP, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah icon.</small>

</div>

<div class="row">

    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">

            <i class="bi bi-hourglass-split text-danger me-2"></i>

            SLA (Hari)

        </label>

        <div class="input-group">

            <input
                type="number"
                name="sla"
                min="1"
                class="form-control rounded-start-4 shadow-sm"
                value="{{ old('sla',$service->sla) }}"
                required>

            <span class="input-group-text rounded-end-4">

                Hari

            </span>

        </div>

    </div>

    <div class="col-md-6 mb-4">

        <label class="form-label fw-semibold">

            <i class="bi bi-toggle-on text-info me-2"></i>

            Status

        </label>

        <select
            name="status"
            class="form-select rounded-4 shadow-sm">

            <option value="1"
                {{ $service->status==1 ? 'selected' : '' }}>

                Aktif

            </option>

            <option value="0"
                {{ $service->status==0 ? 'selected' : '' }}>

                Nonaktif

            </option>

        </select>

    </div>

</div> 
 <div class="d-flex justify-content-end gap-3 mt-4">

    <a href="{{ route('admin.service.index') }}"
       class="btn btn-light border rounded-pill px-4 py-2 shadow-sm">

        <i class="bi bi-arrow-left-circle"></i>
        Kembali

    </a>

    <button
        type="submit"
        class="btn btn-primary rounded-pill px-4 py-2 shadow">

        <i class="bi bi-check-circle-fill"></i>
        Simpan Perubahan

    </button>

</div>

</form>

</div>

</div>

</div>

<style>

.card{
    transition:.3s ease;
}

.card:hover{
    transform:translateY(-4px);
}

.form-control,
.form-select{

    border-radius:16px;
    border:1px solid #dee2e6;
    transition:.25s;

}

.form-control:focus,
.form-select:focus{

    border-color:#0d6efd;
    box-shadow:0 0 0 .2rem rgba(13,110,253,.15);
    transform:translateY(-2px);

}

.form-label{

    color:#495057;
    font-weight:600;

}

.input-group-text{

    border-radius:0 16px 16px 0;
    background:#0d6efd;
    color:white;
    border:none;
    font-weight:600;

}

.btn{

    transition:.25s;

}

.btn:hover{

    transform:translateY(-2px);

}

</style>

@endsection