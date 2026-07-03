@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Edit Layanan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.service.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Bidang</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ $service->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->nama_bidang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Layanan</label>
            <input type="text"
                   name="nama_layanan"
                   class="form-control"
                   value="{{ old('nama_layanan', $service->nama_layanan) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="5"
                      class="form-control"
                      required>{{ old('deskripsi', $service->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">SLA (Hari)</label>
            <input type="number"
                   name="sla"
                   class="form-control"
                   min="1"
                   value="{{ old('sla', $service->sla) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection