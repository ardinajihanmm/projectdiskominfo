@extends('layouts.staff')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            <i class="bi bi-kanban-fill"></i>
            Kanban Board
        </h2>
        <small class="text-muted">
            Kelola status tiket dengan drag & drop
        </small>
    </div>
<form action="{{ route('staff.kanban') }}" method="GET" class="mb-4">

    <div class="input-group">

        <span class="input-group-text bg-primary text-white">
            <i class="bi bi-search"></i>
        </span>

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari kode tiket, judul, atau nama pelapor..."
            value="{{ $search ?? '' }}">

        <button class="btn btn-primary">
            Cari
        </button>

        @if(!empty($search))
            <a href="{{ route('staff.kanban') }}"
               class="btn btn-outline-secondary">
                Reset
            </a>
        @endif

    </div>

</form>
    <a href="{{ route('staff.dashboard') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Dashboard
    </a>

</div>

<div class="row">

@php

$columns = [

[
'title'=>'To Do',
'status'=>'To Do',
'color'=>'warning',
'icon'=>'bi-list-task',
'data'=>$todo
],

[
'title'=>'In Progress',
'status'=>'In Progress',
'color'=>'info',
'icon'=>'bi-arrow-repeat',
'data'=>$progress
],

[
'title'=>'Completed',
'status'=>'Completed',
'color'=>'success',
'icon'=>'bi-check-circle-fill',
'data'=>$completed
]

];

@endphp

@foreach($columns as $column)

<div class="col-lg-4 mb-4">

<div class="card shadow">

<div class="card-header bg-{{ $column['color'] }} {{ $column['color']=='warning' ? '' : 'text-white' }}">

<strong>

<i class="bi {{ $column['icon'] }}"></i>

{{ $column['title'] }}

({{ $column['data']->count() }})

</strong>

</div>

<div
class="card-body ticket-column"
data-status="{{ $column['status'] }}"
style="min-height:600px">

@forelse($column['data'] as $ticket)

<div
class="card mb-3 shadow-sm ticket-card"
data-id="{{ $ticket->id }}"
style="cursor:move">

<div class="card-body">

<h6 class="fw-bold">

{{ $ticket->judul }}

</h6>

<small class="text-muted">

{{ $ticket->kode_ticket }}

</small>

<hr>

<p class="mb-2">

<strong>Pelapor</strong><br>

{{ $ticket->user->name }}

</p>

<p class="mb-2">

<strong>Layanan</strong><br>

{{ $ticket->service->nama_layanan }}

</p>

<p class="mb-2">

<strong>Prioritas</strong><br>

@if($ticket->prioritas=='Tinggi')

<span class="badge bg-danger">Tinggi</span>

@elseif($ticket->prioritas=='Sedang')

<span class="badge bg-warning text-dark">Sedang</span>

@else

<span class="badge bg-success">Rendah</span>

@endif

</p>

<p class="mb-2">

<strong>Dibuat</strong><br>

{{ $ticket->created_at->diffForHumans() }}

</p>

<div class="d-grid">

<a
href="{{ route('staff.ticket.show',$ticket->id) }}"
class="btn btn-primary btn-sm">

<i class="bi bi-eye-fill"></i>

Detail Tiket

</a>

</div>

</div>

</div>

@empty

<div class="alert alert-light text-center">

Belum ada tiket.

</div>

@endforelse

</div>

</div>

</div>

@endforeach

</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
document.querySelectorAll('.ticket-column').forEach(column => {

    new Sortable(column, {
        group: 'tickets',
        animation: 200,
        ghostClass: 'bg-light',

        onEnd: function (evt) {

            let ticketId = evt.item.dataset.id;
            let status = evt.to.dataset.status;

            fetch('/staff/ticket/' + ticketId + '/status', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {

                if(data.success){
                    location.reload();
                }else{
                    alert(data.message);
                    location.reload();
                }

            })
            .catch(error => {
                console.log(error);
                alert('Terjadi kesalahan');
                location.reload();
            });

        }

    });

});
</script>

@endsection