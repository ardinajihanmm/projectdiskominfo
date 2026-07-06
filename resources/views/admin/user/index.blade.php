@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Data User</h2>
        <form action="{{ route('admin.user.index') }}" method="GET" class="mb-3">
    <div class="input-group">

        <span class="input-group-text bg-primary text-white">
            <i class="bi bi-search"></i>
        </span>

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari nama, email, atau instansi..."
            value="{{ $search ?? '' }}">

        <button class="btn btn-primary">
            Cari
        </button>

        @if(!empty($search))
            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                Reset
            </a>
        @endif

    </div>
</form>

        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            + Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Instansi</th>
                <th>Role</th>
                <th width="170">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($users as $user)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_hp }}</td>
                <td>{{ $user->instansi }}</td>

                <td>
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @elseif($user->role == 'staff')
                        <span class="badge bg-warning text-dark">Staff</span>
                    @else
                        <span class="badge bg-primary">User</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.user.edit',$user->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.user.destroy',$user->id) }}"
                          method="POST"
                          style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="7" class="text-center">
                    Belum ada data user.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection