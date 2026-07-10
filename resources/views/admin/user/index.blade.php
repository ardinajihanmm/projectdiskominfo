@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="card shadow border-0 rounded-4 mb-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-people-fill text-primary me-2"></i>
                        Data User
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola seluruh akun pengguna Helpdesk Diskominfo.
                    </p>

                </div>

                <a href="{{ route('admin.user.create') }}"
                   class="btn btn-primary rounded-pill px-4">

                    <i class="bi bi-person-plus-fill me-2"></i>

                    Tambah User

                </a>

            </div>

        </div>

    </div>

    {{-- Alert --}}
    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm">

        <i class="bi bi-check-circle-fill me-2"></i>

        {{ session('success') }}

        <button
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

    @endif

    {{-- Search --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">

        <div class="card-body">

            <form action="{{ route('admin.user.index') }}" method="GET">

                <div class="row g-3">

                    <div class="col-md-10">

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search text-primary"></i>

                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari nama, email atau instansi..."
                                value="{{ $search ?? '' }}">

                        </div>

                    </div>

                    <div class="col-md-2 d-grid">

                        <button class="btn btn-primary rounded-pill">

                            <i class="bi bi-search me-1"></i>

                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Table --}}
    <div class="card border-0 shadow rounded-4">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-person-lines-fill text-primary me-2"></i>

                    Daftar Pengguna

                </h5>

                <span class="badge bg-primary rounded-pill px-3 py-2">

                    {{ $users->total() }} User

                </span>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-primary">

                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th>
                                Pengguna
                            </th>

                            <th>
                                Kontak
                            </th>

                            <th>
                                Instansi
                            </th>

                            <th width="140">
                                Role
                            </th>

                            <th width="160" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

@forelse($users as $user)
<tr class="user-row">

    <td class="fw-bold text-primary">
        {{ $loop->iteration }}
    </td>

    <td>

        <div class="d-flex align-items-center">

            <div class="avatar-circle me-3">

                {{ strtoupper(substr($user->name,0,1)) }}

            </div>

            <div>

                <div class="fw-bold">

                    {{ $user->name }}

                </div>

                <small class="text-muted">

                    ID User : {{ $user->id }}

                </small>

            </div>

        </div>

    </td>

    <td>

        <div class="fw-semibold">

            <i class="bi bi-envelope-fill text-primary me-1"></i>

            {{ $user->email }}

        </div>

        <small class="text-muted">

            <i class="bi bi-telephone-fill me-1"></i>

            {{ $user->no_hp ?? '-' }}

        </small>

    </td>

    <td>

        <span class="fw-semibold">

            {{ $user->instansi ?? '-' }}

        </span>

    </td>

    <td>

        @if($user->role=='admin')

            <span class="badge bg-danger rounded-pill px-3 py-2">

                <i class="bi bi-shield-lock-fill me-1"></i>

                Admin

            </span>

        @elseif($user->role=='staff')

            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                <i class="bi bi-person-workspace me-1"></i>

                Staff

            </span>

        @else

            <span class="badge bg-primary rounded-pill px-3 py-2">

                <i class="bi bi-person-fill me-1"></i>

                User

            </span>

        @endif

    </td>

    <td>

        <div class="d-flex justify-content-center gap-2">

            <a href="{{ route('admin.user.edit',$user->id) }}"
               class="btn btn-warning btn-sm rounded-circle action-btn"
               data-bs-toggle="tooltip"
               title="Edit">

                <i class="bi bi-pencil-fill"></i>

            </a>

            <form
                action="{{ route('admin.user.destroy',$user->id) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                @csrf
                @method('DELETE')

                <button
                    class="btn btn-danger btn-sm rounded-circle action-btn"
                    data-bs-toggle="tooltip"
                    title="Hapus">

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

            <i class="bi bi-people display-3 text-secondary"></i>

            <h4 class="fw-bold mt-3">

                Belum Ada Data User

            </h4>

            <p class="text-muted">

                Klik tombol <strong>Tambah User</strong> untuk menambahkan pengguna baru.

            </p>

        </div>

    </td>

</tr>

@endforelse
                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <small class="text-muted">

                    Menampilkan

                    <strong>{{ $users->count() }}</strong>

                    dari

                    <strong>{{ $users->total() }}</strong>

                    pengguna.

                </small>

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>

<style>

.card{

    border-radius:22px;

}

.table thead{

    background:linear-gradient(90deg,#2563eb,#3b82f6);

}

.table thead th{

    color:#fff;

    border:none;

    padding:18px;

    font-size:14px;

    font-weight:600;

    text-transform:uppercase;

    letter-spacing:.5px;

}

.table tbody td{

    padding:18px;

    vertical-align:middle;

}

.user-row{

    transition:.25s ease;

}

.user-row:hover{

    background:#f8fbff;

    transform:translateY(-2px);

}

.avatar-circle{

    width:50px;

    height:50px;

    border-radius:50%;

    background:linear-gradient(135deg,#2563eb,#60a5fa);

    color:white;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:18px;

    font-weight:700;

    box-shadow:0 8px 18px rgba(37,99,235,.25);

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

    transform:scale(1.08);

}

.input-group-text{

    border-radius:14px 0 0 14px;

}

.form-control{

    border-radius:0 14px 14px 0;

    height:48px;

}

.btn-primary{

    border-radius:14px;

}

.badge{

    font-size:.8rem;

}

.pagination{

    margin-bottom:0;

}

.page-link{

    border:none;

    margin:0 4px;

    border-radius:10px !important;

    color:#2563eb;

}

.page-item.active .page-link{

    background:#2563eb;

    color:#fff;

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