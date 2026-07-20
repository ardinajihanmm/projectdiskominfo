<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Staff')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#f5f7fb;
            font-family:'Segoe UI',sans-serif;
        }

        /* ================= SIDEBAR ================= */

.sidebar{
    width:260px;
    height:100vh;
    background:linear-gradient(
        180deg,
        #0d6efd,
        #2563eb,
        #1e40af
    );
    display:flex;
    flex-direction:column;
    position:fixed;
    left:0;
    top:0;
    overflow-y:auto;
    overflow-x:hidden;
    box-shadow:8px 0 25px rgba(0,0,0,.08);
}

.topbar{
    height:70px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
    box-shadow:0 2px 12px rgba(0,0,0,.05);

    position: relative;
    overflow: visible;
    z-index: 1000;
}

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,.35);
    border-radius:20px;
}

.logo{
    padding:28px 20px 15px;
    text-align:center;
    color:#fff;
}

.logo h3{
    color:#fff;
    font-weight:700;
    margin-bottom:0;
    letter-spacing: 0;
}

.logo small{
    color:#dbeafe;
}

.avatar{

    width:90px;
    height:90px;

    margin:auto;

    border-radius:50%;

    overflow:hidden;

    background:white;

    display:flex;

    justify-content:center;

    align-items:center;

    box-shadow:0 8px 20px rgba(0,0,0,.18);

    border:4px solid rgba(255,255,255,.3);

}

.avatar img{

    width:100%;
    height:100%;
    object-fit:cover;

}

.profile{
    text-align:center;
    padding:14px 20px 10px;
}

.profile h5{
    color:#fff;
    margin-top:15px;
    margin-bottom:2px;
}

.profile small{
    color:#dbeafe;
}

        .profile p{
            margin:0;
            font-size:18px;
        }

.menu{
    padding:8px 15px 15px;
}

.menu a{
    color:#fff;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:12px;
    padding:14px 18px;
    margin-bottom:10px;
    border-radius:14px;
    transition:.3s;
    font-weight:500;
}

.menu a:hover{
    background:rgba(255,255,255,.15);
    transform:translateX(6px);
}

.menu a.active{
    background:#fff;
    color:#0d6efd;
    box-shadow:0 10px 20px rgba(0,0,0,.15);
}

        .menu i{
            font-size:20px;
        }

.logout{
    margin-top:auto;
    padding:20px;
}

.logout button{
    width:100%;
    border:none;
    border-radius:14px;
    padding:12px;
    background:#ef4444;
    color:white;
    font-weight:600;
    transition:.3s;
}

.logout button:hover{
    background:#dc2626;
    transform:translateY(-2px);
}
        /* ================= CONTENT ================= */

.main{
    flex:1;
    overflow-y:auto;
    padding:30px;
}

.content{
    margin-left:260px;
    height:100vh;
    display:flex;
    flex-direction:column;
    overflow:hidden;
    transition:all .35s ease;
}
.ticket-column{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
    min-height:650px;
    transition:.3s;
}

.ticket-column.sortable-ghost{
    background:#eef4ff;
}

.card.shadow.border-0{
    border-radius:20px !important;
    overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,.08)!important;
}

.card-header{
    border:none;
    padding:16px 20px;
    font-size:17px;
    font-weight:700;
}

.ticket-card{
    border:none !important;
    border-radius:16px !important;
    transition:.25s;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
}

.ticket-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(37,99,235,.18);
}

.ticket-card .card-body{
    padding:20px;
}

.ticket-card h6{
    font-size:17px;
    font-weight:700;
    color:#1e293b;
}

.ticket-card small{
    color:#64748b;
}

.ticket-card hr{
    margin:15px 0;
    opacity:.15;
}

.ticket-card .badge{
    padding:7px 12px;
    border-radius:30px;
    font-weight:600;
}

.ticket-card .btn{
    border-radius:10px;
    font-weight:600;
}

.ticket-card .btn-primary{
    background:#2563eb;
    border:none;
}

.ticket-card .btn-primary:hover{
    background:#1d4ed8;
}

.ticket-column::-webkit-scrollbar{
    width:6px;
}

.ticket-column::-webkit-scrollbar-thumb{
    background:#cbd5e1;
    border-radius:20px;
}

/* ================= DASHBOARD ================= */

.dashboard-header{
    background:#fff;
    border-radius:20px;
    padding:35px;
    color:#111827;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.dashboard-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#eaf2ff;
    color:#2563eb;
    padding:8px 16px;
    border-radius:30px;
    font-size:14px;
    font-weight:600;
}

.dashboard-title{
    font-weight:700;
    font-size:34px;
    color:#111827;
}

.dashboard-title span{
    color:#2563eb;
}

.dashboard-desc{
    color:#4b5563;
    margin-top:12px;
    opacity:1;
}

.account-status{
    background:rgba(255,255,255,.12);
    border-radius:18px;
    padding:22px;
    display:flex;
    align-items:center;
    gap:18px;
    backdrop-filter:blur(12px);
}

.status-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#fff;
    color:#2563eb;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
}

.modern-card{
    position:relative;
    overflow:hidden;
    display:flex;
    align-items:center;
    gap:22px;
    min-height:180px;
    height:180px;
    padding:28px;
    border-radius:24px;
    color:#fff;
    transition:.35s cubic-bezier(.4,0,.2,1);
    box-shadow:0 15px 30px rgba(0,0,0,.12);
}

.modern-card small{
    display:block;
    font-size:.95rem;
    opacity:.9;
    margin-bottom:8px;
    letter-spacing:.3px;
}

.modern-card h2{
    margin:8px 0 12px;
    font-size:2.4rem;
    font-weight:700;
    line-height:1;
}

.modern-card span{
    display:block;
    min-height:52px;
    line-height:1.5;
    font-size:.9rem;
    opacity:.92;
}


.modern-card:hover{
    transform:translateY(-10px) scale(1.02);
    box-shadow:0 30px 60px rgba(0,0,0,.18);
}

.modern-card:hover .icon-box{
    animation: floatIcon .6s ease;
    transform: rotate(-8deg) scale(1.12);
    background: rgba(255,255,255,.28);
}


.modern-card::before{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    right:-80px;
    top:-80px;
}

.modern-card::after{
    content:"";
    position:absolute;
    width:120px;
    height:120px;
    border-radius:50%;
    background:rgba(255,255,255,.06);
    left:-30px;
    bottom:-30px;
}

.total-card{
    background:linear-gradient(
        135deg,
        #3B82F6,
        #2563EB,
        #1D4ED8
    );
    box-shadow:0 20px 45px rgba(37,99,235,.35);
}

.waiting-card{
    background:linear-gradient(
        135deg,
        #FBBF24,
        #F59E0B,
        #D97706
    );
    box-shadow:0 20px 45px rgba(245,158,11,.35);
}

.progress-card{
    background:linear-gradient(
        135deg,
        #38BDF8,
        #06B6D4,
        #0891B2
    );
    box-shadow:0 20px 45px rgba(6,182,212,.35);
}

.complete-card{
    background:linear-gradient(
        135deg,
        #4ADE80,
        #22C55E,
        #15803D
    );
    box-shadow:0 20px 45px rgba(34,197,94,.35);
}

.icon-box{
    width:78px;
    height:78px;
    border-radius:22px;
    background:rgba(255,255,255,.18);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:34px;
    flex-shrink:0;
    transition:.35s;

    transform: rotate(0deg);
}

@keyframes floatIcon{

    0%{
        transform: rotate(0deg) translateY(0);
    }

    40%{
        transform: rotate(-8deg) translateY(-6px);
    }

    70%{
        transform: rotate(-8deg) translateY(-2px);
    }

    100%{
        transform: rotate(-8deg) translateY(0);
    }

}

.card-content{
    flex:1;
    display:flex;
    flex-direction:column;
    justify-content:center;
    height:100%;
}


.card-content h2{
    font-weight:700;
    margin-bottom:0;
}

.card-content small{
    display:block;
    opacity:.85;
}

.card-content span{
    font-size:13px;
    opacity:.85;
}

.progress-modern{
    border-radius:18px;
}

.progress-circle{
    width:75px;
    height:75px;
    border-radius:50%;
    background:#2563eb;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:bold;
}

.modern-progress{
    height:12px;
    border-radius:20px;
    overflow:hidden;
}

.status-box{
    display:flex;
    align-items:center;
    gap:18px;
    padding:22px;
    border-radius:18px;
    transition:.3s;
}

.status-box i{
    font-size:28px;
}

.status-box strong{
    font-size:32px;
    font-weight:700;
    display:block;
}

.status-box small{
    font-size:15px;
}

.status-success{
    background:#EAF8EF;
    color:#16A34A;
}

.status-success i{
    color:#16A34A;
}

.status-warning{
    background:#FFF8E6;
    color:#D97706;
}

.status-warning i{
    color:#D97706;
}

.status-info{
    background:#EAF7FD;
    color:#0284C7;
}

.status-info i{
    color:#0284C7;
}

.modern-progress{
    height:14px;
    border-radius:20px;
    background:#E5E7EB;
}

.modern-progress .progress-bar{
    background:repeating-linear-gradient(
        45deg,
        #3B82F6,
        #3B82F6 8px,
        #2563EB 8px,
        #2563EB 16px
    );
    border-radius:20px;
}

.progress-circle{
    width:78px;
    height:78px;
    border-radius:50%;
    background:#2563EB;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:26px;
    font-weight:700;
    box-shadow:0 10px 25px rgba(37,99,235,.25);
}


.quick-card,
.latest-ticket-card{
    border-radius:22px;
}

.quick-card .card-body{
    padding:24px;
}

.latest-ticket-card .card-body{
    padding:40px;
}

.quick-title-icon{
    width:56px;
    height:56px;
    border-radius:16px;
    margin-right:14px;
}

.quick-title-icon i{
    font-size:24px;
}

.quick-menu{
    position:relative;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    height:130px;
    border-radius:20px;
    color:#fff;
    text-decoration:none;
    transition:.35s;
    box-shadow:0 10px 22px rgba(0,0,0,.12);
}

.quick-menu::before{
    content:"";
    position:absolute;
    width:160px;
    height:160px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    right:-45px;
    top:-45px;
}

.quick-menu:hover{
    transform:translateY(-8px) scale(1.03);
    color:#fff;
}

.quick-menu i{
    font-size:42px;
    margin-bottom:14px;
}

.quick-menu h5{
    margin:0;
    text-align:center;
    line-height:1.35;
    font-size:1.1rem;
    font-weight:700;
}

.quick-menu span{
    font-size:1rem;
    font-weight:600;
    line-height:1.3;
}

.quick-blue{
    background:linear-gradient(
        135deg,
        #3B82F6,
        #2563EB,
        #1D4ED8
    );
}
.quick-green{
    background:linear-gradient(
        135deg,
        #22C55E,
        #16A34A,
        #15803D
    );
}

.quick-gray{
    background:linear-gradient(
        135deg,
        #64748B,
        #475569,
        #334155
    );
}

.ticket-item{
    display:flex;
    gap:24px;
    padding:28px 16px;
    border-bottom:1px solid #eee;
}

.ticket-content h5{
    font-size:1.3rem;
    font-weight:700;
}

.ticket-content p{
    font-size:15px;
    margin-top:10px;
}

.ticket-meta{
    font-size:15px;
    gap:24px;
}

.badge{
    font-size:0.9rem;
    padding:10px 18px;
}

.ticket-item:last-child{
    border-bottom:none;
}

.ticket-icon{
    width:55px;
    height:55px;
    border-radius:15px;
    background:#2563eb;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:24px;
}

.ticket-content{
    flex:1;
}

.ticket-meta{
    display:flex;
    gap:20px;
    color:#6b7280;
    font-size:14px;
    margin:10px 0;
}

.timeline-item{
    display:flex;
    gap:15px;
    margin-bottom:22px;
}

.timeline-icon{
    width:48px;
    height:48px;
    border-radius:50%;
    background:#eff6ff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:20px;
}

.timeline-content h6{
    margin-bottom:4px;
}

.timeline-content p{
    margin-bottom:4px;
    color:#6b7280;
}

.step-wrapper{
    margin-top:20px;
}

.step-item{
    position:relative;
}

.step-number{
    width:55px;
    height:55px;
    border-radius:50%;
    color:#fff;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:bold;
    margin-bottom:15px;
}

.step-title{
    font-weight:600;
    margin-bottom:8px;
}

.step-desc{
    font-size:14px;
    color:#6b7280;
}

.empty-ticket{
    text-align:center;
    padding:60px 20px;
}

.empty-ticket i{
    font-size:60px;
    color:#9ca3af;
}

.counter{
    transition:all .5s;
}

