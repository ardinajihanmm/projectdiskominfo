@extends('layouts.staff')

@section('title', 'Kanban Board')

@section('content')

<style>

.ticket-card{
    cursor:grab;
    border-radius:12px;
    transition:.2s;
}

.ticket-card:active{
    cursor: grabbing;
}

.ticket-card:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(0,0,0,.12);
}

.ticket-column{
    height:650px;
    overflow-y:auto;
}

.ticket-drawer{
    position:fixed;
    top:0;
    right:-420px;
    width:400px;
    height:100vh;
    background:#fff;
    box-shadow:-8px 0 25px rgba(0,0,0,.15);
    transition:.3s;
    z-index:9999;
    overflow-y:auto;
}

.ticket-drawer.show{
    right:0;
}

.drawer-header{
    padding:20px;
    border-bottom:1px solid #eee;
}

.drawer-body{
    padding:20px;
}

.drawer-label{
    font-size:13px;
    color:#6c757d;
    margin-bottom:3px;
}

.drawer-value{
    font-weight:600;
    margin-bottom:15px;
}

#drawerOverlay{

    position:fixed;

    inset:0;

    background:rgba(0,0,0,.25);

    opacity:0;

    visibility:hidden;

    transition:.25s;

    z-index:9998;

}

#drawerOverlay.show{

    opacity:1;

    visibility:visible;

}

.ticket-drawer{

    border-top-left-radius:18px;

    border-bottom-left-radius:18px;

}

.drawer-label{

    font-size:12px;

    color:#8b8b8b;

    text-transform:uppercase;

    letter-spacing:.5px;

}

.drawer-value{

    font-size:15px;

    font-weight:600;

}

.filter-month{
    height:48px;
    border-radius:14px;
    border:1px solid #dbe2ef;
    background:#fff;
    padding:0 16px;
    font-size:15px;
    font-weight:500;
    color:#374151;
    box-shadow:0 2px 8px rgba(0,0,0,.05);
    transition:.25s;
}

.filter-month:hover{
    border-color:#3b82f6;
}

.filter-month:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 .2rem rgba(37,99,235,.15);
}

.filter-month{
    height:48px;
    border-radius:14px;
    border:1px solid #dbe2ef;
    background:#fff;
    padding:0 15px;
    font-weight:500;
}

.flatpickr-calendar{
    border:none;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

.flatpickr-months{
    background:#0d6efd;
    color:white;
}

.flatpickr-current-month input.cur-year{
    color:white;
}

.flatpickr-monthDropdown-months{
    color:white;
}

.flatpickr-monthSelect-month{
    border-radius:10px;
    transition:.2s;
}

.flatpickr-monthSelect-month:hover{
    background:#0d6efd;
    color:white;
}

.flatpickr-monthSelect-month.selected{
    background:#0d6efd;
    color:white;
}

</style>

<div class="container-fluid">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
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

                    {{-- Search Judul --}}
                    <div class="col-lg-8">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari judul tiket..."
                            value="{{ request('search') }}">

                    </div>

                    {{-- Filter Bulan --}}
                    <div class="col-lg-2">
                        <input
                            type="text"
                            id="monthPicker"
                            name="month"
                            class="form-control filter-month"
                            value="{{ request('month', now()->format('Y-m')) }}"
                            autocomplete="off">
                        </div>

                    {{-- Tombol --}}
                    <div class="col-lg-2 d-grid">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                     </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Kanban --}}
    <div class="row">

        @php

        $columns = [

            [
                'title'=>'To Do',
                'status'=>'To Do',
                'icon'=>'bi-list-task',
                'data'=>$todo
            ],

            [
                'title'=>'In Progress',
                'status'=>'In Progress',
                'icon'=>'bi-arrow-repeat',
                'data'=>$progress
            ],

            [
                'title'=>'Completed',
                'status'=>'Completed',
                'icon'=>'bi-check-circle-fill',
                'data'=>$completed
            ]

        ];

        @endphp

        @foreach($columns as $column)

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header
                    {{ $column['status']=='To Do'
                        ? 'todo-header'
                        : ($column['status']=='In Progress'
                            ? 'progress-header'
                            : 'done-header') }}">

                    <strong>

                        <i class="bi {{ $column['icon'] }}"></i>

                        {{ $column['title'] }}

                        ({{ $column['data']->count() }})

                    </strong>

                </div>

                <div
                    class="card-body bg-light ticket-column"
                    data-status="{{ $column['status'] }}">

                    @foreach($column['data'] as $ticket)

                    <div
    class="ticket-card card shadow-sm mb-2"
    data-id="{{ $ticket->id }}"
    data-kode="{{ $ticket->kode_ticket }}"
    data-judul="{{ $ticket->judul }}"
    data-pelapor="{{ $ticket->user->name }}"
    data-layanan="{{ $ticket->service->nama_layanan }}"
    data-prioritas="{{ $ticket->prioritas }}"
    data-status="{{ $ticket->status }}"
    data-created="{{ $ticket->created_at->format('d M Y H:i') }}"
    data-url="{{ route('staff.ticket.show',$ticket->id) }}"
    data-assign-url="{{ route('staff.ticket.assign',$ticket->id) }}"
    data-staff-id="{{ $ticket->staff_id }}"
    data-staff-name="{{ $ticket->staff->name ?? '' }}">

                        <div class="card-body p-2">

                            <div class="fw-semibold">

                                {{ $ticket->judul }}

                            </div>

                            <div class="small text-muted">

                                {{ $ticket->service->nama_layanan }}

                            </div>

                           <div class="mt-2 d-flex flex-wrap gap-1">
    @if($ticket->prioritas=="Tinggi")
        <span class="badge bg-danger">Tinggi</span>
    @elseif($ticket->prioritas=="Sedang")
        <span class="badge bg-warning text-dark">Sedang</span>
    @else
        <span class="badge bg-success">Rendah</span>
    @endif

    @if($ticket->staff_id)
        <span class="badge bg-primary-subtle text-primary">
            <i class="bi bi-person-check"></i> {{ $ticket->staff->name ?? 'Anda' }}
        </span>
    @else
        <span class="badge bg-secondary">Belum diambil</span>
    @endif
</div>
                        </div>

                    </div>

                    @endforeach

                        <div class="empty-ticket text-center text-muted py-5" style="display:none;">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <strong>Belum ada tiket</strong>
                        </div>
                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>
<div id="drawerOverlay"></div>

<div id="ticketDrawer" class="ticket-drawer">

<div class="drawer-header">

    <div class="d-flex justify-content-between">

        <div>

            <small class="text-muted"
                id="drawerKode">
            </small>

            <h4
                class="mt-2 fw-bold"
                id="drawerJudul">
            </h4>

        </div>

        <button
            class="btn-close"
            id="closeDrawer">
        </button>

    </div>

</div>

<div class="drawer-body">

    <div class="mb-3">

        <span id="drawerPrioritas"></span>

        <span
            id="drawerStatus"
            class="badge bg-primary ms-2">
        </span>

    </div>

    <div class="mb-4">

        <div class="drawer-label">
            Pelapor
        </div>

        <div class="drawer-value" id="drawerPelapor"></div>

    </div>

    <div class="mb-4">

        <div class="drawer-label">
            Layanan
        </div>

        <div class="drawer-value" id="drawerLayanan"></div>

    </div>

    <div class="mb-4">

        <div class="drawer-label">
            Dibuat
        </div>

        <div class="drawer-value" id="drawerTanggal"></div>

    </div>
<div class="mb-4">
    <div class="drawer-label">Ditangani</div>
    <div class="drawer-value" id="drawerStaff"></div>
</div>
    <hr>

    <div class="text-muted small mb-3">

        Ringkasan tiket.

        Klik tombol di bawah untuk melihat informasi lengkap,
        riwayat, komentar, dan lampiran.

    </div>
<button id="drawerAssignBtn" class="btn btn-outline-primary w-100 mb-2" style="display:none;">
    <i class="bi bi-hand-index-thumb"></i> Ambil Tiket Ini
</button>
    <a
        
        id="drawerDetailBtn"
        class="btn btn-primary w-100">

        <i class="bi bi-eye"></i>

        Lihat Selengkapnya

    </a>

</div>

</div>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function updateEmptyState(){

    document.querySelectorAll(".ticket-column").forEach(column=>{

        const cards = column.querySelectorAll(".ticket-card");
        const empty = column.querySelector(".empty-ticket");

        if(cards.length===0){

            empty.style.display="block";

        }else{

            empty.style.display="none";

        }

    });

}

// ==============================
// DRAG & DROP
// ==============================

