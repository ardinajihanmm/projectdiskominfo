@extends('layouts.landing')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
    --radius-sm:12px;

    --shadow-sm:0 4px 16px rgba(15,23,42,.06);
    --shadow-md:0 16px 36px rgba(37,99,235,.14);
    --shadow-lg:0 26px 60px rgba(37,99,235,.18);

    --sp-1:8px;
    --sp-2:16px;
    --sp-3:24px;
    --sp-4:32px;
    --sp-5:48px;
    --sp-6:64px;
    --sp-7:88px;

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

    font-family:'Plus Jakarta Sans',sans-serif;

    color:var(--text);

    background:var(--white);

    overflow-x:hidden;

}

section{

    padding:var(--sp-7) 0;

}

.container{

    max-width:1260px;

}

img{

    max-width:100%;

}

@media(prefers-reduced-motion:reduce){

    *{

        animation:none!important;

        transition:none!important;

    }

}

/* =====================================
   FLOATING NAVBAR
===================================== */

.nav-wrap{
    position:sticky;
    top:0;
    z-index:999;

    /* Background biru di belakang navbar */
    background:var(--bg-hero);

    /* Tetap memberi jarak di atas, kiri, dan kanan navbar */
    padding:16px 24px 0;
}

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

    transition:padding .3s ease,box-shadow .3s ease,background .3s ease;

}

.nav-wrap.is-scrolled .navbar{

    padding:9px 14px 9px 18px;

    background:rgba(255,255,255,.86);

    box-shadow:0 6px 22px rgba(15,23,42,.1);

}

.nav-wrap.is-scrolled .logo-pemalang{

    width:36px;

    height:36px;

}

.navbar-brand{

    display:flex;

    align-items:center;

    gap:12px;

    font-weight:700;

}

.logo-pemalang{

    width:42px;

    height:42px;

    object-fit:contain;

    flex-shrink:0;

}

.brand-title{

    line-height:1.15;

    text-align:left;

}

.brand-title strong{

    display:block;

    font-size:1rem;
    font-weight:700;
    color:var(--text);
    letter-spacing:.01em;

}

.brand-title small{

    color:var(--muted);

    font-size:.72rem;
    font-weight:500;

}

.nav-link{

    position:relative;

    color:#475569!important;

    font-weight:500;

    font-size:.94rem;

    margin:0 2px;

    padding:9px 16px!important;

    border-radius:999px;

    transition:.2s;

}

.nav-link:hover{

    color:var(--primary)!important;

    background:var(--bg-soft);

}

.nav-link.active{

    color:var(--primary)!important;

    background:var(--bg-soft);

    font-weight:600;

}

.btn-login{

    border-radius:999px;

    padding:10px 24px;

    font-weight:600;

    font-size:.92rem;

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

    background:linear-gradient(180deg,var(--bg-hero) 0%,var(--white) 100%);

    padding:var(--sp-6) 0 var(--sp-6);

    min-height:auto;

}

#hero::before,
#hero::after{

    content:"";

    position:absolute;

    border-radius:50%;

    filter:blur(70px);

    z-index:0;

    pointer-events:none;

}

#hero::before{

    width:420px;

    height:420px;

    background:radial-gradient(circle,rgba(37,99,235,.16),transparent 70%);

    top:-160px;

    right:-100px;

    animation:blobFloat 12s ease-in-out infinite;

}

#hero::after{

    width:340px;

    height:340px;

    background:radial-gradient(circle,rgba(59,130,246,.14),transparent 70%);

    bottom:-140px;

    left:-90px;

    animation:blobFloat 14s ease-in-out infinite reverse;

}

@keyframes blobFloat{

    0%,100%{ transform:translate(0,0); }
    50%{ transform:translate(20px,-16px); }

}

.hero-pattern{

    position:absolute;

    inset:0;

    z-index:0;

    opacity:.5;

    background-image:radial-gradient(rgba(37,99,235,.12) 1.4px,transparent 1.4px);

    background-size:26px 26px;

    -webkit-mask-image:radial-gradient(ellipse 60% 50% at 50% 0%,#000 30%,transparent 75%);

    mask-image:radial-gradient(ellipse 60% 50% at 50% 0%,#000 30%,transparent 75%);

}

#hero .container{

    position:relative;

    z-index:1;

}

.hero-eyebrow{

    display:inline-flex;

    align-items:center;

    gap:8px;

    background:var(--white);

    color:var(--primary);

    border:1px solid #dbe6ff;

    padding:7px 16px;

    border-radius:999px;

    margin-bottom:20px;

    font-size:.83rem;
    font-weight:600;

    box-shadow:var(--shadow-sm);

}

.hero-eyebrow i{

    font-size:.88rem;

}

.hero-title{
 display:flex;
    flex-direction:column;
    font-size:2.85rem;

    font-weight:800;

    line-height:1;

    letter-spacing:-.02em;

    color:var(--text);

    margin-bottom:14px;

}

.hero-title span{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    -webkit-background-clip:text;

    background-clip:text;

    color:transparent;

}

.hero-text{

    font-size:1.02rem;

    color:var(--muted);

    max-width:520px;

    line-height:1.8;

    margin-bottom:0px;

}

.hero-cta{

    display:flex;

    flex-wrap:wrap;

    gap:14px;

    margin-bottom:24px;

}

.btn-hero-primary{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    border:none;

    padding:14px 28px;

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

    padding:14px 28px;

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


/* ---- hero right: search + service grid ---- */

.hero-right{

    background:linear-gradient(160deg,rgba(255,255,255,.85),rgba(238,245,255,.65));

    backdrop-filter:blur(14px);

    border:1px solid rgba(255,255,255,.85);

    border-radius:var(--radius-lg);

    padding:var(--sp-3);

    box-shadow:var(--shadow-md);

}

.hero-search{

    position:relative;

    margin-bottom:var(--sp-2);

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

    border:1.5px solid var(--border);

    background:#fff;

    border-radius:999px;

    padding:18px 62px 18px 54px;

    font-size:.96rem;

    box-shadow:0 10px 28px rgba(15,23,42,.07);

    transition:.25s;

}

.hero-search input:focus{

    outline:none;

    border-color:var(--primary);

    box-shadow:0 0 0 5px rgba(37,99,235,.14),0 14px 30px rgba(37,99,235,.14);

}

.hero-search-btn{

    position:absolute;

    right:6px;

    top:50%;

    transform:translateY(-50%);

    width:46px;

    height:46px;

    border:none;

    border-radius:50%;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:1.05rem;

    transition:.25s;

    box-shadow:0 10px 20px -6px rgba(37,99,235,.55);

}

.hero-search-btn:hover{

    transform:translateY(-50%) scale(1.08);

}

.hero-search-btn i{

    transition:.25s;

}

.hero-search-btn:hover i{

    transform:translateX(2px);

}

.service-grid{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:var(--sp-2);

    max-height:360px;

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

    background:linear-gradient(165deg,#ffffff,#fbfdff);

    border:1px solid var(--border);

    border-radius:22px;

    overflow:hidden;

    cursor:pointer;

    transition:.35s cubic-bezier(.22,1,.36,1);

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

    transform:translateY(-10px) scale(1.015);

    box-shadow:var(--shadow-lg);

    border-color:#c9dcff;

}

.service-card:hover .service-thumb img{

    transform:scale(1.1);

}

.service-card:hover .service-arrow{

    background:var(--primary);

    color:#fff;

    transform:translate(3px,-3px);

}

.service-arrow{

    position:absolute;

    top:14px;

    right:14px;

    width:32px;

    height:32px;

    border-radius:50%;

    background:#fff;

    color:var(--primary);

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:.88rem;

    box-shadow:var(--shadow-sm);

    transition:.3s;

    z-index:2;

}

.service-thumb{

    position:relative;

    background:linear-gradient(135deg,var(--bg-soft),#e2ecff);

    display:flex;

    align-items:center;

    justify-content:center;

    padding:var(--sp-4);

    height:128px;

}

.service-thumb img{

    max-height:68px;

    width:auto;

    object-fit:contain;

    transition:.4s ease;

}
.service-label{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    font-size:.82rem;

    font-weight:600;

    line-height:1.3;

    padding:10px 12px;

    min-height:48px;

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

    margin:0 auto var(--sp-5);

}

.section-title .eyebrow{

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

.section-title h2{

    font-size:2.3rem;

    font-weight:800;

    letter-spacing:-.02em;

    color:var(--text);

    margin-bottom:var(--sp-2);

}

.section-title p{

    color:var(--muted);

    line-height:1.8;

    font-size:1rem;

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

    overflow:hidden;

    background:#f7faff;

}

#services::before{

    content:"";

    position:absolute;

    width:360px;

    height:360px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(37,99,235,.08),transparent 70%);

    top:-140px;

    right:-100px;

    filter:blur(50px);

    z-index:0;

}

#services::after{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(59,130,246,.07),transparent 70%);

    bottom:-120px;

    left:-90px;

    filter:blur(50px);

    z-index:0;

}

#services .dot-pattern{

    position:absolute;

    inset:0;

    z-index:0;

    opacity:.6;

    background-image:radial-gradient(rgba(37,99,235,.1) 1.4px,transparent 1.4px);

    background-size:26px 26px;

    -webkit-mask-image:radial-gradient(ellipse 70% 60% at 50% 40%,#000 30%,transparent 78%);

    mask-image:radial-gradient(ellipse 70% 60% at 50% 40%,#000 30%,transparent 78%);

}

#services .container{

    position:relative;

    z-index:1;

}

.service-item .service-card{

    height:100%;

}

/* =====================================
   TIMELINE PENGAJUAN (single section)
===================================== */

#flow{

    position:relative;

    overflow:hidden;

    background:#f7faff;

}

#flow::before{

    content:"";

    position:absolute;

    width:300px;

    height:300px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(37,99,235,.07),transparent 70%);

    top:-120px;

    left:-80px;

    filter:blur(50px);

}