/* ================= KANBAN ================= */

.ticket-column{
    background:#f8fafc;
    border-radius:18px;
    padding:18px;
    min-height:650px;
    transition:.3s;
}

.ticket-column.sortable-ghost{
    background:#eef4ff;
}

.card.shadow.border-0{
    border-radius:20px !important;
    overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,.08)!important;
}

.card-header{
    border:none;
    padding:16px 20px;
    font-size:17px;
    font-weight:700;
}

.ticket-card{
    border:none !important;
    border-radius:16px !important;
    transition:.25s;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
}

.ticket-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(37,99,235,.18);
}

.ticket-card .card-body{
    padding:20px;
}

.ticket-card h6{
    font-size:17px;
    font-weight:700;
    color:#1e293b;
}

.ticket-card small{
    color:#64748b;
}

.ticket-card hr{
    margin:15px 0;
    opacity:.15;
}

.ticket-card .badge{
    padding:7px 12px;
    border-radius:30px;
    font-weight:600;
}

.ticket-card .btn{
    border-radius:10px;
    font-weight:600;
}

.ticket-card .btn-primary{
    background:#2563eb;
    border:none;
}

.ticket-card .btn-primary:hover{
    background:#1d4ed8;
}

.ticket-column::-webkit-scrollbar{
    width:6px;
}

.ticket-column::-webkit-scrollbar-thumb{
    background:#cbd5e1;
    border-radius:20px;
}

.todo-header{
    background:linear-gradient(135deg,#facc15,#f59e0b);
    color:#fff;
}

.progress-header{
    background:linear-gradient(135deg,#38bdf8,#2563eb);
    color:#fff;
}

.done-header{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:#fff;
}


/* ================= DAFTAR TIKET ================= */

.ticket-header{
    background:#fff;
    border-radius:20px;
    padding:28px 30px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    margin-bottom:25px;
}

.ticket-header h2{
    font-weight:700;
    color:#1e293b;
}

.ticket-header p{
    color:#64748b;
    margin-bottom:0;
}

/* Filter */

.filter-card{
    border:none;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(15,23,42,.06);
}

.filter-card .card-body{
    padding:22px;
}

.filter-card .form-control,
.filter-card .form-select{
    height:48px;
    border-radius:12px;
    border:1px solid #dbe3ef;
}

.filter-card .form-control:focus,
.filter-card .form-select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 .15rem rgba(37,99,235,.15);
}

.filter-card .btn{
    height:48px;
    border-radius:12px;
    font-weight:600;
}

/* Table Card */

.ticket-table-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,.08);
}

.ticket-table-card .card-header{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    padding:18px 25px;
    border:none;
}

.ticket-table-card .card-header h5{
    margin:0;
    font-weight:700;
}

/* Table */

.ticket-table{
    margin-bottom:0;
}

.ticket-table thead{
    background:#f8fafc;
}

.ticket-table thead th{
    border:none;
    color:#475569;
    font-weight:700;
    padding:18px;
}

.ticket-table tbody td{
    vertical-align:middle;
    padding:18px;
    border-color:#eef2f7;
}

.ticket-table tbody tr{
    transition:.25s;
}

.ticket-table tbody tr:hover{
    background:#f8fbff;
    transform:scale(1.002);
}

/* Badge */

.badge-status{
    padding:7px 14px;
    border-radius:30px;
    font-weight:600;
    font-size:12px;
}

.badge-todo{
    background:#fef3c7;
    color:#92400e;
}

.badge-progress{
    background:#dbeafe;
    color:#1d4ed8;
}

.badge-completed{
    background:#dcfce7;
    color:#15803d;
}

/* Select Status */

.status-select{
    border-radius:10px;
    min-width:140px;
}

/* Tombol */

.btn-detail{
    border-radius:10px;
    padding:7px 16px;
    font-weight:600;
}

/* Hover Card */

.ticket-table-card:hover{
    transform:translateY(-2px);
    transition:.3s;
}

/* =========================
   DETAIL TIKET
========================= */

.detail-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    margin-bottom:25px;
}

.detail-card .card-header{
    background:#fff;
    border-bottom:1px solid #edf2f7;
    padding:18px 25px;
    font-size:18px;
    font-weight:700;
    color:#1e293b;
}

.detail-card .card-body{
    padding:25px;
}

.detail-table{
    width:100%;
}

.detail-table tr{
    border-bottom:1px solid #eef2f7;
}

.detail-table td{
    padding:13px 10px;
}

.detail-table td:first-child{
    width:180px;
    font-weight:600;
    color:#64748b;
}

.detail-table td:last-child{
    color:#1e293b;
    font-weight:500;
}

.status-card{
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.status-card .card-header{
    background:#fff;
    border-bottom:1px solid #edf2f7;
    color:#1e293b;
    font-weight:700;
}

.status-card .card-body{
    padding:22px;
}

.status-card select{
    height:48px;
    border-radius:12px;
}

.status-card .btn-success{
    border-radius:12px;
    height:45px;
    font-weight:600;
}

.badge{
    padding:8px 12px;
    border-radius:50px;
    font-weight:600;
}

/* Diskusi */

.comment-card{
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.comment-card .card-header{
    background:#fff;
    color:#1e293b;
    font-weight:700;
    border-bottom:1px solid #edf2f7;
}

.comment-box{
    background:#f8fafc;
    border-radius:12px;
    padding:15px;
    margin-bottom:15px;
}

.comment-box strong{
    color:#2563eb;
}

.comment-box small{
    color:#94a3b8;
}

/* Timeline */

.timeline-card{
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.timeline-card .card-header{
    background:#fff;
    color:#1e293b;
    border-bottom:1px solid #edf2f7;
}

.timeline{
    position:relative;
    margin-left:18px;
}

.timeline::before{
    content:"";
    position:absolute;
    left:8px;
    top:0;
    bottom:0;
    width:2px;
    background:#dbeafe;
}

.timeline-item{
    position:relative;
    padding-left:35px;
    margin-bottom:25px;
}

.timeline-dot{
    position:absolute;
    left:-2px;
    top:4px;
    width:18px;
    height:18px;
    border-radius:50%;
    background:#2563eb;
}

.timeline-title{
    font-weight:600;
    color:#1e293b;
}

.timeline-time{
    font-size:13px;
    color:#94a3b8;
}

.timeline{
    position: relative;
    padding-left: 25px;
}

.timeline::before{
    content: "";
    position: absolute;
    left: 18px;
    top: 15px;
    bottom: 15px;
    width: 2px;
    background: #d6e4ff;
}

.timeline .d-flex{
    position: relative;
    margin-bottom: 30px !important;
}

.timeline .badge{
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    font-size: 16px;
    position: relative;
    z-index: 2;
}

/* ===== Timeline Dashboard ===== */

.timeline-item-modern{
    position:relative;
    display:flex;
    gap:18px;
    margin-bottom:22px;
    align-items:flex-start;
}

.timeline-item-modern:not(:last-child)::before{
    content:"";
    position:absolute;
    left:21px;
    top:48px;
    width:2px;
    height:calc(100% + 8px);
    background:#dbeafe;
}

.timeline-icon-modern{
    width:42px;
    height:42px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:18px;
    flex-shrink:0;
    box-shadow:0 10px 20px rgba(37,99,235,.25);
}

.timeline-content-modern{
    flex:1;
    background:#f8fbff;
    border-radius:14px;
    padding:16px 18px;
    transition:.3s;
    border:1px solid #edf2f7;
}

.timeline-content-modern:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(0,0,0,.08);
}

.timeline-content-modern h6{
    font-weight:700;
    margin-bottom:6px;
    color:#1f2937;
}

.timeline-content-modern p{
    margin-bottom:8px;
    color:#64748b;
    font-size:14px;
}

.timeline-content-modern small{
    color:#94a3b8;
}

.profile-card{
    border-radius:25px;
    overflow:hidden;
}

.profile-header{
    background:linear-gradient(135deg,#2563eb,#5b8df7);
    color:#fff;
    padding:50px 20px 35px;
}

.profile-avatar{
    width:150px;
    height:150px;
    border-radius:50%;
    border:6px solid #fff;
    object-fit:cover;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    margin-bottom:20px;
}

.profile-role{
    display:inline-block;
    margin-top:12px;
    background:#fff;
    color:#2563eb;
    padding:8px 22px;
    border-radius:30px;
    font-weight:600;
}

.profile-info .info-item{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:28px;
}

.profile-info i{
    width:50px;
    height:50px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#eef4ff;
    font-size:22px;
}

.profile-info small{
    display:block;
    color:#888;
}

.profile-info strong{
    display:block;
    font-size:16px;
}

.profile-form-header{
    background:linear-gradient(135deg,#2563eb,#5b8df7);
    color:white;
    font-size:24px;
    font-weight:700;
    padding:20px 25px;
}

.card{
    border-radius:24px;
}

.card{
    transition:.3s;
}

.card:hover{
    transform:translateY(-4px);
}

.input-group-text{
    border-right:none;
    background:#fff;
}

.form-control{
    border-left:none;
}

.form-control:focus{
    box-shadow:none;
    border-color:#86b7fe;
}

.list-group-item{
    transition:.25s;
}

.list-group-item:hover{
    background:#f8f9fa;
}

.btn{
    transition:.25s;
}

.btn:hover{
    transform:translateY(-2px);
}

.profile-foto{
    width:240px;
    height:240px;
    border-radius:50%;
    object-fit:cover;
    object-position:center;
    border:6px solid #fff;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
    display:block;
    margin:0 auto;
}

.logo{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:14px;
    padding:22px 18px 26px;
}

.logo-pemalang{
    width:64px;
    height:64px;
    object-fit:contain;
    flex-shrink:0;
}

.logo-text{
    text-align:left;
    font-family:'Plus Jakarta Sans',sans-serif;
}

.logo-text h3{
    margin:0;
    color:#fff;
    font-size:1.65rem;
    font-weight:800;
    letter-spacing:-.02em;
    line-height:1.1;
    font-family:'Plus Jakarta Sans',sans-serif;
}

.logo-text small{
    display:block;
    color:rgba(255,255,255,.85);
    font-size:.82rem;
    line-height:1.35;
    font-weight:500;
    margin-top:4px;
    font-family:'Plus Jakarta Sans',sans-serif;
}
.footer{
    padding:20px 30px;
    color:#64748B;
    font-size:14px;
}
.sidebar{
    transition:all .35s ease;
}

.content{
    transition:all .35s ease;
}
.sidebar.collapsed{
    width:85px;
}
.sidebar.collapsed .logo{
    justify-content:center;
}

.sidebar.collapsed .logo-text{
    display:none;
}

.sidebar.collapsed .logo-pemalang{
    width:50px;
    height:50px;
}
.sidebar.collapsed .profile h5,
.sidebar.collapsed .profile small{
    display:none;
}

.sidebar.collapsed .avatar{
    width:60px;
    height:60px;
}
.sidebar.collapsed .menu a{
    justify-content:center;
    padding:16px;
}

.sidebar.collapsed .menu a span{
    display:none;
}

.sidebar.collapsed .menu a i{
    margin:0;
    font-size:22px;
}
.sidebar.collapsed .logout button{
    font-size:0;
    padding:15px;
}

.sidebar.collapsed .logout button i{
    font-size:22px;
    margin:0 !important;
}
.sidebar.collapsed + .content{
    margin-left:85px;
}


.welcome h5{
    margin:0;
    font-size:1.15rem;
    font-weight:700;
}

.welcome small{
    display:block;
    color:#64748b;
}
.sidebar.collapsed .profile{
    display:flex;
    justify-content:center;
    align-items:center;
    padding:18px 0 22px;
}

</style>


</head>

<body>

    {{-- Sidebar --}}
<div class="sidebar">

    <div class="logo">

    <img
        src="{{ asset('images/logo-pemalang.png') }}"
        class="logo-pemalang"
        alt="Logo Kabupaten Pemalang">

    <div class="logo-text">
    <h3>Helpdesk</h3>
    <small>
        Pemkab Pemalang
    </small>
    </div>

</div>

        <div class="profile">

            <div class="avatar">
                @if(Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}?v={{ time() }}"
                        alt="Profile">
                @else
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                @endif
            </div>

<h5 class="mb-1">
    {{ Auth::user()->name }}
</h5>

            <small>Staff</small>

        </div>

        <div class="menu">

            <a href="{{ route('staff.dashboard') }}"
               class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('staff.kanban') }}"
               class="{{ request()->routeIs('staff.kanban') ? 'active' : '' }}">
                <i class="bi bi-kanban-fill"></i>
                <span>Kanban Board</span>
            </a>

            <a href="{{ route('staff.ticket.index') }}"
               class="{{ request()->routeIs('staff.ticket.*') ? 'active' : '' }}">
                <i class="bi bi-ticket-detailed-fill"></i>
                <span>Daftar Tiket</span>
            </a>

            <a href="{{ route('staff.profile') }}"
               class="{{ request()->routeIs('staff.profile*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>Profil</span>
            </a>

        </div>

        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    <span>Logout<span>
                </button>
            </form>

        </div>

    </div>

    {{-- Content --}}
    <div class="content">

<div class="topbar">
 <!-- Tombol Toggle Sidebar -->
    <button class="btn btn-light border-0 me-3" id="toggleSidebar">
        <i class="bi bi-list fs-3"></i>
    </button>
    <h5 class="mb-0 fw-bold">

        @yield('title','Dashboard')

    </h5>

    <div class="d-flex align-items-center ms-auto gap-3">

        <button
            class="btn btn-light position-relative border-0"
            data-bs-toggle="offcanvas"
            data-bs-target="#notifCanvas">

            <i class="bi bi-bell fs-5"></i>

            @if($notificationCount>0)

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                {{ $notificationCount }}

            </span>

            @endif

        </button>

        <div class="text-end">

            <strong>{{ auth()->user()->name }}</strong>

            <br>

            <small class="text-muted">

                {{ ucfirst(auth()->user()->role) }}

            </small>

        </div>

    </div>

</div>
        <div class="main">
            @yield('content')
        </div>

        <div class="footer">

            © {{ date('Y') }} Helpdesk Pemkab Pemalang

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="offcanvas offcanvas-end"
        tabindex="-1"
        id="notifCanvas">

        <div class="offcanvas-header">

            <h5>
                <i class="bi bi-bell-fill"></i>
                Notifikasi
            </h5>

            <button
                class="btn-close"
                data-bs-dismiss="offcanvas">
            </button>

        </div>
        

        <div class="offcanvas-body">
                @forelse($notifications ?? [] as $notif)

                <div class="notification-card {{ $notif->is_read ? 'notification-read' : '' }}">

                    <div class="d-flex">

                        <div class="notification-icon me-3">

                            @if(Str::contains($notif->judul,'Komentar'))
                                <i class="bi bi-chat-dots-fill text-success"></i>

                            @elseif(Str::contains($notif->judul,'Status'))
                                <i class="bi bi-arrow-repeat text-primary"></i>

                            @else
                                <i class="bi bi-info-circle-fill text-warning"></i>

                            @endif

                        </div>

                        <div class="flex-grow-1">

                            <h6 class="mb-1 fw-bold">
                                {{ $notif->judul }}
                            </h6>

                            <p class="mb-2">
                                {{ $notif->pesan }}
                            </p>

                            <small class="text-muted">
                                {{ $notif->created_at->diffForHumans() }}
                            </small>

                            <div class="mt-3 d-flex align-items-center gap-3">

                                <a href="{{ route('staff.notification',$notif->id) }}"
                                class="btn btn-sm btn-light border rounded-pill px-4 py-2">

                                    <i class="bi bi-eye"></i>

                                    Lihat Tiket

                                </a>

                                @if($notif->is_read)

                                    <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3 py-2">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Sudah Dibaca

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

                @empty

                <div class="text-center py-5">

                    <i class="bi bi-bell-slash fs-1 text-secondary"></i>

                    <p class="mt-3">
                        Belum ada notifikasi.
                    </p>

                </div>

                @endforelse

        </div>

    </div>
<script>
const sidebar = document.querySelector('.sidebar');
const toggle = document.getElementById('toggleSidebar');

if (localStorage.getItem('sidebar') === 'collapsed') {
    sidebar.classList.add('collapsed');
}

toggle.addEventListener('click',()=>{

    sidebar.classList.toggle('collapsed');

    localStorage.setItem(
        'sidebar',
        sidebar.classList.contains('collapsed')
            ? 'collapsed'
            : 'open'
    );

}); // <-- ini wajib
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.counter').forEach(counter => {

        const target = parseInt(counter.dataset.target);

        let count = 0;

        const step = Math.max(1, Math.ceil(target / 50));

        function update() {

            count += step;

            if (count >= target) {
                counter.innerText = target;
            } else {
                counter.innerText = count;
                requestAnimationFrame(update);
            }

        }

        update();

    });

});
</script>
</body>
</html>
