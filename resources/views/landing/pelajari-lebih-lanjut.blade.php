@extends('layouts.landing')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
:root {
    --primary: #2563eb;
    --primary-light: #3b82f6;
    --primary-dark: #1d4ed8;
    --bg-soft: #eef5ff;
    --bg-hero: #f7faff;
    --bg-light: #f8fafc;
    --border: #e2e8f0;
    --text: #0f172a;
    --muted: #64748b;
    --white: #ffffff;
    --navy-deep: #071a33;
    --radius-lg: 24px;
    --radius-md: 20px;
    --shadow-sm: 0 4px 16px rgba(15, 23, 42, .06);
    --shadow-md: 0 16px 36px rgba(37, 99, 235, .14);
    --sp-2: 16px;
    --sp-3: 24px;
    --sp-4: 32px;
    --sp-5: 48px;
    --sp-6: 64px;
}
*{ margin:0; padding:0; box-sizing:border-box; }
html{ scroll-behavior:smooth; }
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text);
    background: var(--white);
    overflow-x: hidden;
}
.container{ max-width:1100px; width:100%; }
img{ max-width:100%; height:auto; }
.nav-wrap {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
    background: transparent;
    padding: 24px 30px 0;
}
.navbar {
    max-width: 1260px;
    margin: 0 auto;
    background: rgba(255, 255, 255, .68);
    backdrop-filter: blur(24px) saturate(180%);
    -webkit-backdrop-filter: blur(24px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, .55);
    border-radius: 999px;
    box-shadow: 0 10px 36px rgba(15, 23, 42, .09);
    padding: 16px 16px 16px 20px;
    transition: padding .3s ease, box-shadow .3s ease, background .3s ease;
}
.nav-wrap.is-scrolled .navbar {
    padding: 9px 14px 9px 18px;
    background: rgba(255, 255, 255, .86);
    box-shadow: 0 6px 22px rgba(15, 23, 42, .1);
}
.nav-wrap.is-scrolled .logo-pemalang {
    width: 36px;
    height: 36px;
}
.navbar-brand{ display:flex; align-items:center; gap:12px; font-weight:700; }
.logo-pemalang{ width:42px; height:42px; object-fit:contain; flex-shrink:0; transition:.3s; }
.brand-title{ line-height:1.15; text-align:left; }
.brand-title strong{ display:block; font-size:1rem; font-weight:700; color:var(--text); }
.brand-title small{ color:var(--muted); font-size:.72rem; font-weight:500; }
.nav-link {
    position: relative;
    color: #475569!important;
    font-weight: 500;
    font-size: .94rem;
    margin: 0 2px;
    padding: 9px 16px!important;
    border-radius: 999px;
    transition: .2s;
}
.nav-link:hover{ color:var(--primary)!important; background:var(--bg-soft); }
.nav-link.active{ color:var(--primary)!important; background:var(--bg-soft); font-weight:600; }
.btn-login {
    border-radius: 999px;
    padding: 10px 24px;
    font-weight: 600;
    font-size: .92rem;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border: none;
    box-shadow: 0 8px 18px -6px rgba(37, 99, 235, .5);
    transition: .2s;
}
.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 22px -6px rgba(37, 99, 235, .55);
}
.page-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(180deg, #f7faff 0%, #ffffff 100%);
    padding: calc(var(--sp-6) + 96px) 0 var(--sp-5);
    text-align: center;
}
.page-hero .container{ position:relative; z-index:1; }
.page-eyebrow {
    display: inline-block;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--primary);
    background: var(--bg-soft);
    padding: 6px 16px;
    border-radius: 999px;
    margin-bottom: var(--sp-2);
}
.page-hero h1 {
    font-size: 2.5rem;
    font-weight: 800;
    letter-spacing: -.02em;
    margin-bottom: var(--sp-2);
}
.page-hero p {
    color: var(--muted);
    max-width: 640px;
    margin: 0 auto;
    line-height: 1.8;
    font-size: 1.02rem;
}
.info-section{ padding:var(--sp-5) 0; }
.info-section.alt{ background:#f7faff; }
.info-block h2 {
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: var(--sp-2);
    letter-spacing: -.01em;
}
.info-block h2 i{ color:var(--primary); margin-right:8px; }
.info-block p {
    color: var(--muted);
    line-height: 1.85;
    font-size: 1rem;
    max-width: 820px;
}
.layanan-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--sp-2);
    margin-top: var(--sp-3);
}
.layanan-list li {
    list-style: none;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    font-size: .92rem;
    color: var(--text);
    transition: .2s;
}
.layanan-list li:hover {
    border-color: #c9dcff;
    box-shadow: var(--shadow-sm);
    transform: translateY(-2px);
}
.layanan-list li i{ color:var(--primary); margin-top:2px; }
.bidang-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: var(--sp-3);
}
.bidang-tab {
    border: 1px solid var(--border);
    background: #fff;
    color: var(--muted);
    font-family: inherit;
    font-size: .86rem;
    font-weight: 600;
    padding: 9px 18px;
    border-radius: 999px;
    cursor: pointer;
    transition: .2s;
}
.bidang-tab:hover{ border-color:#c9dcff; color:var(--primary); }
.bidang-tab.is-active {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
}
.bidang-panel{ display:none; }
.bidang-panel.is-active{ display:block; }
.manfaat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--sp-3);
    margin-top: var(--sp-3);
}
.manfaat-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: var(--sp-3);
    transition: .25s;
}
.manfaat-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-md);
    border-color: #c9dcff;
}
.manfaat-icon {
    width: 50px;
    height: 50px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin-bottom: 14px;
}
.manfaat-card h5{ font-weight:700; font-size:1rem; margin-bottom:6px; color:var(--text); }
.manfaat-card p{ color:var(--muted); font-size:.88rem; line-height:1.7; margin:0; }
.timeline-detail {
    margin-top: var(--sp-4);
    border-left: 2px solid var(--border);
    padding-left: var(--sp-4);
}
.timeline-detail-item{ position:relative; padding-bottom:var(--sp-4); }
.timeline-detail-item:last-child{ padding-bottom:0; }
.timeline-detail-item::before {
    content: "";
    position: absolute;
    left: calc(-1 * var(--sp-4) - 7px);
    top: 2px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: var(--primary);
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px var(--primary);
}
.timeline-detail-item h5{ font-weight:700; color:var(--text); margin-bottom:6px; font-size:1.02rem; }
.timeline-detail-item p{ color:var(--muted); font-size:.92rem; line-height:1.75; max-width:700px; }
.note-card {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary));
    color: #fff;
    border-radius: var(--radius-lg);
    padding: var(--sp-4);
    margin-top: var(--sp-3);
}
.note-card h5{ font-weight:700; margin-bottom:10px; }
.note-card p{ color:rgba(255, 255, 255, .88); line-height:1.8; font-size:.95rem; margin:0; }
.back-cta{ text-align:center; padding:var(--sp-5) 0 var(--sp-6); }
.btn-hero-primary {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    border: none;
    padding: 14px 30px;
    border-radius: 999px;
    font-weight: 600;
    box-shadow: 0 14px 28px -10px rgba(37, 99, 235, .55);
    transition: .25s;
    text-decoration: none;
}
.btn-hero-primary:hover{ transform:translateY(-3px); color:#fff;  text-decoration:none; }

footer {
    position: relative;
    background: linear-gradient(180deg, var(--navy-deep), #050f22);
    color: rgba(255, 255, 255, .72);
     padding: 20px 0 0;
}
footer: :before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-dark), var(--primary), var(--primary-light), var(--primary));
}
.footer-top {
    display: grid;
    grid-template-columns: 1.3fr 1fr 1.1fr;
    gap: 4px;
    padding-bottom: 4px;
    border-bottom: 1px solid rgba(255, 255, 255, .08);
}
.footer-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: var(--sp-2);
}
.footer-brand img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}
.footer-brand strong {
    display: block;
    color: #fff;
    font-size: .98rem;
}
.footer-brand small {
    color: rgba(255, 255, 255, .55);
}
.footer-col p {
    font-size: .88rem;
    line-height: 1.85;
    color: rgba(255, 255, 255, .62);
    max-width: 320px;
    margin-bottom: var(--sp-2);
}
.footer-social {
    display: flex;
    gap: 10px;
}
.footer-social a {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .08);
    border: 1px solid rgba(255, 255, 255, .14);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .95rem;
    transition: .2s;
}
.footer-social a:hover {
    background: var(--primary);
    border-color: var(--primary);
    transform: translateY(-3px);
}
.footer-col h6 {
    color: #fff;
    font-weight: 700;
    margin-bottom: var(--sp-2);
    font-size: .92rem;
}
.footer-links a {
    display: block;
    color: rgba(255, 255, 255, .65);
    text-decoration: none;
    font-size: .88rem;
    margin-bottom: 11px;
    transition: .2s;
}
.footer-links a:hover {
    color: #fff;
    padding-left: 4px;
}
.footer-contact li {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    font-size: .88rem;
    margin-bottom: 12px;
    list-style: none;
    color: rgba(255, 255, 255, .65);
}
.footer-contact i {
    color: var(--primary-light);
    margin-top: 3px;
}
.footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    padding: 8px 0;
    font-size: .82rem;
    color: rgba(255, 255, 255, .48);
}
footer .container {
    max-width: 1300px;
}
.chat-fab {
    position: fixed;
    right: 26px;
    bottom: 26px;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    border: none;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    font-size: 1.4rem;
    box-shadow: 0 14px 30px -8px rgba(37, 99, 235, .6);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .2s;
}
.chat-fab:hover{ transform:translateY(-3px) scale(1.05); }
.chat-fab i{ transition:.25s; }
.chat-fab:hover i{ transform:scale(1.1) rotate(-6deg); }
.back-to-top {
    position: fixed;
    right: 26px;
    bottom: 92px;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid var(--border);
    background: #fff;
    color: var(--primary);
    font-size: 1.05rem;
    box-shadow: var(--shadow-sm);
    z-index: 1049;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: .3s;
}
.back-to-top.is-visible{ opacity:1; visibility:visible; transform:translateY(0); }
.back-to-top:hover{ background:var(--primary); color:#fff; transform:translateY(-3px); }
.chat-panel {
    position: fixed;
    right: 26px;
    bottom: 96px;
    width: 300px;
    background: #fff;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg, 0 26px 60px rgba(37, 99, 235, .18));
    border: 1px solid var(--border);
    overflow: hidden;
    z-index: 1051;
    opacity: 0;
    visibility: hidden;
    transform: translateY(16px) scale(.97);
    transition: .25s ease;
}
.chat-panel.is-open{ opacity:1; visibility:visible; transform:translateY(0) scale(1); }
.chat-panel-head {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.chat-panel-head strong{ font-size:.94rem; }
.chat-panel-head small{ display:block; opacity:.85; font-size:.76rem; }
.chat-panel-close {
    background: rgba(255, 255, 255, .18);
    border: none;
    color: #fff;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    font-size: .8rem;
}
.chat-panel-body{ padding:16px 18px; }
.chat-panel-body a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border: 1px solid var(--border);
    border-radius: 12px;
    color: var(--text);
    font-size: .86rem;
    margin-bottom: 10px;
    transition: .2s;
}
.chat-panel-body a:hover {
    border-color: #c9dcff;
    background: var(--bg-soft);
    color: var(--primary);
    transform: translateX(2px);
}
.chat-panel-body a i{ color:var(--primary); font-size:1rem; }

@media (max-width:991.98px) {
    .nav-wrap {
        padding: 14px 16px 0;
    }
    .navbar,
    .nav-wrap.is-scrolled .navbar {
        border-radius: 24px;
        padding: 11px 13px;
    }
    .navbar .container-fluid {
        padding: 0;
        flex-wrap: wrap;
    }
    .navbar-brand {
        max-width: calc(100% - 58px);
        margin-right: 0;
    }
    .navbar-toggler {
        width: 44px;
        height: 44px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: var(--bg-soft);
        color: var(--primary);
        box-shadow: none!important;
        flex-shrink: 0;
    }
    .navbar-toggler-icon {
        width: 22px;
        height: 22px;
        background-image: url("data:image/svg+xml, %3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%232563eb' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    .navbar-collapse {
        width: 100%;
        flex-basis: 100%;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid var(--border);
        max-height: calc(100vh - 110px);
        overflow-y: auto;
        overscroll-behavior: contain;
    }
    .navbar-nav {
        width: 100%;
        align-items: stretch!important;
    }
    .nav-link {
        display: block;
        margin: 2px 0;
        padding: 11px 14px!important;
        border-radius: 12px;
    }
    .btn-login {
        display: flex!important;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin-left: 0!important;
        margin-top: 8px!important;
        padding: 11px 18px;
    }
    .page-hero {
        padding-top: 150px;
    }
    .manfaat-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }
    .footer-top {
        grid-template-columns: 1.25fr 1fr;
        gap: 28px;
    }
    .footer-top .footer-col:last-child {
        grid-column: 1 / -1;
    }
}

@media (max-width:767.98px) {
    :root {
        --sp-2: 14px;
        --sp-3: 20px;
        --sp-4: 26px;
        --sp-5: 38px;
        --sp-6: 48px;
        --radius-lg: 20px;
        --radius-md: 17px;
    }
    .container {
        padding-left: 18px;
        padding-right: 18px;
    }
    .nav-wrap {
        padding: 10px 10px 0;
    }
    .navbar,
    .nav-wrap.is-scrolled .navbar {
        border-radius: 20px;
        padding: 9px 11px;
    }
    .logo-pemalang,
    .nav-wrap.is-scrolled .logo-pemalang {
        width: 36px;
        height: 36px;
    }
    .navbar-brand {
        gap: 9px;
    }
    .brand-title strong {
        font-size: .9rem;
    }
    .brand-title small {
        font-size: .65rem;
    }
    .navbar-toggler {
        width: 40px;
        height: 40px;
        border-radius: 12px;
    }
    .page-hero {
        padding: 126px 0 38px;
    }
    .page-eyebrow {
        font-size: .67rem;
        letter-spacing: .09em;
        padding: 6px 12px;
        margin-bottom: 12px;
    }
    .page-hero h1 {
        font-size: clamp(1.7rem, 8vw, 2rem);
        line-height: 1.2;
        letter-spacing: -.025em;
        margin-bottom: 12px;
    }
    .page-hero p {
        font-size: .92rem;
        line-height: 1.7;
        max-width: 100%;
    }
    .info-section {
        padding: 36px 0;
    }
    .info-block h2 {
        display: flex;
        align-items: flex-start;
        font-size: 1.3rem;
        line-height: 1.35;
        margin-bottom: 12px;
    }
    .info-block h2 i {
        margin-top: 2px;
        flex-shrink: 0;
    }
    .info-block p {
        max-width: 100%;
        font-size: .92rem;
        line-height: 1.75;
    }
    .bidang-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        overflow-y: hidden;
        gap: 8px;
        margin-left: -18px;
        margin-right: -18px;
        padding: 2px 18px 10px;
        scroll-snap-type: x proximity;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    .bidang-tabs::-webkit-scrollbar {
        display: none;
    }
    .bidang-tab {
        flex: 0 0 auto;
        white-space: nowrap;
        scroll-snap-align: start;
        padding: 9px 15px;
        font-size: .82rem;
    }
    .layanan-list,
    .manfaat-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .layanan-list {
        margin-top: 18px;
    }
    .layanan-list li {
        min-width: 0;
        padding: 13px 14px;
        font-size: .88rem;
        line-height: 1.55;
        overflow-wrap: anywhere;
    }
    .manfaat-card {
        padding: 20px;
    }
    .manfaat-card:hover,
    .layanan-list li:hover,
    .btn-login:hover,
    .btn-hero-primary:hover {
        transform: none;
    }
    .timeline-detail {
        margin-top: 24px;
        padding-left: 24px;
    }
    .timeline-detail-item {
        padding-bottom: 25px;
    }
    .timeline-detail-item::before {
        left: -31px;
        width: 12px;
        height: 12px;
    }
    .timeline-detail-item h5 {
        font-size: .96rem;
        line-height: 1.45;
    }
    .timeline-detail-item p {
        font-size: .88rem;
        line-height: 1.7;
    }
    .note-card {
        padding: 21px;
    }
    .note-card p {
        font-size: .9rem;
        line-height: 1.7;
    }
    .back-cta {
        padding: 38px 18px 46px;
    }
    .btn-hero-primary {
        width: 100%;
        max-width: 360px;
        justify-content: center;
        padding: 13px 20px;
    }
    footer {
        padding-top: 34px;
    }
    footer .container {
        padding-left: 20px;
        padding-right: 20px;
    }
    .footer-top {
        grid-template-columns: 1fr;
        gap: 28px;
        padding-bottom: 26px;
    }
    .footer-top .footer-col:last-child {
        grid-column: auto;
    }
    .footer-col p {
        max-width: 100%;
    }
    .footer-bottom {
        justify-content: center;
        text-align: center;
        padding: 14px 0;
    }
    .chat-fab {
        right: 16px;
        bottom: 16px;
        width: 52px;
        height: 52px;
        font-size: 1.25rem;
    }
    .back-to-top {
        right: 20px;
        bottom: 78px;
        width: 40px;
        height: 40px;
    }
    .chat-panel {
        left: 12px;
        right: 12px;
        bottom: 80px;
        width: auto;
        max-width: none;
        border-radius: 17px;
    }
    .chat-panel-head {
        padding: 14px 16px;
    }
    .chat-panel-body {
        padding: 14px 16px;
    }
    .chat-panel-body a {
        min-height: 44px;
        margin-bottom: 8px;
        overflow-wrap: anywhere;
    }
}

@media (max-width:380px) {
    .brand-title small {
        display: none;
    }
    .page-hero h1 {
        font-size: 1.58rem;
    }
    .page-hero p,
    .info-block p {
        font-size: .88rem;
    }
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    .bidang-tabs {
        margin-left: -15px;
        margin-right: -15px;
        padding-left: 15px;
        padding-right: 15px;
    }
}

@media (prefers-reduced-motion:reduce) {
    html {
        scroll-behavior: auto;
    }
    *,
    *::before,
    *::after {
        animation-duration: .01ms!important;
        animation-iteration-count: 1!important;
        transition-duration: .01ms!important;
    }
}
</style>
<div class="nav-wrap">
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img
                src="{{ asset('images/logo-pemalang.png') }}"
                class="logo-pemalang"
                alt="Logo Pemalang">
            <div class="brand-title">
                <strong>Helpdesk</strong>
                <small>Pemkab Pemalang</small>
            </div>
        </a>
        <button
            class="navbar-toggler border-0"
            data-bs-toggle="collapse"
            data-bs-target="#navbarLanding"
            aria-controls="navbarLanding"
            aria-expanded="false"
            aria-label="Buka menu navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarLanding">
            <ul class="navbar-nav align-items-lg-center mx-lg-2" id="navScrollSpy">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#services') }}" data-section="services">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#flow') }}" data-section="flow">Alur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/pelajari-lebih-lanjut') }}">Tentang Layanan</a>
                </li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-primary btn-login ripple-el ms-lg-2 mt-3 mt-lg-0 d-inline-block">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-login ripple-el ms-lg-2 mt-3 mt-lg-0 d-inline-block">
                Daftar
            </a>
        </div>
    </div>
</nav>
</div>
<section class="page-hero">
    <div class="container" data-aos="fade-up">
        <span class="page-eyebrow">Pelajari Lebih Lanjut</span>
        <h1>Tentang Helpdesk Pemkab Pemalang</h1>
        <p>
            Halaman ini menjelaskan secara lengkap apa itu Helpdesk Pemkab
            Pemalang, tujuan dan fungsinya, daftar layanan yang tersedia di
            setiap bidang, cara pengajuan, hingga manfaat yang bisa Anda
            peroleh sebagai pengguna.
        </p>
    </div>
</section>
<section class="info-section">
    <div class="container info-block" data-aos="fade-up">
        <h2><i class="bi bi-info-circle-fill"></i>Apa itu Helpdesk Pemkab Pemalang</h2>
        <p>
            Helpdesk Pemkab Pemalang adalah aplikasi layanan yang dikelola oleh Dinas Komunikasi dan Informatika (Diskominfo) Kabupaten Pemalang untuk mewadahi permohonan layanan dari berbagai bidang di lingkungan Kantor Bupati Pemalang. Melalui portal ini, perangkat daerah, aparatur sipil negara, maupun masyarakat umum dapat mengajukan permohonan layanan, menyampaikan pengaduan, serta memantau status penyelesaian permohonan secara online tanpa perlu datang langsung ke kantor terkait.
        </p>
    </div>
</section>
<section class="info-section alt">
    <div class="container info-block" data-aos="fade-up">
        <h2><i class="bi bi-bullseye"></i>Tujuan Portal</h2>
        <p>
            Portal ini dibangun untuk menyederhanakan proses permohonan dan pengaduan
            layanan dari setiap bidang di lingkungan Kantor Bupati Pemalang,
            mempercepat waktu tindak lanjut, serta meningkatkan transparansi
            dan akuntabilitas setiap permohonan yang diajukan oleh perangkat
            daerah.
        </p>
    </div>
</section>
<section class="info-section">
    <div class="container info-block" data-aos="fade-up">
        <h2><i class="bi bi-grid-1x2-fill"></i>Jenis-Jenis Layanan</h2>
        <p>
            Berikut daftar layanan yang dapat diajukan, dikelompokkan per
            bidang. Pilih bidang di bawah untuk melihat layanannya.
        </p>
        <div class="bidang-tabs" id="bidangTabs">
            @foreach($bidangs as $i => $bidang)
                <button
                    type="button"
                    class="bidang-tab {{ $i === 0 ? 'is-active' : '' }}"
                    data-target="bidangPanel{{ $i }}">
                    {{ $bidang['nama'] }}
                </button>
            @endforeach
        </div>
        @foreach($bidangs as $i => $bidang)
            <div class="bidang-panel {{ $i === 0 ? 'is-active' : '' }}" id="bidangPanel{{ $i }}">
                <ul class="layanan-list">
                    @foreach($bidang['layanan'] as $item)
                        <li><i class="bi bi-check-circle-fill"></i> {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>
<section class="info-section alt">
    <div class="container info-block" data-aos="fade-up">
        <h2><i class="bi bi-list-ol"></i>Cara Mengajukan Layanan</h2>
        <p>
            Proses pengajuan layanan dirancang sesederhana mungkin agar dapat
            diselesaikan hanya dalam beberapa langkah, apa pun bidang yang
            Anda tuju.
        </p>
        <div class="timeline-detail">
            <div class="timeline-detail-item" data-aos="fade-up">
                <h5>1. Login ke Portal</h5>
                <p>Masuk menggunakan akun Helpdesk.</p>
            </div>
            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="80">
                <h5>2. Pilih Bidang &amp; Layanan yang Dibutuhkan</h5>
                <p>Telusuri atau cari layanan yang sesuai dengan kebutuhan instansi Anda pada halaman beranda.</p>
            </div>
            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="160">
                <h5>3. Lengkapi Formulir Permohonan</h5>
                <p>Isi data permohonan beserta dokumen pendukung yang dipersyaratkan sesuai jenis layanan.</p>
            </div>
            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="240">
                <h5>4. Verifikasi oleh Petugas Bidang Terkait</h5>
                <p>Petugas dari bidang yang dituju memverifikasi kelengkapan dan kesesuaian permohonan yang masuk.</p>
            </div>
            <div class="timeline-detail-item" data-aos="fade-up" data-aos-delay="320">
                <h5>5. Layanan Diproses &amp; Dipantau</h5>
                <p>Setelah disetujui, permohonan ditindaklanjuti dan status prosesnya dapat dipantau langsung melalui akun Anda.</p>
            </div>
        </div>
    </div>
</section>
<section class="info-section">
    <div class="container info-block" data-aos="fade-up">
        <h2><i class="bi bi-stars"></i>Manfaat Menggunakan Helpdesk</h2>
        <p>
            Beberapa keuntungan yang bisa Anda rasakan dengan mengajukan
            layanan dari bidang mana pun melalui portal ini dibandingkan cara
            konvensional.
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
                <h5>Akses Online</h5>
                <p>Pengajuan dapat dilakukan sesuai jam kerja tanpa harus datang langsung ke kantor.</p>
            </div>
        </div>
    </div>
</section>
<section class="info-section alt">
    <div class="container info-block" data-aos="fade-up">
        <h2><i class="bi bi-patch-question-fill"></i>Informasi Tambahan</h2>
        <div class="note-card">
            <h5>Butuh bantuan lebih lanjut?</h5>
            <p>
                Jika Anda mengalami kendala saat menggunakan portal atau
                membutuhkan informasi tambahan, silakan hubungi Tim Helpdesk
                Pemkab Pemalang melalui ikon chat yang tersedia di pojok
                kanan bawah halaman beranda.
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
<footer>
    <div class="container">
        <div class="footer-top">
            <div class="footer-col">
                <div class="footer-brand">
                    <img src="{{ asset('images/logo-pemalang.png') }}" alt="Logo Pemalang">
                    <div>
                        <strong>Helpdesk</strong>
                        <small>Pemkab Pemalang</small>
                    </div>
                </div>
                <p>
                    Portal layanan resmi lintas bidang di lingkungan Kantor
                    Bupati Pemalang, dikelola oleh Diskominfo Kabupaten
                    Pemalang.
                </p>
            </div>
            <div class="footer-col footer-links">
                <h6>Navigasi</h6>
                <a href="{{ url('/#services') }}">Layanan</a>
                <a href="{{ url('/#flow') }}">Alur Layanan</a>
                <a href="{{ url('/pelajari-lebih-lanjut') }}">Tentang Layanan</a>
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
                        <span>helpdesk@pemalangkab.go.id</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© {{ date('Y') }} Helpdesk Pemkab Pemalang.</div>
        </div>
    </div>
</footer>
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
        <a href="mailto:helpdesk@pemalangkab.go.id">
            <i class="bi bi-envelope-fill"></i>
            helpdesk@pemalangkab.go.id
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
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
(function () {
    let navWrap = document.querySelector(".nav-wrap");
    if (!navWrap) return;
    window.addEventListener("scroll",function () {
        navWrap.classList.toggle("is-scrolled", window.scrollY > 30);
    });
})();
</script>
<script>
AOS.init({ duration:700, once:true, offset:60 });
</script>
<script>
(function () {
    let btn = document.getElementById("backToTopBtn");
    if (!btn) return;
    window.addEventListener("scroll",function () {
        btn.classList.toggle("is-visible", window.scrollY > 400);
    });
    btn.addEventListener("click",function () {
        window.scrollTo({ top:0, behavior:"smooth" });
    });
})();
(function () {
    let fab = document.getElementById("chatFabBtn");
    let panel = document.getElementById("chatPanel");
    let closeBtn = document.getElementById("chatPanelClose");
    if (!fab || !panel) return;
    fab.addEventListener("click",function () {
        panel.classList.toggle("is-open");
    });
    if (closeBtn){
        closeBtn.addEventListener("click",function () {
            panel.classList.remove("is-open");
        });
    }
    document.addEventListener("click",function (e) {
        if (!panel.contains(e.target) && !fab.contains(e.target)){
            panel.classList.remove("is-open");
        }
    });
})();
(function () {
    let tabs = document.querySelectorAll(".bidang-tab");
    let panels = document.querySelectorAll(".bidang-panel");
    tabs.forEach(function (tab){
        tab.addEventListener("click",function () {
            tabs.forEach(function (t){ t.classList.remove("is-active"); });
            panels.forEach(function (p){ p.classList.remove("is-active"); });
            tab.classList.add("is-active");
            let target = document.getElementById(tab.getAttribute("data-target"));
            if (target) target.classList.add("is-active");
        });
    });
})();
</script>
@endsection
