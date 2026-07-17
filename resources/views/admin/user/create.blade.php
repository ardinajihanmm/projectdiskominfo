@extends('layouts.admin')

@section('title', 'Tambah User')

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
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <div>
                <h2>Tambah User</h2>
                <p>Buat akun baru untuk mengakses sistem Helpdesk.</p>
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

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-person"></i> Nama
                </label>
                <input type="text"
                       name="name"
                       class="form-control-pro"
                       placeholder="Nama lengkap"
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-envelope"></i> Email
                </label>
                <input type="email"
                       name="email"
                       class="form-control-pro"
                       placeholder="nama@email.com"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-row-pro">

                <div class="form-group-pro">
                    <label class="form-label-pro">
                        <i class="bi bi-telephone"></i> No HP
                    </label>
                    <input type="text"
                           name="no_hp"
                           class="form-control-pro"
                           placeholder="08xxxxxxxxxx"
                           value="{{ old('no_hp') }}">
                </div>

                <div class="form-group-pro">
                    <label class="form-label-pro">
                        <i class="bi bi-building"></i> Instansi
                    </label>
                    <input type="text"
                           name="instansi"
                           class="form-control-pro"
                           placeholder="Nama instansi"
                           value="{{ old('instansi') }}">
                </div>

            </div>

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-lock"></i> Password
                </label>
                <input type="password"
                       name="password"
                       class="form-control-pro"
                       placeholder="Minimal 8 karakter"
                       required>
            </div>

            <div class="form-group-pro">
                <label class="form-label-pro">
                    <i class="bi bi-person-badge"></i> Role
                </label>
                <div class="select-wrap-pro">
                    <select name="role" class="form-control-pro" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <i class="bi bi-chevron-down chevron-pro"></i>
                </div>
            </div>

            <div class="form-actions-pro">
                <button type="submit" class="btn-save-pro">
                    <i class="bi bi-check2-circle"></i> Simpan
                </button>

                <a href="{{ route('admin.user.index') }}" class="btn-back-pro">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection