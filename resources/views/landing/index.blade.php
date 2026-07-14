@extends('layouts.landing')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet">

<style>

:root{

    --primary:#2563eb;
    --primary-light:#3b82f6;
    --primary-dark:#1d4ed8;
    --bg-soft:#eff4ff;
    --bg-light:#f8fafc;
    --border:#e2e8f0;
    --text:#0f172a;
    --muted:#64748b;
    --white:#ffffff;

    --radius-lg:24px;
    --radius-md:18px;
    --radius-sm:12px;

    --shadow-sm:0 4px 16px rgba(15,23,42,.06);
    --shadow-md:0 12px 32px rgba(37,99,235,.12);
    --shadow-lg:0 24px 60px rgba(37,99,235,.16);

}

/* =====================================
   RESET
===================================== */

*{

    margin:0;
    padding:0;
    box-sizing:border-box;

}

html{

    scroll-behavior:smooth;

}

body{

    font-family:'Poppins',sans-serif;

    color:var(--text);

    background:var(--white);

    overflow-x:hidden;

}

section{

    padding:88px 0;

}

.container{

    max-width:1260px;

}

img{

    max-width:100%;

}

/* =====================================
   FLOATING NAVBAR
===================================== */

.nav-wrap{

    position:sticky;

    top:18px;

    z-index:999;

    padding:0 24px;

}

.navbar{

    max-width:1260px;

    margin:0 auto;

    background:rgba(255,255,255,.72);

    backdrop-filter:blur(20px) saturate(160%);

    -webkit-backdrop-filter:blur(20px) saturate(160%);

    border:1px solid rgba(255,255,255,.6);

    border-radius:999px;

    box-shadow:0 8px 32px rgba(15,23,42,.08),0 1px 0 rgba(255,255,255,.6) inset;

    padding:10px 14px 10px 18px;

    transition:.3s;

}

.nav-link.active{

    color:var(--primary)!important;

    background:var(--bg-soft);

}

.navbar-brand{

    display:flex;

    align-items:center;

    gap:12px;

    font-weight:700;

}

.logo-pemalang{

    width:44px;

    height:44px;

    object-fit:contain;

    flex-shrink:0;

}

.brand-title{

    line-height:1.15;

    text-align:left;

}

.brand-title strong{

    display:block;

    font-size:1.02rem;
    font-weight:700;
    color:var(--text);
    letter-spacing:.01em;

}

.brand-title small{

    color:var(--muted);

    font-size:.74rem;
    font-weight:500;

}

.nav-link{

    color:#475569!important;

    font-weight:500;

    font-size:.95rem;

    margin:0 4px;

    padding:8px 14px!important;

    border-radius:999px;

    transition:.2s;

}

.nav-link:hover{

    color:var(--primary)!important;

    background:var(--bg-soft);

}

.btn-login{

    border-radius:999px;

    padding:10px 26px;

    font-weight:600;

    font-size:.94rem;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    border:none;

    box-shadow:0 8px 18px -6px rgba(37,99,235,.5);

    transition:.2s;

}

.btn-login:hover{

    transform:translateY(-2px);

    box-shadow:0 12px 22px -6px rgba(37,99,235,.55);

}

/* =====================================
   HERO
===================================== */

#hero{

    position:relative;

    overflow:hidden;

    background:
    radial-gradient(circle at 85% 8%,rgba(37,99,235,.10),transparent 45%),
    radial-gradient(circle at 5% 95%,rgba(59,130,246,.09),transparent 40%),
    linear-gradient(160deg,#F7FAFF 0%,#EEF5FF 55%,#F7FAFF 100%);

    padding:48px 0 56px;

}

#hero::before{

    content:"";

    position:absolute;

    top:-120px;

    right:-140px;

    width:420px;

    height:420px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(37,99,235,.14),rgba(37,99,235,0) 70%);

    filter:blur(2px);

    z-index:0;

    pointer-events:none;

    animation:heroFloat 9s ease-in-out infinite;

}

#hero::after{

    content:"";

    position:absolute;

    bottom:-160px;

    left:-120px;

    width:380px;

    height:380px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(59,130,246,.12),rgba(59,130,246,0) 70%);

    z-index:0;

    pointer-events:none;

    animation:heroFloat 11s ease-in-out infinite reverse;

}

