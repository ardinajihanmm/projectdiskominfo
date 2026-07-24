@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')

<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-grid-fill text-primary me-2"></i>
                        Kelola Layanan
                    </h2>
                    <p class="text-muted mb-0">
                        Kelola seluruh data layanan Helpdesk Pemkab Pemalang
                    </p>
                </div>
                <div class="d-flex gap-2 mt-3 mt-md-0">
                    <a href="{{ route('admin.dashboard') }}"
                       class="btn btn-light border rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.service.create') }}"
                       class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-plus-circle-fill me-1"></i>
                        Tambah Layanan
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Search --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.service.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-lg-10">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-primary"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Cari nama layanan..."
                                value="{{ $search ?? '' }}">
                        </div>
                    </div>
                    <div class="col-lg-2 d-grid">
                        <button class="btn btn-primary rounded-pill">
                            <i class="bi bi-search me-1"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data --}}
    <div class="card border-0 shadow rounded-4">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-list-ul text-primary me-2"></i>
                    Data Layanan
                </h5>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    {{ $services->total() }} Layanan
                </span>
            </div>
        </div>
        <div class="card-body p-0">
    <div class="table-responsive d-none d-md-block">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="70">No</th>
                    <th>Bidang</th>
                    <th>Nama Layanan</th>
                    <th width="120">SLA</th>
                    <th width="120">Status</th>
                    <th width="170" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
@forelse($services as $service)
<tr class="service-row">
    <td class="fw-bold text-primary">{{ $loop->iteration }}</td>
    <td>
        <div class="d-flex align-items-center">
            <div class="service-icon me-3">
                <i class="bi bi-diagram-3-fill"></i>
            </div>
            <div>
                <div class="fw-semibold">{{ $service->department->nama_bidang ?? '-' }}</div>
                <small class="text-muted">Bidang Layanan</small>
            </div>
        </div>
    </td>
    <td>
        <div class="fw-bold fs-6">{{ $service->nama_layanan }}</div>
        <small class="text-muted">Helpdesk Diskominfo</small>
    </td>
    <td>
        <span class="badge bg-info-subtle text-info border rounded-pill px-3 py-2">
            <i class="bi bi-clock-history me-1"></i> {{ $service->sla }} Jam
        </span>
    </td>
    <td>
        @if($service->status)
            <span class="badge bg-success rounded-pill px-3 py-2">
                <i class="bi bi-check-circle-fill me-1"></i> Aktif
            </span>
        @else
            <span class="badge bg-danger rounded-pill px-3 py-2">
                <i class="bi bi-x-circle-fill me-1"></i> Nonaktif
            </span>
        @endif
    </td>
    <td>
        <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('admin.service.edit',$service->id) }}"
               class="btn btn-warning btn-sm rounded-circle action-btn"
               data-bs-toggle="tooltip" title="Edit">
                <i class="bi bi-pencil-fill"></i>
            </a>
            <form action="{{ route('admin.service.destroy',$service->id) }}" method="POST"
                  onsubmit="return confirm('Hapus layanan ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm rounded-circle action-btn"
                        data-bs-toggle="tooltip" title="Hapus">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6">
        <div class="text-center py-5">
            <i class="bi bi-inbox display-3 text-secondary"></i>
            <h5 class="mt-3 fw-bold">Belum Ada Data Layanan</h5>
            <p class="text-muted">Klik tombol <b>Tambah Layanan</b> untuk menambahkan layanan baru.</p>
        </div>
    </td>
</tr>
@endforelse
            </tbody>
        </table>
    </div>
    <div class="d-md-none p-3">
        @forelse($services as $service)
        <div class="service-card-mobile">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1">
                    #{{ $loop->iteration }}
                </span>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.service.edit',$service->id) }}"
                       class="btn btn-warning btn-sm rounded-circle action-btn">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <form action="{{ route('admin.service.destroy',$service->id) }}" method="POST"
                          onsubmit="return confirm('Hapus layanan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm rounded-circle action-btn">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <div class="service-icon me-3">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div>
                    <div class="fw-bold fs-6">{{ $service->nama_layanan }}</div>
                    <small class="text-muted">{{ $service->department->nama_bidang ?? '-' }}</small>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-info-subtle text-info border rounded-pill px-3 py-2">
                    <i class="bi bi-clock-history me-1"></i> {{ $service->sla }} Jam
                </span>

                @if($service->status)
                    <span class="badge bg-success rounded-pill px-3 py-2">
                        <i class="bi bi-check-circle-fill me-1"></i> Aktif
                    </span>
                @else
                    <span class="badge bg-danger rounded-pill px-3 py-2">
                        <i class="bi bi-x-circle-fill me-1"></i> Nonaktif
                    </span>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <i class="bi bi-inbox display-3 text-secondary"></i>
            <h5 class="mt-3 fw-bold">Belum Ada Data Layanan</h5>
            <p class="text-muted">Klik tombol <b>Tambah Layanan</b> untuk menambahkan layanan baru.</p>
        </div>
        @endforelse
    </div>
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <small class="text-muted">
                    Menampilkan
                    <strong>{{ $services->count() }}</strong>
                    dari
                    <strong>{{ $services->total() }}</strong>
                    layanan.
                </small>
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
<style>
.card{
    border-radius:22px;
}
.table thead{
    background:#0d6efd;
}
.table thead th{
    background:#F8FAFC !important;
    color:#475569;
    border:none;
    border-bottom:2px solid #E2E8F0;
    padding:16px 18px;
    font-size:12.5px;
    text-transform:uppercase;
    letter-spacing:.6px;
    font-weight:700;
}
.table tbody td{
    padding:18px;
    vertical-align:middle;
}
.service-row{
    transition:.25s ease;
}
.service-row:hover{
    background:#f8fbff;
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(0,0,0,.05);
}
.service-icon{
    width:48px;
    height:48px;
    border-radius:14px;
    background:linear-gradient(135deg,#0d6efd,#4f8cff);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    box-shadow:0 10px 18px rgba(13,110,253,.25);
}
.action-btn{
    width:42px;
    height:42px;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.25s;
}
.action-btn:hover{
    transform:translateY(-3px) scale(1.05);
}
.service-card-mobile{
    border:1px solid #eef1f5;
    border-radius:18px;
    padding:16px;
    margin-bottom:14px;
    transition:.2s;
}
.service-card-mobile:hover{
    box-shadow:0 10px 22px rgba(0,0,0,.06);
}
.service-card-mobile:last-child{
    margin-bottom:0;
}
.input-group-text{

    border-radius:14px 0 0 14px;

}
.form-control{
    height:48px;
    border-radius:0 14px 14px 0;
}
.btn-primary{
    border-radius:14px;
}
.btn-light{
    border-radius:14px;
}
.badge{
    font-weight:600;
    letter-spacing:.3px;
}
.pagination{
    margin-bottom:0;
}
.page-link{
    border:none;
    margin:0 4px;
    border-radius:10px !important;
    color:#0d6efd;
}
.page-item.active .page-link{
    background:#0d6efd;
    color:white;
}
.page-link:hover{
    background:#e9f2ff;
}
</style>
<script>
document.addEventListener("DOMContentLoaded",function(){
    const tooltipTriggerList=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el){
        return new bootstrap.Tooltip(el);
    });
});
</script>
@endsection