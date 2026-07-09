@extends('layouts.staff')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-kanban-fill text-primary"></i>
                Kanban Board
            </h2>
            <small class="text-muted">
                Kelola status tiket dengan drag & drop
            </small>
        </div>

        <a href="{{ route('staff.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

    </div>

    {{-- Search --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <form action="{{ route('staff.kanban') }}" method="GET">

                <div class="row g-3">

                    <div class="col-lg-6">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari kode tiket, judul, atau pelapor..."
                            value="{{ $search ?? '' }}">
                    </div>

                    <div class="col-lg-3">
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>

                            <option value="To Do"
                                {{ request('status')=='To Do' ? 'selected' : '' }}>
                                To Do
                            </option>

                            <option value="In Progress"
                                {{ request('status')=='In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="Completed"
                                {{ request('status')=='Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>
                    </div>

                    <div class="col-lg-3 d-grid">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Kolom Kanban --}}
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

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-{{ $column['color'] }} {{ $column['color']=='warning' ? '' : 'text-white' }}">

                    <strong>
                        <i class="bi {{ $column['icon'] }}"></i>
                        {{ $column['title'] }}
                        ({{ $column['data']->count() }})
                    </strong>

                </div>

                <div
                    class="card-body ticket-column bg-light"
                    data-status="{{ $column['status'] }}"
                    style="min-height:650px">

                    @forelse($column['data'] as $ticket)

                    <div
                        class="card mb-3 shadow-sm ticket-card"
                        data-id="{{ $ticket->id }}"
                        style="cursor:grab;border-radius:12px;">

                        <div class="card-body">

                            <h6 class="fw-bold mb-1">
                                {{ $ticket->judul }}
                            </h6>

                            <small class="text-muted">
                                {{ $ticket->kode_ticket }}
                            </small>

                            <hr>

                            <div class="mb-2">
                                <small class="text-muted">Pelapor</small><br>
                                <strong>{{ $ticket->user->name }}</strong>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted">Layanan</small><br>
                                {{ $ticket->service->nama_layanan }}
                            </div>

                            <div class="mb-2">

                                @if($ticket->prioritas=='Tinggi')

                                <span class="badge bg-danger">
                                    Tinggi
                                </span>

                                @elseif($ticket->prioritas=='Sedang')

                                <span class="badge bg-warning text-dark">
                                    Sedang
                                </span>

                                @else

                                <span class="badge bg-success">
                                    Rendah
                                </span>

                                @endif

                            </div>

                            <small class="text-muted d-block mb-3">
                                {{ $ticket->created_at->diffForHumans() }}
                            </small>

                            <div class="d-grid">

                                <a
                                    href="{{ route('staff.ticket.show',$ticket->id) }}"
                                    class="btn btn-primary btn-sm">

                                    <i class="bi bi-eye"></i>
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

</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.ticket-column').forEach(column => {

    new Sortable(column, {
        group: 'tickets',
        animation: 200,

        onEnd: function(evt) {

            let ticketId = evt.item.dataset.id;
            let status = evt.to.dataset.status;

            fetch("{{ url('staff/ticket') }}/" + ticketId + "/status", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {

                    let kode = evt.item.querySelector("small").innerText;
                    let judul = evt.item.querySelector("h6").innerText;

                    Swal.fire({
                        icon: "success",
                        title: "Status Berhasil Diubah",
                        html: `
                            <b>${kode}</b><br>
                            ${judul}<br><br>
                            Berhasil dipindahkan ke <b>${status}</b>
                        `,
                        timer: 1800,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });

                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Status tiket gagal diperbarui."
                    });

                }

            })
            .catch(err => {
                console.error(err);

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Terjadi kesalahan saat memperbarui status."
                });
            });

        }

    });

});
</script>

@endsection