@keyframes heroFloat{

    0%,100%{ transform:translateY(0) translateX(0); }
    50%{ transform:translateY(-18px) translateX(10px); }

}

.hero-dot-pattern{

    position:absolute;

    top:24px;

    left:6%;

    width:140px;

    height:140px;

    background-image:radial-gradient(rgba(37,99,235,.22) 1.6px,transparent 1.6px);

    background-size:16px 16px;

    opacity:.5;

    z-index:0;

    pointer-events:none;

}

#hero .container{

    position:relative;

    z-index:1;

}

.hero-eyebrow{

    display:inline-flex;

    align-items:center;

    gap:8px;

    background:var(--bg-soft);

    color:var(--primary);

    border:1px solid #dbe6ff;

    padding:8px 18px;

    border-radius:999px;

    margin-bottom:26px;

    font-size:.85rem;
    font-weight:600;

}

.hero-eyebrow i{

    font-size:.9rem;

}

.hero-title{

    font-size:3.2rem;

    font-weight:800;

    line-height:1.15;

    letter-spacing:-.02em;

    color:var(--text);

    margin-bottom:22px;

}

.hero-title span{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    -webkit-background-clip:text;

    background-clip:text;

    color:transparent;

}

.hero-text{

    font-size:1.06rem;

    color:var(--muted);

    max-width:540px;

    line-height:1.85;

    margin-bottom:38px;

}

.hero-cta{

    display:flex;

    flex-wrap:wrap;

    gap:14px;

    margin-bottom:34px;

}

.btn-hero-primary{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    border:none;

    padding:15px 30px;

    border-radius:999px;

    font-weight:600;

    box-shadow:0 14px 28px -10px rgba(37,99,235,.55);

    transition:.25s;

}

.btn-hero-primary:hover{

    transform:translateY(-3px);

    box-shadow:0 18px 32px -10px rgba(37,99,235,.6);

    color:#fff;

}

.btn-hero-outline{

    background:#fff;

    color:var(--primary);

    border:1.5px solid var(--border);

    padding:15px 30px;

    border-radius:999px;

    font-weight:600;

    transition:.25s;

}

.btn-hero-outline:hover{

    border-color:var(--primary);

    background:var(--bg-soft);

    color:var(--primary);

    transform:translateY(-3px);

}

.hero-quick{

    display:inline-flex;

    align-items:center;

    gap:16px;

    background:var(--white);

    border:1px solid var(--border);

    border-radius:var(--radius-md);

    padding:16px 20px;

    max-width:420px;

    box-shadow:var(--shadow-sm);

    transition:.25s;

}

.hero-quick:hover{

    transform:translateY(-4px);

    box-shadow:var(--shadow-md);

    border-color:#c9dcff;

}

.hero-quick-icon{

    width:46px;
    height:46px;
    flex-shrink:0;

    border-radius:14px;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:1.15rem;

}

.hero-quick-text strong{

    display:block;
    font-size:.98rem;
    color:var(--text);

}

.hero-quick-text small{

    color:var(--muted);

}

.hero-quick-arrow{

    margin-left:auto;

    color:var(--primary);

    font-size:1.1rem;

}

/* ---- hero right: search + service grid ---- */

.hero-right{

    background:var(--bg-light);

    border:1px solid var(--border);

    border-radius:var(--radius-lg);

    padding:26px;

    box-shadow:var(--shadow-sm);

}

.hero-search{

    position:relative;

    margin-bottom:22px;

}

.hero-search i{

    position:absolute;

    left:22px;

    top:50%;

    transform:translateY(-50%);

    color:var(--muted);

    font-size:1.05rem;

}

.hero-search input{

    width:100%;

    border:1px solid var(--border);

    background:#fff;

    border-radius:999px;

    padding:17px 58px 17px 52px;

    font-size:.96rem;

    box-shadow:var(--shadow-sm);

    transition:.2s;

}

.hero-search input:focus{

    outline:none;

    border-color:var(--primary);

    box-shadow:0 0 0 4px rgba(37,99,235,.12);

}

.hero-search-btn{

    position:absolute;

    right:6px;

    top:50%;

    transform:translateY(-50%);

    width:44px;

    height:44px;

    border:none;

    border-radius:50%;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:1rem;

    transition:.2s;

}

.hero-search-btn:hover{

    transform:translateY(-50%) scale(1.06);

}

.service-grid{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:14px;

    max-height:560px;

    overflow-y:auto;

    padding-right:4px;

}

.service-grid::-webkit-scrollbar{

    width:6px;

}

.service-grid::-webkit-scrollbar-thumb{

    background:#cbd8f0;

    border-radius:999px;

}

.service-card{

    position:relative;

    background:#fff;

    border:1px solid var(--border);

    border-radius:22px;

    overflow:hidden;

    cursor:pointer;

    transition:.3s cubic-bezier(.2,.8,.2,1);

    display:flex;

    flex-direction:column;

    text-align:center;

    width:100%;

    padding:0;

    font-family:inherit;

    -webkit-appearance:none;

    appearance:none;

}

.service-card:focus-visible{

    outline:3px solid var(--primary-light);

    outline-offset:2px;

}

.service-card:hover{

    transform:translateY(-8px);

    box-shadow:var(--shadow-lg);

    border-color:#c9dcff;

}

.service-card:hover .service-arrow{

    background:var(--primary);

    color:#fff;

    transform:translate(2px,-2px);

}

.service-card:hover .service-thumb img{

    transform:scale(1.08);

}

.service-thumb{

    position:relative;

    background:linear-gradient(135deg,var(--bg-soft),#e2ecff);

    display:flex;

    align-items:center;

    justify-content:center;

    padding:26px 18px;

    height:112px;

}

.service-thumb img{

    max-height:60px;

    width:auto;

    object-fit:contain;

    transition:.3s;

}

.service-arrow{

    position:absolute;

    top:12px;

    right:12px;

    width:30px;

    height:30px;

    border-radius:50%;

    background:rgba(255,255,255,.85);

    color:var(--primary);

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:.85rem;

    transition:.25s;

    box-shadow:var(--shadow-sm);

}

.service-label{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    font-size:.84rem;

    font-weight:600;

    line-height:1.4;

    padding:14px 16px;

    min-height:64px;

    display:flex;

    align-items:center;

    justify-content:center;

    text-align:center;

}

/* =====================================
   SECTION TITLE
===================================== */

.section-title{

    text-align:center;

    max-width:640px;

    margin:0 auto 64px;

}

.section-title .eyebrow{

    display:inline-block;

    font-size:.8rem;

    font-weight:700;

    letter-spacing:.12em;

    text-transform:uppercase;

    color:var(--primary);

    background:var(--bg-soft);

    padding:6px 16px;

    border-radius:999px;

    margin-bottom:16px;

}

.section-title h2{

    font-size:2.4rem;

    font-weight:800;

    letter-spacing:-.02em;

    color:var(--text);

    margin-bottom:14px;

}

.section-title p{

    color:var(--muted);

    line-height:1.8;

    font-size:1.02rem;

}

.section-title.light .eyebrow{

    background:rgba(255,255,255,.14);

    color:#fff;

}

.section-title.light h2,
.section-title.light p{

    color:#fff;

}

.section-title.light p{

    color:rgba(255,255,255,.82);

}

/* =====================================
   SERVICES (full grid section)
===================================== */

#services{

    position:relative;

    background:var(--bg-light);

    overflow:hidden;

}

#services::before{

    content:"";

    position:absolute;

    top:-60px;

    right:-60px;

    width:260px;

    height:260px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(37,99,235,.06),transparent 70%);

    pointer-events:none;

}

#services .container{

    position:relative;

    z-index:1;

}

.service-item .service-card{

    height:100%;

}

/* =====================================
   FLOW
===================================== */

#flow{

    background:linear-gradient(135deg,var(--primary-dark),var(--primary),var(--primary-light));

    position:relative;

    overflow:hidden;

}

.flow-track{

    position:relative;

}

.flow-track::before{

    content:"";

    position:absolute;

    top:34px;

    left:9%;

    right:9%;

    height:2px;

    background:repeating-linear-gradient(90deg,rgba(255,255,255,.5) 0 10px,transparent 10px 18px);

}

.flow-card{

    position:relative;

    text-align:center;

    height:100%;

    padding:0 12px;

    transition:.3s;

}

.flow-card:hover{

    transform:translateY(-6px);

}

.flow-card:hover .flow-icon{

    background:#fff;

    box-shadow:0 16px 30px rgba(0,0,0,.22);

    transform:scale(1.08);

}

.flow-icon{

    position:relative;

    z-index:1;

    width:68px;

    height:68px;

    border-radius:50%;

    background:#fff;

    color:var(--primary);

    display:flex;

    align-items:center;

    justify-content:center;

    margin:0 auto 22px;

    font-size:1.6rem;

    box-shadow:0 10px 24px rgba(0,0,0,.15);

    transition:.3s;

}

.flow-card h5{

    color:#fff;

    font-weight:700;

    font-size:1.06rem;

    margin-bottom:10px;

}

.flow-card p{

    color:rgba(255,255,255,.82);

    font-size:.92rem;

    line-height:1.65;

}

/* =====================================
   FAQ
===================================== */

#faq{

    background:var(--white);

}

.accordion-item{

    border:1px solid var(--border)!important;

    margin-bottom:14px;

    border-radius:18px!important;

    overflow:hidden;

    box-shadow:var(--shadow-sm);

    transition:.25s;

}

.accordion-item:hover{

    box-shadow:var(--shadow-md);

}

.accordion-button{

    font-weight:600;

    font-size:1rem;

    color:var(--text);

    padding:22px 26px;

}

.accordion-button:not(.collapsed){

    background:var(--bg-soft);

    color:var(--primary);

    box-shadow:none;

}

.accordion-button:focus{

    box-shadow:0 0 0 4px rgba(37,99,235,.12);

    border-color:transparent;

}

.accordion-button::after{

    background-image:none!important;

    content:"\002B";

    font-size:1.3rem;

    font-weight:400;

    color:var(--primary);

    width:32px;

    height:32px;

    border-radius:50%;

    background-color:var(--bg-soft);

    display:flex;

    align-items:center;

    justify-content:center;

    transition:.3s;

}

.accordion-button:not(.collapsed)::after{

    content:"\2212";

    background-color:var(--primary);

    color:#fff;

    transform:rotate(180deg);

}

.accordion-body{

    padding:4px 26px 26px;

    color:var(--muted);

    line-height:1.8;

}

.accordion-collapse{

    transition:.35s ease;

}

/* =====================================
   CONTACT
===================================== */

#contact{

    background:var(--bg-light);

}

.contact-card{

    background:#fff;

    border:1px solid var(--border);

    border-radius:var(--radius-md);

    padding:30px 26px;

    height:100%;

    transition:.25s;

}

.contact-card:hover{

    transform:translateY(-6px);

    box-shadow:var(--shadow-md);

    border-color:#c9dcff;

}

.contact-icon{

    width:52px;

    height:52px;

    border-radius:14px;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:1.3rem;

    margin-bottom:18px;

}

.contact-card h5{

    color:var(--text);

    font-weight:700;

    margin-bottom:6px;

    font-size:1.02rem;

}

.contact-card p{

    color:var(--muted);

    font-size:.92rem;

    line-height:1.6;

    margin:0;

}

.contact-map{

    background:#fff;

    border:1px solid var(--border);

    border-radius:18px;

    overflow:hidden;

    padding:0;

    min-height:100%;

    box-shadow:var(--shadow-sm);

    transition:.25s;

}

.contact-map:hover{

    box-shadow:var(--shadow-md);

    transform:translateY(-4px);

}

.contact-map iframe{

    width:100%;

    height:320px;

    border:0;

    border-radius:18px;

    display:block;

}

/* =====================================
   FOOTER
===================================== */

