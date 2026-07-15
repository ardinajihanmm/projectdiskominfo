@extends('layouts.landing')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>

:root{

    --primary:#2563eb;
    --primary-light:#3b82f6;
    --primary-dark:#1d4ed8;
    --bg-soft:#eef5ff;
    --bg-hero:#f7faff;
    --bg-light:#f8fafc;
    --border:#e2e8f0;
    --text:#0f172a;
    --muted:#64748b;
    --white:#ffffff;
    --navy-deep:#071a33;

    --radius-lg:24px;
    --radius-md:20px;

    --shadow-sm:0 4px 16px rgba(15,23,42,.06);
    --shadow-md:0 16px 36px rgba(37,99,235,.14);

    --sp-2:16px;
    --sp-3:24px;
    --sp-4:32px;
    --sp-5:48px;
    --sp-6:64px;

}

*{ margin:0; padding:0; box-sizing:border-box; }

html{ scroll-behavior:smooth; }

body{

    font-family:'Poppins',sans-serif;

    color:var(--text);

    background:var(--white);

    overflow-x:hidden;

}

.container{ max-width:1100px; }

img{ max-width:100%; }

/* ---- navbar (identical language to landing page) ---- */

.nav-wrap{ position:sticky; top:16px; z-index:999; padding:0 24px; }

.navbar{

    max-width:1260px;

    margin:0 auto;

    background:rgba(255,255,255,.68);

    backdrop-filter:blur(24px) saturate(180%);

    -webkit-backdrop-filter:blur(24px) saturate(180%);

    border:1px solid rgba(255,255,255,.55);

    border-radius:999px;

    box-shadow:0 10px 36px rgba(15,23,42,.09);

    padding:16px 16px 16px 20px;

}

.navbar-brand{ display:flex; align-items:center; gap:12px; font-weight:700; }

.logo-pemalang{ width:42px; height:42px; object-fit:contain; flex-shrink:0; }

.brand-title{ line-height:1.15; text-align:left; }

.brand-title strong{ display:block; font-size:1rem; font-weight:700; color:var(--text); }

.brand-title small{ color:var(--muted); font-size:.72rem; font-weight:500; }

.nav-link{

    color:#475569!important;

    font-weight:500;

    font-size:.94rem;

    margin:0 2px;

    padding:9px 16px!important;

    border-radius:999px;

    transition:.2s;

}

.nav-link:hover{ color:var(--primary)!important; background:var(--bg-soft); }

.nav-link.active{ color:var(--primary)!important; background:var(--bg-soft); font-weight:600; }

.btn-login{

    border-radius:999px;

    padding:10px 24px;

    font-weight:600;

    font-size:.92rem;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    border:none;

    box-shadow:0 8px 18px -6px rgba(37,99,235,.5);

}

/* ---- page hero ---- */

.page-hero{

    position:relative;

    overflow:hidden;

    background:linear-gradient(180deg,var(--bg-hero) 0%,var(--white) 100%);

    padding:var(--sp-6) 0 var(--sp-5);

    text-align:center;

}

.page-hero::before{

    content:"";

    position:absolute;

    width:380px;

    height:380px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(37,99,235,.14),transparent 70%);

    top:-160px;

    right:-100px;

    filter:blur(60px);

}

.page-hero .container{ position:relative; z-index:1; }

.page-eyebrow{

    display:inline-block;

    font-size:.78rem;

    font-weight:700;

    letter-spacing:.12em;

    text-transform:uppercase;

    color:var(--primary);

    background:var(--bg-soft);

    padding:6px 16px;

    border-radius:999px;

    margin-bottom:var(--sp-2);

}

.page-hero h1{

    font-size:2.5rem;

    font-weight:800;

    letter-spacing:-.02em;

    margin-bottom:var(--sp-2);

}

.page-hero p{

    color:var(--muted);

    max-width:640px;

    margin:0 auto;

    line-height:1.8;

    font-size:1.02rem;

}

/* ---- content sections ---- */

.info-section{ padding:var(--sp-5) 0; }

