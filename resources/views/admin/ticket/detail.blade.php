@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

<style>

body{
    background:#f5f7fb;
}

.main-card{
    border:none;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 .5rem 1rem rgba(0,0,0,.08);
}

.section-title{
    font-size:15px;
    color:#6c757d;
    text-transform:uppercase;
    letter-spacing:1px;
}

.info-title{
    font-size:14px;
    color:#6c757d;
}

.info-value{
    font-size:17px;
    font-weight:600;
    color:#2d3436;
}

.avatar{

    width:75px;
    height:75px;
    border-radius:50%;

    background:linear-gradient(135deg,#0d6efd,#4dabf7);

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

    font-size:28px;

    font-weight:bold;

}

.badge-custom{

    padding:10px 18px;

    border-radius:30px;

    font-size:14px;

}

.card-box{

    background:#fff;

    border-radius:20px;

    box-shadow:0 .3rem .8rem rgba(0,0,0,.07);

    padding:25px;

    margin-bottom:25px;

}

.btn{

    border-radius:12px;

}

</style>

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">

<i class="bi bi-ticket-detailed-fill text-primary"></i>

Detail Tiket

</h2>

<div class="text-muted">

Kelola informasi tiket dan proses penanganannya.

</div>

</div>

<a href="{{ route('admin.ticket.index') }}"
class="btn btn-outline-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

</div>

@if(session('success'))

<div class="alert alert-success shadow-sm">

<i class="bi bi-check-circle-fill"></i>

{{ session('success') }}

</div>

@endif

<div class="card main-card">

<div class="card-body p-4">

<div class="row">

<div class="col-lg-8">

<div class="card-box">

<div class="section-title mb-4">

<i class="bi bi-info-circle-fill text-primary"></i>

Informasi Tiket

</div>

<div class="row">

<div class="col-md-6 mb-4">

<div class="info-title">

Kode Ticket

</div>

<div class="info-value">

{{ $ticket->kode_ticket }}

</div>

</div>

<div class="col-md-6 mb-4">

<div class="info-title">

Layanan

</div>

<div class="info-value">

{{ $ticket->service->nama_layanan }}

</div>

</div>

<div class="col-md-12 mb-4">

<div class="info-title">

Judul

</div>

<div class="info-value">

{{ $ticket->judul }}

</div>

</div>

<div class="col-md-12">

<div class="info-title mb-2">

Deskripsi

</div>

<div class="border rounded-4 p-3 bg-light">

{{ $ticket->deskripsi }}

</div>

</div>

</div>

</div>

<div class="card-box">

<div class="section-title mb-4">

<i class="bi bi-paperclip text-primary"></i>

Lampiran

</div>

@if($ticket->attachments->count())

<div class="row">

@foreach($ticket->attachments as $file)

<div class="col-md-6 mb-3">

<a href="{{ asset('storage/'.$file->path_file) }}"
target="_blank"
class="btn btn-outline-primary w-100 py-3">

<i class="bi bi-image-fill me-2"></i>

Lihat Lampiran

</a>

</div>

@endforeach

</div>

@else

<div class="text-center text-muted py-3">

<i class="bi bi-folder2-open display-6"></i>

<p class="mt-2 mb-0">

Tidak ada lampiran.

</p>

</div>

@endif

</div>

</div>

<div class="col-lg-4">

<div class="card-box text-center">

<div class="avatar mx-auto mb-3">

{{ strtoupper(substr($ticket->user->name,0,1)) }}

</div>

<h4>

{{ $ticket->user->name }}

</h4>

<p class="text-muted">

{{ $ticket->user->email }}

</p>

<hr>

@if($ticket->status=='To Do')

<span class="badge bg-warning text-dark badge-custom">

To Do

</span>

@elseif($ticket->status=='In Progress')

<span class="badge bg-info badge-custom">

In Progress

</span>

@else

<span class="badge bg-success badge-custom">

Completed

</span>

@endif

<br><br>

@if($ticket->prioritas=='Tinggi')

<span class="badge bg-danger badge-custom">

Tinggi

</span>

@elseif($ticket->prioritas=='Sedang')

<span class="badge bg-warning text-dark badge-custom">

Sedang

</span>

@else

<span class="badge bg-success badge-custom">

Rendah

</span>

@endif

</div>
<div class="card-box">

    <div class="section-title mb-4">

        <i class="bi bi-sliders text-primary me-2"></i>

        Manajemen Tiket

    </div>

    <form action="{{ route('admin.ticket.update',$ticket->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Status Tiket

                </label>

                <select
                    name="status"
                    class="form-select form-select-lg">

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

            <div class="col-md-6 mb-4">

                <label class="form-label fw-bold">

                    Prioritas

                </label>

                <select
                    name="prioritas"
                    class="form-select form-select-lg">

                    <option value="Rendah"
                        {{ $ticket->prioritas=='Rendah' ? 'selected' : '' }}>

                        Rendah

                    </option>

                    <option value="Sedang"
                        {{ $ticket->prioritas=='Sedang' ? 'selected' : '' }}>

                        Sedang

                    </option>

                    <option value="Tinggi"
                        {{ $ticket->prioritas=='Tinggi' ? 'selected' : '' }}>

                        Tinggi

                    </option>

                </select>

            </div>

        </div>

        <div class="d-grid">

            <button
                class="btn btn-success btn-lg shadow">

                <i class="bi bi-check-circle-fill me-2"></i>

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>
<div class="card-box">

    <div class="section-title mb-4">

        <i class="bi bi-person-workspace text-primary me-2"></i>

        Assign Staff

    </div>

    <form action="{{ route('admin.ticket.assign',$ticket->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="form-label fw-bold">

                Pilih Staff

            </label>

            <select
                name="staff_id"
                class="form-select form-select-lg">

                <option value="">

                    -- Pilih Staff --

                </option>

                @foreach($staffs as $staff)

                    <option
                        value="{{ $staff->id }}"
                        {{ $ticket->staff_id == $staff->id ? 'selected' : '' }}>

                        {{ $staff->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="d-grid gap-2">

            <button
                class="btn btn-primary btn-lg shadow">

                <i class="bi bi-person-check-fill me-2"></i>

                Assign Staff

            </button>

            <a href="{{ route('admin.ticket.index') }}"
               class="btn btn-outline-secondary btn-lg">

                <i class="bi bi-arrow-left-circle me-2"></i>

                Kembali ke Daftar Tiket

            </a>

        </div>

    </form>

</div>

</div>

</div>

</div>

</div>

@endsection