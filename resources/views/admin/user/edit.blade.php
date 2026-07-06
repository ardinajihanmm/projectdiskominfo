@extends('layouts.admin')
@section('content')
<div class="container mt-4">

    <h2>Edit User</h2>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control"
                value="{{ old('no_hp', $user->no_hp) }}">
        </div>

        <div class="mb-3">
            <label>Instansi</label>
            <input type="text" name="instansi" class="form-control"
                value="{{ old('instansi', $user->instansi) }}">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="staff" {{ $user->role=='staff'?'selected':'' }}>Staff</option>
                <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>

    </form>

</div>
@endsection