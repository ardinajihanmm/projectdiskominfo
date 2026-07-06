@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>Tambah Layanan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.service.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Bidang</label>
            <select name="department_id" class="form-control" required>
                <option value="">-- Pilih Bidang --</option>

                @foreach($departments as $department)
                    <option value="{{ $department->id }}">
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
                   value="{{ old('nama_layanan') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi"
                      class="form-control"
                      rows="5"
                      required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">SLA (Hari)</label>
            <input type="number"
                   name="sla"
                   class="form-control"
                   min="1"
                   value="{{ old('sla',3) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>

            <select name="status" class="form-control">

                <option value="1">Aktif</option>

                <option value="0">Nonaktif</option>

            </select>
        </div>

        <button class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('admin.service.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection