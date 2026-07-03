@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2>Register</h2>

<form action="{{ route('register') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nama</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>No HP</label>
<input type="text" name="no_hp" class="form-control" required>
</div>

<div class="mb-3">
<label>Instansi</label>
<input type="text" name="instansi" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Konfirmasi Password</label>
<input type="password" name="password_confirmation" class="form-control" required>
</div>

<button class="btn btn-success">
Register
</button>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>

</div>

@endsection