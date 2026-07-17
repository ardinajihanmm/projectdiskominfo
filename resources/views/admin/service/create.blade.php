@extends('layouts.admin')

@section('content')

<style>
    .service-form-wrap{
        max-width:820px;
        margin:0 auto;
    }

    .service-form-card{
        background:#fff;
        border-radius:24px;
        box-shadow:0 12px 35px rgba(0,0,0,.06);
        padding:32px;
    }

    .service-form-header{
        display:flex;
        align-items:center;
        gap:16px;
        margin-bottom:28px;
    }

    .service-form-icon{
        width:52px;
        height:52px;
        min-width:52px;
        border-radius:16px;
        background:#EAF1FF;
        color:#2563EB;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
    }

    .service-form-header h2{
        font-size:1.5rem;
        font-weight:700;
        color:#1E293B;
        margin-bottom:2px;
    }

    .service-form-header p{
        color:#64748B;
        font-size:.9rem;
        margin:0;
    }

    .service-form-alert{
        background:#FEF2F2;
        border:1px solid #FECACA;
        color:#B91C1C;
        border-radius:14px;
        padding:16px 18px;
        margin-bottom:24px;
    }

    .service-form-alert ul{
        margin:0;
        padding-left:18px;
    }

    .form-group-pro{
        margin-bottom:22px;
    }

    .form-label-pro{
        display:flex;
        align-items:center;
        gap:8px;
        font-weight:600;
        color:#334155;
        font-size:.9rem;
        margin-bottom:8px;
    }

    .form-label-pro i{
        color:#2563EB;
        font-size:15px;
    }

    .form-control-pro{
        width:100%;
        border:1px solid #E2E8F0;
        border-radius:14px;
        padding:12px 16px;
        font-size:.95rem;
        color:#1E293B;
        background:#fff;
        transition:.2s;
    }

    .form-control-pro:focus{
        outline:none;
        border-color:#2563EB;
        box-shadow:0 0 0 4px rgba(37,99,235,.1);
    }

    textarea.form-control-pro{
        resize:vertical;
        min-height:120px;
    }

    /* select custom, seragam dengan style filter di dashboard */
    .select-wrap-pro{
        position:relative;
    }

    .select-wrap-pro select.form-control-pro{
        appearance:none;
        -webkit-appearance:none;
        padding-right:40px;
        cursor:pointer;
    }

    .select-wrap-pro .chevron-pro{
        position:absolute;
        right:16px;
        top:50%;
        transform:translateY(-50%);
        color:#94A3B8;
        pointer-events:none;
        font-size:13px;
    }

    .form-row-pro{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    }

    @media (max-width:576px){
        .form-row-pro{
            grid-template-columns:1fr;
        }
    }

    .form-actions-pro{
        display:flex;
        gap:12px;
        margin-top:8px;
        padding-top:20px;
        border-top:1px solid #F1F5F9;
    }

    .btn-save-pro{
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:linear-gradient(135deg,#3B82F6,#2563EB);
        color:#fff;
        border:none;
        border-radius:14px;
        padding:12px 26px;
        font-weight:600;
        font-size:.95rem;
        transition:.25s;
        box-shadow:0 10px 20px rgba(37,99,235,.25);
    }

    .btn-save-pro:hover{
        transform:translateY(-2px);
        color:#fff;
        box-shadow:0 14px 26px rgba(37,99,235,.32);
    }

    .btn-back-pro{
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:#fff;
        color:#475569;
        border:1px solid #E2E8F0;
        border-radius:14px;
        padding:12px 26px;
        font-weight:600;
        font-size:.95rem;
        transition:.2s;
    }

    .btn-back-pro:hover{
        background:#F8FAFC;
        color:#1E293B;
        border-color:#CBD5E1;
    }
</style>

<div class="service-form-wrap">

    <div class="service-form-card">

        <div class="service-form-header">
            <div class="service-form-icon">
                <i class="bi bi-tools"></i>
            </div>
            <div>
                <h2>Tambah Layanan</h2>
                <p>Lengkapi detail layanan baru untuk Helpdesk.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="service-form-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.service.store') }}" method="POST">
            @csrf

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-building"></i> Bidang
                </label>
                <input type="text"
                       name="nama_bidang"
                       list="bidangList"
                       class="form-control-pro"
                       placeholder="Ketik nama bidang (bisa pilih yang sudah ada atau tulis baru)"
                       value="{{ old('nama_bidang') }}"
                       autocomplete="off"
                       required>
                <datalist id="bidangList">
                    @foreach($departments as $department)
                        <option value="{{ $department->nama_bidang }}">
                    @endforeach
                </datalist>
                <small class="text-muted d-block mt-1">
                    Kalau bidang belum ada di daftar, cukup ketik nama barunya — akan otomatis dibuat.
                </small>
            </div>

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-tag"></i> Nama Layanan
                </label>
                <input type="text"
                       name="nama_layanan"
                       class="form-control-pro"
                       placeholder="Contoh: Perbaikan Jaringan Wifi"
                       value="{{ old('nama_layanan') }}"
                       required>
            </div>

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-card-text"></i> Deskripsi
                </label>
                <textarea name="deskripsi"
                          class="form-control-pro"
                          rows="5"
                          placeholder="Jelaskan cakupan layanan ini secara singkat..."
                          required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-row-pro">

                <div class="form-group-pro">
                    <label class="form-label-pro">
                        <i class="bi bi-hourglass-split"></i> SLA (Hari)
                    </label>
                    <input type="number"
                           name="sla"
                           class="form-control-pro"
                           min="1"
                           value="{{ old('sla',3) }}"
                           required>
                </div>

                <div class="form-group-pro">
                    <label class="form-label-pro">
                        <i class="bi bi-toggle-on"></i> Status
                    </label>
                    <div class="select-wrap-pro">
                        <select name="status" class="form-control-pro">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <i class="bi bi-chevron-down chevron-pro"></i>
                    </div>
                </div>

            </div>

            <div class="form-actions-pro">
                <button type="submit" class="btn-save-pro">
                    <i class="bi bi-check2-circle"></i> Simpan
                </button>

                <a href="{{ route('admin.service.index') }}" class="btn-back-pro">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection