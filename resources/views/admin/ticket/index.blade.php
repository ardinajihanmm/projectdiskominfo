@extends('layouts.admin')

@section('title', 'Kelola Tiket')

@section('content')
<style>

body{
    background:#f5f7fb;
}

/* Header */

.page-title{
    font-size:32px;
    font-weight:700;
    color:#2c3e50;
}

.page-subtitle{
    color:#6c757d;
}

/* Card */

.main-card{
    border:none;
    border-radius:22px;
    box-shadow:0 .5rem 1rem rgba(0,0,0,.08);
}

/* Filter */

.filter-box{

    background:#fff;

    border-radius:20px;

    padding:25px;

    box-shadow:0 .5rem 1rem rgba(0,0,0,.07);

}

/* Form */

.form-control,
.form-select{

    border-radius:14px;
    height:48px;

}

.form-control:focus,
.form-select:focus{

    box-shadow:0 0 0 .15rem rgba(13,110,253,.15);

}

/* Button */

.btn{

    border-radius:14px;

}

.btn-export{

    padding:10px 18px;

    font-weight:600;

}

/* Table */

.table{

    margin-bottom:0;

}

.table thead{

    background:#0d6efd;
    color:white;

}

.table thead th{

    border:none;
    padding:16px;

}

.table tbody td{

    vertical-align:middle;
    padding:16px;

}

.table tbody tr{

    transition:.25s;

}

.table tbody tr:hover{

    background:#eef5ff;
    transform:scale(1.003);

}

/* Badge */

.badge{

    padding:8px 14px;
    border-radius:30px;
    font-weight:600;

}

</style>

<div class="container-fluid py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="page-title">

<i class="bi bi-ticket-perforated-fill text-primary"></i>

Kelola Tiket

</h2>

<div class="page-subtitle">

Kelola seluruh tiket Helpdesk Diskominfo.

</div>

</div>

<div>

<a href="{{ route('admin.ticket.export.pdf') }}"
class="btn btn-danger btn-export shadow-sm me-2">

<i class="bi bi-file-earmark-pdf-fill"></i>

Export PDF

</a>

<a href="{{ route('admin.ticket.export.excel') }}"
class="btn btn-success btn-export shadow-sm">

<i class="bi bi-file-earmark-excel-fill"></i>

Export Excel

</a>

</div>

</div>

<div class="filter-box mb-4">

<form method="GET"
action="{{ route('admin.ticket.index') }}">

<div class="row g-3 align-items-end">

<div class="col-lg-4">

<label class="form-label fw-semibold">

Cari Tiket

</label>

<div class="input-group">

<span class="input-group-text bg-white">

<i class="bi bi-search"></i>

</span>

<input
type="text"
name="search"
class="form-control border-start-0"
placeholder="Cari judul atau user..."
value="{{ request('search') }}">

</div>

</div>

<div class="col-lg-3">

<label class="form-label fw-semibold">

Status

</label>

<select
name="status"
class="form-select">

<option value="">Semua Status</option>

<option value="To Do"
{{ request('status')=='To Do'?'selected':'' }}>

To Do

</option>

<option value="In Progress"
{{ request('status')=='In Progress'?'selected':'' }}>

In Progress

</option>

<option value="Completed"
{{ request('status')=='Completed'?'selected':'' }}>

Completed

</option>

</select>

</div>

<div class="col-lg-3">

<label class="form-label fw-semibold">

Prioritas

</label>

<select
name="prioritas"
class="form-select">

<option value="">Semua Prioritas</option>

<option value="High"
{{ request('prioritas')=='High'?'selected':'' }}>

Tinggi

</option>

<option value="Medium"
{{ request('prioritas')=='Medium'?'selected':'' }}>

Sedang

</option>

<option value="Low"
{{ request('prioritas')=='Low'?'selected':'' }}>

Rendah

</option>

</select>

</div>

<div class="col-lg-2 d-grid">

<button
class="btn btn-primary py-3">

<i class="bi bi-funnel-fill"></i>

Filter

</button>

</div>

</div>

</form>

</div>

<div class="card main-card">

<div class="card-body p-0">

<div class="table-responsive">

<table class="table align-middle">

<thead>

<tr>

<th width="70">

No

</th>

<th>

User

</th>

<th>

Judul Tiket

</th>

<th width="170">

Status

</th>

<th width="170">

Prioritas

</th>

<th width="160">

Aksi

</th>

</tr>

</thead>

<tbody>
<tbody>

@forelse($tickets as $ticket)

<tr>

    <td>
        <span class="fw-bold text-primary">
            #{{ $loop->iteration }}
        </span>
    </td>

    <td>

        <div class="d-flex align-items-center">

            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                 style="width:45px;height:45px;font-weight:600;">

                {{ strtoupper(substr($ticket->user->name,0,1)) }}

            </div>

            <div>

                <div class="fw-semibold">

                    {{ $ticket->user->name }}

                </div>

                <small class="text-muted">

                    Pelapor

                </small>

            </div>

        </div>

    </td>

    <td>

        <div class="fw-semibold">

            {{ $ticket->judul }}

        </div>

        <small class="text-muted">

            Ticket Helpdesk

        </small>

    </td>





    {{-- STATUS --}}

    <td>

        @if($ticket->status == 'To Do')

            <span class="badge bg-warning text-dark px-3 py-2">

                <i class="bi bi-hourglass-split me-1"></i>

                To Do

            </span>

        @elseif($ticket->status == 'In Progress')

            <span class="badge bg-info px-3 py-2">

                <i class="bi bi-arrow-repeat me-1"></i>

                In Progress

            </span>

        @else

            <span class="badge bg-success px-3 py-2">

                <i class="bi bi-check-circle-fill me-1"></i>

                Completed

            </span>

        @endif

    </td>





    {{-- PRIORITAS --}}

    <td>

        @if($ticket->prioritas == 'Tinggi')

            <span class="badge bg-danger px-3 py-2">

                🔥 Tinggi

            </span>

        @elseif($ticket->prioritas == 'Sedang')

            <span class="badge bg-warning text-dark px-3 py-2">

                ⚡ Sedang

            </span>

        @elseif($ticket->prioritas == 'Rendah')

            <span class="badge bg-success px-3 py-2">

                🌿 Rendah

            </span>

        @else

            <span class="badge bg-secondary px-3 py-2">

                -

            </span>

        @endif

    </td>





    {{-- AKSI --}}

    <td>

        <a href="{{ route('admin.ticket.show',$ticket->id) }}"
           class="btn btn-primary rounded-pill shadow-sm">

            <i class="bi bi-eye-fill"></i>

            View

        </a>

    </td>

</tr>

@empty

<tr>

<td colspan="6">

<div class="text-center py-5">

<i class="bi bi-inbox display-1 text-secondary"></i>

<h4 class="mt-3">

Belum Ada Tiket

</h4>

<p class="text-muted">

Saat ini belum ada tiket yang masuk.

</p>

</div>

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

<div class="d-flex justify-content-between align-items-center mt-4">

<div class="text-muted">

Menampilkan

<strong>

{{ $tickets->count() }}

</strong>

data tiket

</div>

<div>

{{ $tickets->links() }}

</div>

</div>

</div>

@endsection