document.querySelectorAll(".ticket-column").forEach(column => {

    new Sortable(column, {

        group: "tickets",
        animation: 200,

        onEnd: function (evt) {

            const ticketId = evt.item.dataset.id;
            const status = evt.to.dataset.status;

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

                if(data.success){

                updateEmptyState();

                    Swal.fire({

                        icon:"success",
                        title:"Status berhasil diperbarui",
                        timer:1200,
                        showConfirmButton:false

                    });

                }else{

                    Swal.fire({

                        icon:"error",
                        title:"Gagal",
                        text:"Status tiket gagal diperbarui."

                    });

                }

            })

            .catch(err=>{

                console.log(err);

                Swal.fire({

                    icon:"error",
                    title:"Oops...",
                    text:"Terjadi kesalahan."

                });

            });

        }

    });

});


// ==============================
// DRAWER
// ==============================

const drawer = document.getElementById("ticketDrawer");

const drawerJudul = document.getElementById("drawerJudul");
const drawerKode = document.getElementById("drawerKode");
const drawerPelapor = document.getElementById("drawerPelapor");
const drawerLayanan = document.getElementById("drawerLayanan");
const drawerStatus = document.getElementById("drawerStatus");
const drawerPrioritas = document.getElementById("drawerPrioritas");
const drawerTanggal = document.getElementById("drawerTanggal");
const drawerDetailBtn = document.getElementById("drawerDetailBtn");
const overlay = document.getElementById("drawerOverlay");
const drawerStaff = document.getElementById("drawerStaff");
const drawerAssignBtn = document.getElementById("drawerAssignBtn");


// klik card

document.querySelectorAll(".ticket-card").forEach(card=>{

    card.addEventListener("click",function(e){

        // kalau sedang drag jangan buka drawer
        if(this.classList.contains("sortable-chosen") ||
           this.classList.contains("sortable-ghost")){
            return;
        }

        drawer.classList.add("show");
        overlay.classList.add("show");

        drawerJudul.innerText = this.dataset.judul;
        drawerKode.innerText = this.dataset.kode;
        drawerPelapor.innerText = this.dataset.pelapor;
        drawerLayanan.innerText = this.dataset.layanan;
        drawerStatus.innerText = this.dataset.status;
        drawerTanggal.innerText = this.dataset.created;

        if (this.dataset.staffId) {
    drawerStaff.innerText = this.dataset.staffName || "Anda";
    drawerAssignBtn.style.display = "none";
} else {
    drawerStaff.innerText = "Belum diambil";
    drawerAssignBtn.style.display = "block";
}
drawerAssignBtn.dataset.assignUrl = this.dataset.assignUrl;

        if(this.dataset.prioritas=="Tinggi"){

            drawerPrioritas.innerHTML =
            '<span class="badge bg-danger">Tinggi</span>';

        }

        else if(this.dataset.prioritas=="Sedang"){

            drawerPrioritas.innerHTML =
            '<span class="badge bg-warning text-dark">Sedang</span>';

        }

        else{

            drawerPrioritas.innerHTML =
            '<span class="badge bg-success">Rendah</span>';

        }

        drawerDetailBtn.href = this.dataset.url;

    });

});


// ==============================
// CLOSE DRAWER
// ==============================


// klik luar drawer = tutup

// Tombol X
// Tombol X
document.getElementById("closeDrawer").addEventListener("click", function () {
    drawer.classList.remove("show");
    overlay.classList.remove("show");
});

overlay.addEventListener("click", function () {
    drawer.classList.remove("show");
    overlay.classList.remove("show");
});
// AMBIL TIKET (SELF ASSIGN)
drawerAssignBtn.addEventListener("click", function () {
    const url = this.dataset.assignUrl;
    if (!url) return;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(res => {
        if (res.redirected) { window.location.reload(); return; }
        return res.json();
    })
    .then(() => {
        Swal.fire({ icon: "success", title: "Tiket berhasil diambil", timer: 1200, showConfirmButton: false })
            .then(() => window.location.reload());
    })
    .catch(() => window.location.reload());
});

flatpickr("#monthPicker", {

    plugins: [
        new monthSelectPlugin({
            shorthand: true,
            dateFormat: "Y-m",
            altFormat: "F Y"
        })
    ],

    altInput: true,
    altFormat: "F Y",
    dateFormat: "Y-m",

    allowInput: false

});

updateEmptyState();

</script>

@endsection