footer{

    background:linear-gradient(160deg,#0b1e3d,#0f2a52);

    color:rgba(255,255,255,.72);

    padding:56px 0 0;

}

.footer-top{

    display:grid;

    grid-template-columns:1.4fr 1fr 1fr 1.2fr;

    gap:32px;

    padding-bottom:36px;

    border-bottom:1px solid rgba(255,255,255,.1);

}

.footer-social{

    display:flex;

    gap:10px;

    margin-top:16px;

}

.footer-social a{

    width:36px;

    height:36px;

    border-radius:50%;

    background:rgba(255,255,255,.08);

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:.95rem;

    text-decoration:none;

    transition:.25s;

}

.footer-social a:hover{

    background:var(--primary-light);

    transform:translateY(-3px);

}

.footer-brand{

    display:flex;

    align-items:center;

    gap:12px;

    margin-bottom:16px;

}

.footer-brand img{

    width:42px;

    height:42px;

    object-fit:contain;

}

.footer-brand strong{

    display:block;

    color:#fff;

    font-size:1rem;

}

.footer-brand small{

    color:rgba(255,255,255,.55);

}

.footer-col h6{

    color:#fff;

    font-weight:700;

    margin-bottom:18px;

    font-size:.95rem;

}

.footer-col p{

    font-size:.9rem;

    line-height:1.9;

    color:rgba(255,255,255,.65);

    max-width:320px;

}

.footer-links a{

    display:block;

    color:rgba(255,255,255,.68);

    text-decoration:none;

    font-size:.9rem;

    margin-bottom:12px;

    transition:.2s;

}

.footer-links a:hover{

    color:#fff;

    padding-left:4px;

}

.footer-contact li{

    display:flex;

    gap:10px;

    align-items:flex-start;

    font-size:.9rem;

    margin-bottom:14px;

    list-style:none;

    color:rgba(255,255,255,.68);

}

.footer-contact i{

    color:var(--primary-light);

    margin-top:3px;

}

.footer-bottom{

    display:flex;

    justify-content:space-between;

    align-items:center;

    flex-wrap:wrap;

    gap:10px;

    padding:24px 0;

    font-size:.84rem;

    color:rgba(255,255,255,.5);

}

/* =====================================
   CHAT FAB
===================================== */

.chat-fab{

    position:fixed;

    right:26px;

    bottom:26px;

    width:58px;

    height:58px;

    border-radius:50%;

    border:none;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    font-size:1.45rem;

    box-shadow:0 14px 30px -8px rgba(37,99,235,.6);

    z-index:1050;

    display:flex;

    align-items:center;

    justify-content:center;

    transition:.2s;

}

.chat-fab:hover{

    transform:translateY(-3px) scale(1.05);

}

/* =====================================
   RESPONSIVE
===================================== */

@media(max-width:1199px){

    .service-grid{

        grid-template-columns:repeat(2,1fr);

    }

    .footer-top{

        grid-template-columns:1fr 1fr;

    }

}

@media(max-width:991px){

    .hero-title{

        font-size:2.5rem;

    }

    .hero-right{

        margin-top:44px;

    }

    .service-grid{

        max-height:none;

        overflow:visible;

    }

    .flow-track::before{

        display:none;

    }

    .flow-card{

        margin-bottom:28px;

    }

}

@media(max-width:767px){

    section{

        padding:76px 0;

    }

    .nav-wrap{

        padding:0 14px;

    }

    .hero-title{

        font-size:2.1rem;

    }

    .hero-text{

        font-size:1rem;

    }

    .service-grid{

        grid-template-columns:repeat(2,1fr);

    }

    .footer-top{

        grid-template-columns:1fr;

    }

}

</style>

{{-- ===================== NAVBAR (FLOATING) ===================== --}}

<div class="nav-wrap">

<nav class="navbar navbar-expand-lg">

    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a class="navbar-brand" href="#hero">

            <img
                src="{{ asset('images/logo-pemalang.png') }}"
                class="logo-pemalang"
                alt="Logo Pemalang">

            <div class="brand-title">

                <strong>

                    Helpdesk Diskominfo

                </strong>

                <small>

                    Kabupaten Pemalang

                </small>

            </div>

        </a>

        <button
            class="navbar-toggler border-0"
            data-bs-toggle="collapse"
            data-bs-target="#navbarLanding">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse flex-grow-0"
            id="navbarLanding">

            <ul class="navbar-nav align-items-lg-center mx-lg-2">

                <li class="nav-item">

                    <a class="nav-link" href="#hero">Beranda</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="#services">Layanan</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="#flow">Alur</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="#faq">FAQ</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="#contact">Kontak</a>

                </li>

            </ul>

            <a
                href="{{ route('login') }}"
                class="btn btn-primary btn-login ms-lg-2 mt-3 mt-lg-0 d-inline-block">

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Login

            </a>

        </div>

    </div>

</nav>

</div>

{{-- ===================== HERO ===================== --}}

<section id="hero">

    <span class="hero-dot-pattern"></span>

    <div class="container">

        <div class="row align-items-center g-5">

            {{-- LEFT --}}

            <div class="col-lg-5">

                <div class="hero-content" data-aos="fade-right" data-aos-duration="800">

                    <div class="hero-eyebrow">

                        <i class="bi bi-shield-check"></i>

                        Portal Layanan Teknologi Informasi

                    </div>

                    <h1 class="hero-title">

                        Helpdesk <span>Diskominfo</span> Kabupaten Pemalang

                    </h1>

                    <p class="hero-text">

                        Portal layanan resmi Dinas Komunikasi dan Informatika
                        Kabupaten Pemalang untuk pengajuan layanan Teknologi
                        Informasi, Infrastruktur Jaringan, Website Pemerintah,
                        Email Pemerintah, Hosting, Domain, serta layanan TIK
                        lainnya secara mudah, cepat, dan transparan.

                    </p>

                    <div class="hero-cta">

                        <a
                            href="{{ route('login') }}"
                            class="btn-hero-primary">

                            <i class="bi bi-send-fill me-2"></i>

                            Ajukan Layanan

                        </a>

                        <a
                            href="#services"
                            class="btn-hero-outline">

                            Lihat Layanan

                        </a>

                    </div>

                    <a href="#contact" class="hero-quick">

                        <span class="hero-quick-icon">
                            <i class="bi bi-headset"></i>
                        </span>

                        <span class="hero-quick-text">
                            <strong>Pengaduan</strong>
                            <small>Sampaikan kendala layanan TIK Anda</small>
                        </span>

                        <span class="hero-quick-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </span>

                    </a>

                </div>

            </div>

            {{-- RIGHT: SEARCH + SERVICE GRID --}}

            <div class="col-lg-7">

                <div class="hero-right" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">

                    <form
                        class="hero-search"
                        action="#services">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            id="searchService"
                            placeholder="Cari layanan yang Anda butuhkan...">

                        <button
                            type="button"
                            class="hero-search-btn"
                            onclick="searchService()">

                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </form>

                    <div class="service-grid">

                        @forelse($services as $service)

                        <div class="service-item">

                            <button
                                type="button"
                                class="service-card"
                                data-bs-toggle="modal"
                                data-bs-target="#serviceModal{{ $service->id }}">

                                <span class="service-thumb">

                                    <span class="service-arrow">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </span>

                                    <img
                                        src="{{ asset('images/logo-pemalang.png') }}"
                                        alt="{{ $service->nama_layanan }}">

                                </span>

                                <span class="service-label">

                                    {{ $service->nama_layanan }}

                                </span>

                            </button>

                        </div>

                        @empty

                        <div class="service-item" style="grid-column:1/-1;">

                            <div class="alert alert-light border text-center mb-0">

                                Belum ada layanan yang tersedia.

                            </div>

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ===================== LAYANAN (FULL GRID) ===================== --}}