#flow::after{

    content:"";

    position:absolute;

    width:260px;

    height:260px;

    border-radius:50%;

    background:radial-gradient(circle,rgba(59,130,246,.07),transparent 70%);

    bottom:-100px;

    right:-70px;

    filter:blur(50px);

}

.timeline{

    position:relative;

    z-index:1;

    background:#fff;

    border:1px solid var(--border);

    border-radius:var(--radius-lg);

    box-shadow:var(--shadow-sm);

    padding:var(--sp-5) var(--sp-4);

}

.timeline-track{

    position:relative;

    display:grid;

    grid-template-columns:repeat(5,1fr);

    gap:var(--sp-3);

}

.timeline-track::before{

    content:"";

    position:absolute;

    top:38px;

    left:8%;

    right:8%;

    height:2px;

    background:linear-gradient(90deg,transparent,var(--border) 10%,var(--border) 90%,transparent);

}

.timeline-step{

    position:relative;

    text-align:center;

    padding:0 8px;

}

.timeline-icon{

    position:relative;

    z-index:1;

    width:76px;

    height:76px;

    border-radius:50%;

    background:linear-gradient(135deg,var(--bg-soft),#e2ecff);

    color:var(--primary);

    display:flex;

    align-items:center;

    justify-content:center;

    margin:0 auto var(--sp-2);

    font-size:1.85rem;

    transition:.3s;

}

.timeline-step:hover .timeline-icon{
    transform:translateY(-4px) scale(1.06);
    filter:brightness(.95);
    box-shadow:0 14px 28px -8px rgba(37,99,235,.25);
}

.timeline-no{

    position:absolute;

    top:-2px;

    right:calc(50% - 46px);

    width:24px;

    height:24px;

    border-radius:50%;

    background:var(--primary);

    color:#fff;

    font-size:.72rem;

    font-weight:700;

    display:flex;

    align-items:center;

    justify-content:center;

    z-index:2;

    box-shadow:0 4px 10px rgba(37,99,235,.35);

}

.timeline-step h5{

    color:var(--text);

    font-weight:700;

    font-size:1rem;

    margin-bottom:6px;

}

.timeline-step p{

    color:var(--muted);

    font-size:.85rem;

    line-height:1.6;

}

.timeline-cta{

    text-align:center;

    margin-top:var(--sp-5);

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

    padding:var(--sp-4) var(--sp-3);

    height:100%;

    transition:.25s;

}

.contact-card:hover{

    transform:translateY(-6px);

    box-shadow:var(--shadow-md);

    border-color:#c9dcff;

}

.contact-icon{

    width:50px;

    height:50px;

    border-radius:14px;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:1.25rem;

    margin-bottom:var(--sp-2);

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

.contact-map-card{

    background:#fff;

    border:1px solid var(--border);

    border-radius:22px;

    overflow:hidden;

    height:100%;

    transition:.3s;

    display:flex;

    flex-direction:column;

}

.contact-map-card:hover{

    transform:translateY(-6px);

    box-shadow:var(--shadow-md);

    border-color:#c9dcff;

}

.contact-map-frame{

    overflow:hidden;

    height:220px;

}

.contact-map-card iframe{

    width:100%;

    height:220px;

    border:0;

    display:block;

    transition:transform .5s ease;

}

.contact-map-card:hover iframe{

    transform:scale(1.06);

}

.contact-map-card .contact-map-body{

    padding:var(--sp-3);

}

/* =====================================
   FOOTER
===================================== */

footer{

    position:relative;

    background:linear-gradient(180deg,var(--navy-deep),#050f22);

    color:rgba(255,255,255,.72);

     padding:20px 0 0;

}

footer::before{

    content:"";

    position:absolute;

    top:0;

    left:0;

    right:0;

    height:3px;

    background:linear-gradient(90deg,var(--primary-dark),var(--primary),var(--primary-light),var(--primary));

}

.footer-top{

    display:grid;

    grid-template-columns:1.3fr 1fr 1.1fr;
    gap:4px;
    padding-bottom:4px;

    border-bottom:1px solid rgba(255,255,255,.08);

}

.footer-brand{

    display:flex;

    align-items:center;

    gap:12px;

    margin-bottom:var(--sp-2);

}

.footer-brand img{

    width:40px;

    height:40px;

    object-fit:contain;

}

.footer-brand strong{

    display:block;

    color:#fff;

    font-size:.98rem;

}

.footer-brand small{

    color:rgba(255,255,255,.55);

}

.footer-col p{

    font-size:.88rem;

    line-height:1.85;

    color:rgba(255,255,255,.62);

    max-width:320px;

    margin-bottom:var(--sp-2);

}

.footer-social{

    display:flex;

    gap:10px;

}

.footer-social a{

    width:38px;

    height:38px;

    border-radius:50%;

    background:rgba(255,255,255,.08);

    border:1px solid rgba(255,255,255,.14);

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:.95rem;

    transition:.2s;

}

.footer-social a:hover{

    background:var(--primary);

    border-color:var(--primary);

    transform:translateY(-3px);

}

.footer-col h6{

    color:#fff;

    font-weight:700;

    margin-bottom:var(--sp-2);

    font-size:.92rem;

}

.footer-links a{

    display:block;

    color:rgba(255,255,255,.65);

    text-decoration:none;

    font-size:.88rem;

    margin-bottom:11px;

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

    font-size:.88rem;

    margin-bottom:12px;

    list-style:none;

    color:rgba(255,255,255,.65);

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
    padding:8px 0;
    font-size:.82rem;

    color:rgba(255,255,255,.48);

}

/* =====================================
   CHAT FAB
===================================== */

.chat-fab{

    position:fixed;

    right:26px;

    bottom:26px;

    width:56px;

    height:56px;

    border-radius:50%;

    border:none;

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    font-size:1.4rem;

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

.chat-fab i{

    transition:.25s;

}

.chat-fab:hover i{

    transform:scale(1.1) rotate(-6deg);

}

/* ---- Back to top ---- */

.back-to-top{

    position:fixed;

    right:26px;

    bottom:92px;

    width:44px;

    height:44px;

    border-radius:50%;

    border:1px solid var(--border);

    background:#fff;

    color:var(--primary);

    font-size:1.05rem;

    box-shadow:var(--shadow-sm);

    z-index:1049;

    display:flex;

    align-items:center;

    justify-content:center;

    opacity:0;

    visibility:hidden;

    transform:translateY(10px);

    transition:.3s;

}

.back-to-top.is-visible{

    opacity:1;

    visibility:visible;

    transform:translateY(0);

}

.back-to-top:hover{

    background:var(--primary);

    color:#fff;

    transform:translateY(-3px);

}

/* ---- Chat panel (functional, not a dead placeholder) ---- */

.chat-panel{

    position:fixed;

    right:26px;

    bottom:96px;

    width:300px;

    background:#fff;

    border-radius:var(--radius-md);

    box-shadow:var(--shadow-lg);

    border:1px solid var(--border);

    overflow:hidden;

    z-index:1051;

    opacity:0;

    visibility:hidden;

    transform:translateY(16px) scale(.97);

    transition:.25s ease;

}

.chat-panel.is-open{

    opacity:1;

    visibility:visible;

    transform:translateY(0) scale(1);

}

.chat-panel-head{

    background:linear-gradient(135deg,var(--primary),var(--primary-light));

    color:#fff;

    padding:16px 18px;

    display:flex;

    align-items:center;

    justify-content:space-between;

}

.chat-panel-head strong{

    font-size:.94rem;

}

.chat-panel-head small{

    display:block;

    opacity:.85;

    font-size:.76rem;

}

.chat-panel-close{

    background:rgba(255,255,255,.18);

    border:none;

    color:#fff;

    width:26px;

    height:26px;

    border-radius:50%;

    font-size:.8rem;

}

.chat-panel-body{

    padding:16px 18px;

}

.chat-panel-body a{

    display:flex;

    align-items:center;

    gap:10px;

    padding:10px 12px;

    border:1px solid var(--border);

    border-radius:12px;

    color:var(--text);

    font-size:.86rem;

    margin-bottom:10px;

    transition:.2s;

}

.chat-panel-body a:hover{

    border-color:#c9dcff;

    background:var(--bg-soft);

    color:var(--primary);

    transform:translateX(2px);

}

.chat-panel-body a i{

    color:var(--primary);

    font-size:1rem;

}

/* ---- Ripple ---- */

.ripple-el{

    position:relative;

    overflow:hidden;

}

.ripple-dot{

    position:absolute;

    border-radius:50%;

    background:rgba(255,255,255,.55);

    transform:scale(0);

    animation:rippleAnim .6s ease-out;

    pointer-events:none;

}

.btn-hero-outline .ripple-dot,
.hero-quick .ripple-dot,
.service-card .ripple-dot,
.contact-card .ripple-dot,
.flow-card .ripple-dot{

    background:rgba(37,99,235,.16);

}

@keyframes rippleAnim{

    to{

        transform:scale(2.6);

        opacity:0;

    }

}

/* ---- Preloader ---- */

#pageLoader{

    position:fixed;

    inset:0;

    z-index:2000;

    background:#f7faff;

    display:flex;

    align-items:center;

    justify-content:center;

    transition:opacity .45s ease,visibility .45s ease;

}

#pageLoader.is-hidden{

    opacity:0;

    visibility:hidden;

}

.loader-ring{

    width:44px;

    height:44px;

    border-radius:50%;

    border:3px solid var(--border);

    border-top-color:var(--primary);

    animation:loaderSpin .8s linear infinite;

}

@keyframes loaderSpin{

    to{ transform:rotate(360deg); }

}
/* Login */
.timeline-icon.login{
    background:#E8F1FF;
    color:#2563EB;
}

/* Pilih Layanan */
.timeline-icon.layanan{
    background:#ECFDF5;
    color:#16A34A;
}

/* Isi Formulir */
.timeline-icon.formulir{
    background:#FFF7E6;
    color:#F59E0B;
}

/* Verifikasi */
.timeline-icon.verifikasi{
    background:#F3E8FF;
    color:#9333EA;
}

/* Selesai */
.timeline-icon.selesai{
    background:#E0F7F4;
    color:#0F766E;
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

    section{

        padding:var(--sp-6) 0;

    }

    .hero-title{

        font-size:2.35rem;

    }

    .hero-right{

        margin-top:var(--sp-4);

    }

    .service-grid{

        max-height:none;

        overflow:visible;

    }

    .flow-track::before{

        display:none;

    }

    .flow-card{

        margin-bottom:var(--sp-4);

    }

}

@media(max-width:767px){

    section{

        padding:var(--sp-5) 0;

    }

    .nav-wrap{

        padding:0 14px;
        background:var(--bg-hero);

    }

    .hero-title{

        font-size:2rem;

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

.hero-title{
    display:flex;
    flex-direction:column;
    line-height:1;
    margin-bottom:22px;
}

.hero-title .title-small{
    font-size:2.4rem;      
    font-weight:790;
    color:var(--text);
    text-decoration:none;
}

.hero-title .title-highlight{
    font-size:3.4rem;  
    font-weight:800;
    color:var(--primary);
}

.hero-title .title-big{
    font-size:3.2rem;    
    font-weight:800;
    color:var(--text);
}
.hero-content{
    display:flex;
    flex-direction:column;
    align-items:flex-start;   
    text-align:left;
    max-width:420px;          
    margin:0 auto;            
    padding-top:8px;
    text-decoration:none; 
}

.hero-title{
    align-items:flex-start;   
}

.hero-text{
    font-size:1.02rem;
    color:var(--muted);
    line-height:1.7;
    margin-bottom:4px;
}

.hero-image{
    margin:0;
    max-width:190px;
    overflow:hidden;
    height:125px;           
}

.hero-image img{
    width:100%;
    height:auto;
    display:block;
    margin-top:-15px;
    border-radius:var(--radius-md);
}

.hero-quick{
    display:inline-flex;
    align-items:center;
    gap:16px;
    background:var(--white);
    border:1px solid var(--border);
    border-radius:var(--radius-md);
    padding:14px 18px;
    box-shadow:var(--shadow-sm);
    transition:.25s;
    text-align:left;
    width:100%;
}

.hero-quick:hover{
    transform:translateY(-4px);
    box-shadow:var(--shadow-md);
    border-color:#c9dcff;
}

.hero-quick-icon{
    width:42px;
    height:42px;
    flex-shrink:0;
    border-radius:12px;
    background:linear-gradient(135deg,var(--primary),var(--primary-light));
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.05rem;
}

.hero-quick-text strong{
    display:block;
    font-size:.95rem;
    color:var(--text);
}

.hero-quick-text small{
    color:var(--muted);
    text-decoration:none !important; 
}

.hero-quick-arrow{
    margin-left:auto;
    color:var(--primary);
    font-size:1.05rem;
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

            <ul class="navbar-nav align-items-lg-center mx-lg-2" id="navScrollSpy">


                <li class="nav-item">

                    <a class="nav-link" href="#services" data-section="services">Layanan</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="#flow" data-section="flow">Alur</a>

                </li>

            </ul>

            <a
                href="{{ route('login') }}"
                class="btn btn-primary btn-login ripple-el ms-lg-2 mt-3 mt-lg-0 d-inline-block">
                Login

            </a>
            <a
                href="{{ route('register') }}"
                class="btn btn-primary btn-login ripple-el ms-lg-2 mt-3 mt-lg-0 d-inline-block">
                Daftar

            </a>

        </div>

    </div>

</nav>

</div>

{{-- ===================== HERO ===================== --}}

<section id="hero">

    <div class="hero-pattern"></div>

    <div class="container">

        <div class="row align-items-center g-5">

            {{-- LEFT --}}

            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="700">
<div class="hero-content">

    <h1 class="hero-title">

        <span class="title-small">Helpdesk</span>

        <span class="title-highlight">Diskominfo</span>

        <span class="title-big">Kabupaten</span>

        <span class="title-big">Pemalang</span>

    </h1>

    <p class="hero-text">
        Selamat datang di portal layanan teknologi informasi dan komunikasi Diskominfo Kabupaten Pemalang.
    </p>

    <div class="hero-image" data-aos="fade-up" data-aos-duration="700">
        <img
            src="{{ asset('images/landing-illustration.png') }}"
            alt="Ilustrasi Layanan Helpdesk Diskominfo">
    </div>

   <a href="{{ route('login') }}" class="hero-quick ripple-el" style="text-decoration:none;">

    <span class="hero-quick-icon">
        <i class="bi bi-headset"></i>
    </span>

    <span class="hero-quick-text">
        <strong style="text-decoration:none;">Pengaduan</strong>
        <small style="text-decoration:none;">Sampaikan kendala layanan TIK Anda</small>
    </span>

    <span class="hero-quick-arrow">
        <i class="bi bi-arrow-right"></i>
    </span>

</a>

</div>
</div>
            {{-- RIGHT: SEARCH + SERVICE GRID --}}

            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="700">

                <div class="hero-right">

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
                                class="service-card ripple-el"
                                data-bs-toggle="modal"
                                data-bs-target="#serviceModal{{ $service->id }}">

                                <span class="service-arrow">
                                    <i class="bi bi-arrow-up-right"></i>
                                </span>

                                <span class="service-thumb">

                                    <img
                                        src="{{ $service->icon ? asset('storage/'.$service->icon) : asset('images/logo-pemalang.png') }}"
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

{{-- ===================== TIMELINE PENGAJUAN (1 section) ===================== --}}

<section id="flow">

    <div class="container">

        <div class="section-title" data-aos="fade-up">

            <span class="eyebrow">Alur Layanan</span>

            <h2>Alur Pengajuan Layanan</h2>

            <p>

                Ikuti tahapan berikut untuk mengajukan layanan
                pada Helpdesk Diskominfo Kabupaten Pemalang.

            </p>

        </div>

        <div class="timeline" data-aos="zoom-in">

            <div class="timeline-track">

                <div class="timeline-step">

                    <div class="timeline-icon login">
                        <span class="timeline-no">1</span>
                        <i class="bi bi-box-arrow-in-right"></i>
                    </div>

                    <h5>Login</h5>

                    <p>Masuk menggunakan akun Helpdesk.</p>

                </div>

                <div class="timeline-step">

                    <div class="timeline-icon layanan">
                        <span class="timeline-no">2</span>
                        <i class="bi bi-ui-checks-grid"></i>
                    </div>

                    <h5>Pilih Layanan</h5>

                    <p>Pilih layanan sesuai kebutuhan.</p>

                </div>

                <div class="timeline-step">

                    <div class="timeline-icon formulir">
                        <span class="timeline-no">3</span>
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h5>Isi Formulir</h5>

                    <p>Lengkapi data permohonan.</p>

                </div>

                <div class="timeline-step">

                    <div class="timeline-icon verifikasi">
                        <span class="timeline-no">4</span>
                        <i class="bi bi-patch-check"></i>
                    </div>

                    <h5>Verifikasi</h5>

                    <p>Petugas melakukan verifikasi data.</p>

                </div>

                <div class="timeline-step">

                    <div class="timeline-icon selesai">
                        <span class="timeline-no">5</span>
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <h5>Selesai</h5>

                    <p>Layanan selesai dan dapat dipantau.</p>

                </div>

            </div>

            <div class="timeline-cta">

                <a
                    href="{{ url('/pelajari-lebih-lanjut') }}"
                    class="btn-hero-primary ripple-el">

                    Pelajari Lebih Lanjut

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

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
                    Kabupaten Pemalang.

                </p>

            </div>

            <div class="footer-col footer-links">

                <h6>Navigasi</h6>

                <a href="#services">Layanan</a>
                <a href="#flow">Alur Layanan</a>

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

                © {{ date('Y') }} Helpdesk Diskominfo Kabupaten Pemalang. 

            </div>

        </div>

    </div>

</footer>

<div id="pageLoader">

    <div class="loader-ring"></div>

</div>

<div class="chat-panel" id="chatPanel">

    <div class="chat-panel-head">

        <div>
            <strong>Butuh bantuan?</strong>
            <small>Hubungi kami</small>
        </div>

        <button type="button" class="chat-panel-close" id="chatPanelClose" aria-label="Tutup">
            <i class="bi bi-x-lg"></i>
        </button>

    </div>

    <div class="chat-panel-body">

        <a href="https://wa.me/62284000000">
            <i class="bi bi-whatsapp"></i>
            WhatsApp Pengaduan
        </a>

        <a href="mailto:diskominfo@pemalangkab.go.id">
            <i class="bi bi-envelope-fill"></i>
            diskominfo@pemalangkab.go.id
        </a>

        <a href="tel:0284000000">
            <i class="bi bi-telephone-fill"></i>
            (0284) XXXXXXX
        </a>


    </div>

</div>

<button type="button" class="chat-fab" id="chatFabBtn" aria-label="Hubungi Kami">

    <i class="bi bi-chat-dots-fill"></i>

</button>

<button type="button" class="back-to-top" id="backToTopBtn" aria-label="Kembali ke atas">

    <i class="bi bi-arrow-up"></i>

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
                   {{ $service->nama_layanan }}
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
                           {{ $service->department->nama_bidang ?? '-' }}
                        </p>

                        <p>
                          <strong>Estimasi :</strong>
                             {{ $service->sla }} Hari Kerja
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

{{-- Presentational-only additions: scroll animations + navbar active-link highlighting.
     Does not touch searchService() or any Blade/route/modal logic above. --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>

AOS.init({

    duration:700,

    once:true,

    offset:60

});

(function(){

    let sections = document.querySelectorAll("section[id]");

    let navLinks = document.querySelectorAll("#navScrollSpy .nav-link");

    if(!sections.length || !navLinks.length) return;

    let observer = new IntersectionObserver(function(entries){

        entries.forEach(function(entry){

            if(entry.isIntersecting){

                navLinks.forEach(function(link){

                    link.classList.toggle(
                        "active",
                        link.getAttribute("data-section") === entry.target.id
                    );

                });

            }

        });

    },{ rootMargin:"-45% 0px -50% 0px", threshold:0 });

    sections.forEach(function(sec){ observer.observe(sec); });

})();

/* Navbar shrink on scroll */

(function(){

    let navWrap = document.querySelector(".nav-wrap");

    if(!navWrap) return;

    window.addEventListener("scroll",function(){

        navWrap.classList.toggle("is-scrolled", window.scrollY > 30);

    });

})();

/* Back to top button */

(function(){

    let btn = document.getElementById("backToTopBtn");

    if(!btn) return;

    window.addEventListener("scroll",function(){

        btn.classList.toggle("is-visible", window.scrollY > 400);

    });

    btn.addEventListener("click",function(){

        window.scrollTo({ top:0, behavior:"smooth" });

    });

})();

/* Functional chat panel (no longer a dead placeholder) */

(function(){

    let fab = document.getElementById("chatFabBtn");

    let panel = document.getElementById("chatPanel");

    let closeBtn = document.getElementById("chatPanelClose");

    if(!fab || !panel) return;

    fab.addEventListener("click",function(){

        panel.classList.toggle("is-open");

    });

    if(closeBtn){

        closeBtn.addEventListener("click",function(){

            panel.classList.remove("is-open");

        });

    }

    document.addEventListener("click",function(e){

        if(!panel.contains(e.target) && !fab.contains(e.target)){

            panel.classList.remove("is-open");

        }

    });

})();

/* Ripple effect on interactive elements */

(function(){

    document.querySelectorAll(".ripple-el").forEach(function(el){

        el.addEventListener("click",function(e){

            let rect = el.getBoundingClientRect();

            let size = Math.max(rect.width, rect.height);

            let dot = document.createElement("span");

            dot.className = "ripple-dot";

            dot.style.width = dot.style.height = size + "px";

            dot.style.left = (e.clientX - rect.left - size / 2) + "px";

            dot.style.top = (e.clientY - rect.top - size / 2) + "px";

            el.appendChild(dot);

            setTimeout(function(){ dot.remove(); }, 600);

        });

    });

})();

/* Light loading transition on first paint */

window.addEventListener("load",function(){

    let loader = document.getElementById("pageLoader");

    if(loader){

        setTimeout(function(){

            loader.classList.add("is-hidden");

        }, 250);

    }

});

/* Realtime filtering while typing — reuses the existing searchService()
   function as-is, just triggers it on input in addition to Enter. */

(function(){

    let input = document.getElementById("searchService");

    if(!input) return;

    input.addEventListener("input",function(){

        searchService();

    });

})();

</script>

@endsection