.info-section.alt{ background:#f7faff; }

.info-block h2{

    font-size:1.7rem;

    font-weight:800;

    color:var(--text);

    margin-bottom:var(--sp-2);

    letter-spacing:-.01em;

}

.info-block h2 i{ color:var(--primary); margin-right:8px; }

.info-block p{

    color:var(--muted);

    line-height:1.85;

    font-size:1rem;

    max-width:820px;

}

/* jenis layanan */

.layanan-list{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:var(--sp-2);

    margin-top:var(--sp-3);

}

.layanan-list li{

    list-style:none;

    display:flex;

    align-items:flex-start;

    gap:10px;

    background:#fff;

    border:1px solid var(--border);

    border-radius:14px;

    padding:14px 16px;

    font-size:.92rem;

    color:var(--text);

    transition:.2s;

}

.layanan-list li:hover{

    border-color:#c9dcff;

    box-shadow:var(--shadow-sm);

    transform:translateY(-2px);

}

.layanan-list li i{ color:var(--primary); margin-top:2px; }

/* manfaat cards */

.manfaat-grid{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:var(--sp-3);

    margin-top:var(--sp-3);

}

.manfaat-card{

    background:#fff;

    border:1px solid var(--border);

    border-radius:var(--radius-md);

    padding:var(--sp-3);

    transition:.25s;

}

.manfaat-card:hover{

    transform:translateY(-6px);

    box-shadow:var(--shadow-md);

    border-color:#c9dcff;

}

.manfaat-icon{

    width:50px;

    height:50px;

    border-radius:14px;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:1.25rem;

    margin-bottom:14px;

}

.manfaat-card h5{ font-weight:700; font-size:1rem; margin-bottom:6px; color:var(--text); }

.manfaat-card p{ color:var(--muted); font-size:.88rem; line-height:1.7; margin:0; }

/* timeline (rinci) */

.timeline-detail{

    margin-top:var(--sp-4);

    border-left:2px solid var(--border);

    padding-left:var(--sp-4);

}

.timeline-detail-item{

    position:relative;

    padding-bottom:var(--sp-4);

}

.timeline-detail-item:last-child{ padding-bottom:0; }

.timeline-detail-item::before{

    content:"";

    position:absolute;

    left:calc(-1 * var(--sp-4) - 7px);

    top:2px;

    width:14px;

    height:14px;

    border-radius:50%;

    background:var(--primary);

    border:3px solid #fff;

    box-shadow:0 0 0 2px var(--primary);

}

.timeline-detail-item h5{

    font-weight:700;

    color:var(--text);

    margin-bottom:6px;

    font-size:1.02rem;

}

.timeline-detail-item p{

    color:var(--muted);

    font-size:.92rem;

    line-height:1.75;

    max-width:700px;

}

/* info tambahan */

.note-card{

    background:linear-gradient(135deg,var(--primary-dark),var(--primary));

    color:#fff;

    border-radius:var(--radius-lg);

    padding:var(--sp-4);

    margin-top:var(--sp-3);

}

.note-card h5{ font-weight:700; margin-bottom:10px; }

.note-card p{ color:rgba(255,255,255,.88); line-height:1.8; font-size:.95rem; margin:0; }

.back-cta{ text-align:center; padding:var(--sp-5) 0 var(--sp-6); }

.btn-hero-primary{

    display:inline-flex;

    align-items:center;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    border:none;

    padding:14px 30px;

    border-radius:999px;

    font-weight:600;

    box-shadow:0 14px 28px -10px rgba(37,99,235,.55);

    transition:.25s;

}

.btn-hero-primary:hover{ transform:translateY(-3px); color:#fff; }

/* footer (compact, same language as landing page) */

footer{

    position:relative;

    background:linear-gradient(180deg,var(--navy-deep),#050f22);

    color:rgba(255,255,255,.72);

    padding:var(--sp-5) 0 0;

}

footer::before{

    content:"";

    position:absolute;

    top:0; left:0; right:0;

    height:3px;

    background:linear-gradient(90deg,var(--primary-dark),var(--primary),var(--primary-light),var(--primary));

}

.footer-inner{

    display:flex;

    flex-wrap:wrap;

    justify-content:space-between;

    gap:var(--sp-4);

    padding-bottom:var(--sp-4);

    border-bottom:1px solid rgba(255,255,255,.08);

}

.footer-brand{ display:flex; align-items:center; gap:12px; margin-bottom:var(--sp-2); }

.footer-brand img{ width:40px; height:40px; object-fit:contain; }

.footer-brand strong{ display:block; color:#fff; font-size:.98rem; }

.footer-brand small{ color:rgba(255,255,255,.55); }

.footer-col p{ font-size:.88rem; line-height:1.85; color:rgba(255,255,255,.62); max-width:320px; }

.footer-links a{

    display:block;

    color:rgba(255,255,255,.65);

    text-decoration:none;

    font-size:.88rem;

    margin-bottom:11px;

    transition:.2s;

}

.footer-links a:hover{ color:#fff; padding-left:4px; }

.footer-col h6{ color:#fff; font-weight:700; margin-bottom:var(--sp-2); font-size:.92rem; }

.footer-bottom{

    display:flex;

    justify-content:space-between;

    flex-wrap:wrap;

    gap:10px;

    padding:var(--sp-2) 0;

    font-size:.82rem;

    color:rgba(255,255,255,.48);

}

@media(max-width:767px){

    .layanan-list,
    .manfaat-grid{ grid-template-columns:1fr; }

    .page-hero h1{ font-size:2rem; }

}

</style>

{{-- ===================== NAVBAR ===================== --}}

<div class="nav-wrap">

<nav class="navbar navbar-expand-lg">

    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a class="navbar-brand" href="{{ url('/') }}">

            <img src="{{ asset('images/logo-pemalang.png') }}" class="logo-pemalang" alt="Logo Pemalang">

            <div class="brand-title">
                <strong>Helpdesk Diskominfo</strong>
                <small>Kabupaten Pemalang</small>
            </div>

        </a>

        <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbarLanding">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse flex-grow-0" id="navbarLanding">

            <ul class="navbar-nav align-items-lg-center mx-lg-2">

                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/#layanan') }}">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/#flow') }}">Alur</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ url('/pelajari-lebih-lanjut') }}">Tentang Layanan</a></li>

            </ul>

            <a href="{{ route('login') }}" class="btn btn-primary btn-login ms-lg-2 mt-3 mt-lg-0 d-inline-block">
                <i class="bi bi-box-arrow-in-right me-2"></i> Login
            </a>

        </div>

    </div>

</nav>

</div>

{{-- ===================== PAGE HERO ===================== --}}

<section class="page-hero">

    <div class="container" data-aos="fade-up">

        <span class="page-eyebrow">Pelajari Lebih Lanjut</span>

        <h1>Tentang Portal Helpdesk Diskominfo Pemalang</h1>

        <p>

            Halaman ini menjelaskan secara lengkap apa itu Portal Helpdesk,
            tujuan dan fungsinya, jenis layanan yang tersedia, cara pengajuan,
            hingga manfaat yang bisa Anda peroleh sebagai pengguna.

        </p>

    </div>

</section>

{{-- ===================== TENTANG HELPDESK ===================== --}}

<section class="info-section">

    <div class="container info-block" data-aos="fade-up">

        <h2><i class="bi bi-info-circle-fill"></i>Apa itu Portal Helpdesk</h2>

        <p>

            Portal Helpdesk Diskominfo Kabupaten Pemalang adalah aplikasi layanan
            Teknologi Informasi dan Komunikasi (TIK) yang dikelola oleh Dinas
            Komunikasi dan Informatika Kabupaten Pemalang. Melalui portal ini,
            perangkat daerah maupun aparatur sipil negara dapat mengajukan
            permohonan layanan TIK, menyampaikan pengaduan, serta memantau
            status penyelesaian permohonan secara online tanpa perlu datang
            langsung ke kantor Diskominfo.

        </p>

    </div>

</section>

{{-- ===================== TUJUAN & FUNGSI ===================== --}}

<section class="info-section alt">

    <div class="container info-block" data-aos="fade-up">

        <h2><i class="bi bi-bullseye"></i>Tujuan Portal</h2>

        <p>

            Portal ini dibangun untuk menyederhanakan proses permohonan layanan
            TIK di lingkungan Pemerintah Kabupaten Pemalang, mempercepat waktu
            tindak lanjut, serta meningkatkan transparansi dan akuntabilitas
            setiap permohonan yang diajukan oleh perangkat daerah.

        </p>

    </div>

</section>

{{-- ===================== JENIS LAYANAN ===================== --}}

<section class="info-section">

    <div class="container info-block" data-aos="fade-up">

        <h2><i class="bi bi-grid-1x2-fill"></i>Jenis-Jenis Layanan</h2>

        <p>

            Berikut kategori layanan Teknologi Informasi yang dapat diajukan
            melalui Portal Helpdesk. Daftar layanan lengkap beserta detailnya
            dapat dilihat langsung pada halaman beranda.

        </p>

        <ul class="layanan-list">

            <li><i class="bi bi-check-circle-fill"></i> Infrastruktur Jaringan &amp; Internet</li>
            <li><i class="bi bi-check-circle-fill"></i> Website &amp; Domain Perangkat Daerah</li>
            <li><i class="bi bi-check-circle-fill"></i> Email Resmi Pemerintah</li>
            <li><i class="bi bi-check-circle-fill"></i> Hosting &amp; Penyimpanan Data</li>
            <li><i class="bi bi-check-circle-fill"></i> Keamanan Sistem Informasi</li>
            <li><i class="bi bi-check-circle-fill"></i> Konsultasi &amp; Pendampingan Teknis TIK</li>

        </ul>

    </div>

</section>

{{-- ===================== CARA PENGAJUAN ===================== --}}

<section class="info-section alt">

    <div class="container info-block" data-aos="fade-up">

        <h2><i class="bi bi-list-ol"></i>Cara Mengajukan Layanan</h2>

        <p>

            Proses pengajuan layanan dirancang sesederhana mungkin agar dapat
            diselesaikan hanya dalam beberapa langkah.

        </p>

        <div class="timeline-detail">

            <div class="timeline-detail-item" data-aos="fade-up">
                <h5>1. Login ke Portal</h5>
                <p>Masuk menggunakan akun Helpdesk yang telah terdaftar untuk perangkat daerah Anda.</p>
            </div>

            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="80">
                <h5>2. Pilih Layanan yang Dibutuhkan</h5>
                <p>Telusuri atau cari layanan yang sesuai dengan kebutuhan instansi Anda pada halaman beranda.</p>
            </div>

            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="160">
                <h5>3. Lengkapi Formulir Permohonan</h5>
                <p>Isi data permohonan beserta dokumen pendukung yang dipersyaratkan sesuai jenis layanan.</p>
            </div>

            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="240">
                <h5>4. Verifikasi oleh Petugas</h5>
                <p>Tim Diskominfo memverifikasi kelengkapan dan kesesuaian permohonan yang masuk.</p>
            </div>

            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="320">
                <h5>5. Layanan Diproses &amp; Dipantau</h5>
                <p>Setelah disetujui, permohonan ditindaklanjuti dan status prosesnya dapat dipantau langsung melalui akun Anda.</p>
            </div>

        </div>

    </div>

</section>

{{-- ===================== MANFAAT ===================== --}}

<section class="info-section">

    <div class="container info-block" data-aos="fade-up">

        <h2><i class="bi bi-stars"></i>Manfaat Menggunakan Helpdesk</h2>

        <p>

            Beberapa keuntungan yang bisa Anda rasakan dengan mengajukan
            layanan TIK melalui portal ini dibandingkan cara konvensional.

        </p>

        <div class="manfaat-grid">

            <div class="manfaat-card" data-aos="fade-up">
                <div class="manfaat-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                <h5>Proses Lebih Cepat</h5>
                <p>Permohonan tercatat dan ditindaklanjuti sesuai standar waktu layanan yang jelas.</p>
            </div>

            <div class="manfaat-card" data-aos="fade-up" data-aos-delay="80">
                <div class="manfaat-icon"><i class="bi bi-eye-fill"></i></div>
                <h5>Transparan</h5>
                <p>Status setiap permohonan dapat dipantau kapan saja langsung dari akun Anda.</p>
            </div>

            <div class="manfaat-card" data-aos="fade-up" data-aos-delay="160">
                <div class="manfaat-icon"><i class="bi bi-laptop"></i></div>
                <h5>Akses Online 24 Jam</h5>
                <p>Pengajuan dapat dilakukan kapan saja tanpa harus datang langsung ke kantor.</p>
            </div>

        </div>

    </div>

</section>

{{-- ===================== INFORMASI TAMBAHAN ===================== --}}

<section class="info-section alt">

    <div class="container info-block" data-aos="fade-up">

        <h2><i class="bi bi-patch-question-fill"></i>Informasi Tambahan</h2>

        <div class="note-card">

            <h5>Butuh bantuan lebih lanjut?</h5>

            <p>

                Jika Anda mengalami kendala saat menggunakan portal atau
                membutuhkan informasi tambahan, silakan hubungi Tim Helpdesk
                Diskominfo Kabupaten Pemalang melalui ikon chat yang tersedia
                di pojok kanan bawah halaman beranda.

            </p>

        </div>

    </div>

</section>

<div class="back-cta" data-aos="fade-up">

    <a href="{{ url('/') }}" class="btn-hero-primary">

        <i class="bi bi-arrow-left me-2"></i>

        Kembali ke Beranda

    </a>

</div>

{{-- ===================== FOOTER ===================== --}}

<footer>

    <div class="container">

        <div class="footer-inner">

            <div class="footer-col" style="flex:1 1 340px;">

                <div class="footer-brand">

                    <img src="{{ asset('images/logo-pemalang.png') }}" alt="Logo Pemalang">

                    <div>
                        <strong>Helpdesk Diskominfo</strong>
                        <small>Kabupaten Pemalang</small>
                    </div>

                </div>

                <p>

                    Portal layanan resmi Dinas Komunikasi dan Informatika
                    Kabupaten Pemalang untuk pengajuan dan pemantauan
                    layanan Teknologi Informasi secara online.

                </p>

            </div>

            <div class="footer-col footer-links" style="flex:0 0 200px;">

                <h6>Navigasi</h6>

                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/#layanan') }}">Layanan</a>
                <a href="{{ url('/#flow') }}">Alur Layanan</a>
                <a href="{{ url('/pelajari-lebih-lanjut') }}">Tentang Layanan</a>

            </div>

        </div>

        <div class="footer-bottom">

            <div>© {{ date('Y') }} Helpdesk Diskominfo Kabupaten Pemalang. Seluruh hak cipta dilindungi.</div>

            <div>Dikembangkan oleh Diskominfo Kabupaten Pemalang</div>

        </div>

    </div>

</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>

AOS.init({ duration:700, once:true, offset:60 });

</script>

@endsection