<section id="services">

    <div class="container">

        <div class="section-title" data-aos="fade-up">

            <span class="eyebrow">Layanan TIK</span>

            <h2>Daftar Layanan</h2>

            <p>

                Pilih layanan yang sesuai dengan kebutuhan Anda.
                Seluruh permohonan layanan dilakukan secara online
                melalui Portal Helpdesk Diskominfo Kabupaten Pemalang.

            </p>

        </div>

        <div class="row g-4">

            @forelse($services as $service)

            <div class="col-lg-3 col-md-4 col-6 service-item" data-aos="fade-up">

                <button
                    type="button"
                    class="service-card w-100 h-100"
                    data-bs-toggle="modal"
                    data-bs-target="#serviceModal{{ $service->id }}">

                    <span class="service-thumb">

                        <span class="service-arrow">
                            <i class="bi bi-arrow-up-right"></i>
                        </span>

                        <img
                            src="{{ asset('images/logo-pemalang.png') }}"
                            alt="{{ $service->nama_layanan }}">

                    </span>

                    <span class="service-label">

                        {{ $service->nama_layanan }}

                    </span>

                </button>

            </div>

            @empty

            <div class="col-12">

                <div class="alert alert-light border text-center">

                    Belum ada layanan yang tersedia.

                </div>

            </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ===================== ALUR LAYANAN ===================== --}}

<section id="flow">

    <div class="container">

        <div class="section-title light" data-aos="fade-up">

            <span class="eyebrow">Alur Layanan</span>

            <h2>Alur Pengajuan Layanan</h2>

            <p>

                Ikuti tahapan berikut untuk mengajukan layanan
                pada Helpdesk Diskominfo Kabupaten Pemalang.

            </p>

        </div>

        <div class="row g-4 flow-track">

            <div class="col-lg" data-aos="fade-up" data-aos-delay="0">

                <div class="flow-card">

                    <div class="flow-icon">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </div>

                    <h5>Login</h5>

                    <p>Masuk menggunakan akun Helpdesk.</p>

                </div>

            </div>

            <div class="col-lg" data-aos="fade-up" data-aos-delay="100">

                <div class="flow-card">

                    <div class="flow-icon">
                        <i class="bi bi-ui-checks-grid"></i>
                    </div>

                    <h5>Pilih Layanan</h5>

                    <p>Pilih layanan sesuai kebutuhan.</p>

                </div>

            </div>

            <div class="col-lg" data-aos="fade-up" data-aos-delay="200">

                <div class="flow-card">

                    <div class="flow-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h5>Isi Formulir</h5>

                    <p>Lengkapi data permohonan.</p>

                </div>

            </div>

            <div class="col-lg" data-aos="fade-up" data-aos-delay="300">

                <div class="flow-card">

                    <div class="flow-icon">
                        <i class="bi bi-patch-check"></i>
                    </div>

                    <h5>Verifikasi</h5>

                    <p>Petugas melakukan verifikasi data.</p>

                </div>

            </div>

            <div class="col-lg" data-aos="fade-up" data-aos-delay="400">

                <div class="flow-card">

                    <div class="flow-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <h5>Selesai</h5>

                    <p>Layanan selesai dan dapat dipantau.</p>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ===================== FAQ ===================== --}}

<section id="faq">

    <div class="container">

        <div class="section-title" data-aos="fade-up">

            <span class="eyebrow">Bantuan</span>

            <h2>Pertanyaan Umum</h2>

            <p>

                Informasi yang sering ditanyakan mengenai layanan Helpdesk.

            </p>

        </div>

        <div class="accordion" id="faqAccordion">

            <div class="accordion-item" data-aos="fade-up">

                <h2 class="accordion-header">

                    <button class="accordion-button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1">

                        Bagaimana cara mengajukan layanan?

                    </button>

                </h2>

                <div id="faq1"
                     class="accordion-collapse collapse show">

                    <div class="accordion-body">

                        Login ke sistem, pilih layanan,
                        kemudian isi formulir pengajuan.

                    </div>

                </div>

            </div>

            <div class="accordion-item" data-aos="fade-up">

                <h2 class="accordion-header">

                    <button class="accordion-button collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2">

                        Apakah layanan ini gratis?

                    </button>

                </h2>

                <div id="faq2"
                     class="accordion-collapse collapse">

                    <div class="accordion-body">

                        Seluruh layanan Helpdesk Diskominfo
                        Kabupaten Pemalang tidak dipungut biaya.

                    </div>

                </div>

            </div>

            <div class="accordion-item" data-aos="fade-up">

                <h2 class="accordion-header">

                    <button class="accordion-button collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3">

                        Bagaimana mengetahui status tiket?

                    </button>

                </h2>

                <div id="faq3"
                     class="accordion-collapse collapse">

                    <div class="accordion-body">

                        Status dapat dipantau melalui menu
                        Riwayat Tiket setelah login.

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ===================== KONTAK ===================== --}}

<section id="contact">

    <div class="container">

        <div class="section-title" data-aos="fade-up">

            <span class="eyebrow">Kontak</span>

            <h2>Kontak Kami</h2>

            <p>

                Hubungi kami apabila membutuhkan bantuan
                seputar layanan Helpdesk Diskominfo Kabupaten Pemalang.

            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="contact-card" data-aos="fade-up">

                    <div class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <h5>Alamat</h5>

                    <p>Jl. Surohadikusumo No. 1, Pemalang, Jawa Tengah</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="contact-card" data-aos="fade-up">

                    <div class="contact-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>

                    <h5>Email</h5>

                    <p>diskominfo@pemalangkab.go.id</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="contact-card" data-aos="fade-up">

                    <div class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>

                    <h5>Telepon</h5>

                    <p>(0284) XXXXXXX</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="contact-card" data-aos="fade-up">

                    <div class="contact-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>

                    <h5>Jam Operasional</h5>

                    <p>Senin – Jumat, 08.00 – 16.00 WIB</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="contact-card" data-aos="fade-up">

                    <div class="contact-icon">
                        <i class="bi bi-globe2"></i>
                    </div>

                    <h5>Website</h5>

                    <p>diskominfo.pemalangkab.go.id</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="contact-map">

                    <iframe
                        src="https://www.google.com/maps?q=-6.8935216,109.3804554&z=17&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                        title="Lokasi Kantor Diskominfo Kabupaten Pemalang">
                    </iframe>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- ===================== FOOTER ===================== --}}

<footer>

    <div class="container">

        <div class="footer-top">

            <div class="footer-col">

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

                <div class="footer-social">

                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" aria-label="Twitter/X"><i class="bi bi-twitter-x"></i></a>

                </div>

            </div>

            <div class="footer-col footer-links">

                <h6>Navigasi</h6>

                <a href="#hero">Beranda</a>
                <a href="#services">Layanan</a>
                <a href="#flow">Alur Layanan</a>
                <a href="#faq">FAQ</a>

            </div>

            <div class="footer-col footer-links">

                <h6>Bantuan</h6>

                <a href="#contact">Kontak Kami</a>
                <a href="{{ route('login') }}">Login</a>
                <a href="#faq">Pertanyaan Umum</a>

            </div>

            <div class="footer-col">

                <h6>Hubungi Kami</h6>

                <ul class="footer-contact">

                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Surohadikusumo No. 1, Pemalang, Jawa Tengah</span>
                    </li>

                    <li>
                        <i class="bi bi-telephone-fill"></i>
                        <span>(0284) XXXXXXX</span>
                    </li>

                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        <span>diskominfo@pemalangkab.go.id</span>
                    </li>

                </ul>

            </div>

        </div>

        <div class="footer-bottom">

            <div>

                © {{ date('Y') }} Helpdesk Diskominfo Kabupaten Pemalang. Seluruh hak cipta dilindungi.

            </div>

            <div>

                Dikembangkan oleh Diskominfo Kabupaten Pemalang

            </div>

        </div>

    </div>

</footer>

<button type="button" class="chat-fab" aria-label="Hubungi Kami">

    <i class="bi bi-chat-dots-fill"></i>

</button>

{{-- Modal Detail Layanan --}}
@foreach($services as $service)

<div
    class="modal fade"
    id="serviceModal{{ $service->id }}"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header" style="background:linear-gradient(135deg,var(--primary),var(--primary-light));color:#fff;">

                <h5 class="modal-title">

                    {{ $service->nama }}

                </h5>

                <button
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body p-4">

                <div class="row">

                    <div class="col-md-6">

                        <h6 class="fw-bold mb-3">

                            Informasi Layanan

                        </h6>

                        <p>

                            <strong>Bidang :</strong>

                            {{ $service->bidang }}

                        </p>

                        <p>

                            <strong>Estimasi :</strong>

                            {{ $service->estimasi }} Hari Kerja

                        </p>

                    </div>

                    <div class="col-md-6">

                        <h6 class="fw-bold mb-3">

                            Deskripsi

                        </h6>

                        <p>

                            {{ $service->deskripsi }}

                        </p>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <a
                    href="{{ route('login') }}"
                    class="btn btn-primary rounded-pill px-4">

                    Login untuk Mengajukan

                </a>

            </div>

        </div>

    </div>

</div>
@endforeach
<script>

function searchService(){

    let keyword=document
        .getElementById("searchService")
        .value
        .toLowerCase();

    document.querySelectorAll(".service-item").forEach(item=>{

        let text=item.innerText.toLowerCase();

        if(text.includes(keyword)){

            item.style.display="block";

        }else{

            item.style.display="none";

        }

    });

}

document
.getElementById("searchService")
.addEventListener("keyup",function(e){

    if(e.key==="Enter"){

        searchService();

    }

});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
<script>

    AOS.init({
        duration:700,
        easing:"ease-out-cubic",
        once:true,
        offset:60
    });

    (function(){

        let sections=document.querySelectorAll("section[id]");
        let navLinks=document.querySelectorAll(".nav-link");

        function onScroll(){

            let scrollPos=window.scrollY+120;

            sections.forEach(function(sec){

                if(scrollPos>=sec.offsetTop && scrollPos<sec.offsetTop+sec.offsetHeight){

                    navLinks.forEach(function(link){

                        link.classList.remove("active");

                        if(link.getAttribute("href")==="#"+sec.id){

                            link.classList.add("active");

                        }

                    });

                }

            });

        }

        window.addEventListener("scroll",onScroll);
        onScroll();

    })();

</script>

@endsection
