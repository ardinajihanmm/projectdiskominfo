<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            font-family: sans-serif;
            font-size: 11px;
            color: #1e293b;
        }

        .kop{
            text-align: center;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .kop h1{
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .kop p{
            margin: 2px 0 0;
            font-size: 11px;
            color: #555;
        }

        h2.judul-laporan{
            text-align: center;
            text-decoration: underline;
            font-size: 14px;
            margin: 0 0 4px;
        }

        .periode{
            text-align: center;
            font-size: 11px;
            color: #555;
            margin-bottom: 18px;
        }
        table.summary{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.summary td{
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
            width: 25%;
        }

        table.summary .label{
            display: block;
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        table.summary .value{
            display: block;
            font-size: 18px;
            font-weight: bold;
            color: #0d6efd;
        }

        table.data{
            width:100%;
            border-collapse:collapse;
            margin-bottom: 30px;
        }

        table.data th,
        table.data td{
            border:1px solid #999;
            padding:6px 8px;
            text-align: left;
            vertical-align: top;
        }

        table.data th{
            background:#0d6efd;
            color:white;
            font-size: 9.5px;
        }

        table.data td{
            font-size: 9.5px;
        }

        .text-center{
            text-align: center;
        }

        .badge{
            padding: 2px 6px;
            border-radius: 4px;
            color: white;
            font-size: 9px;
            white-space: nowrap;
        }

        .bg-warning{ background:#f59e0b; }
        .bg-info{ background:#0ea5e9; }
        .bg-success{ background:#16a34a; }

        .ttd-wrap{
            width: 100%;
            margin-top: 40px;
        }

        .ttd-box{
            width: 240px;
            float: right;
            text-align: center;
            font-size: 11px;
        }

        .ttd-space{
            height: 70px;
        }

        .clearfix{
            clear: both;
        }

        .footer-note{
            margin-top: 6px;
            font-size: 9px;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="kop">
        <h1>Helpdesk Pemkab Pemalang</h1>
    </div>

    <h2 class="judul-laporan">Laporan Data Tiket Layanan</h2>
    <p class="periode">
        Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
        @if(isset($departmentName) && $departmentName)
            &middot; Bidang {{ $departmentName }}
        @endif
    </p>

    <table class="summary">
        <tr>
            <td>
                <span class="label">Total Tiket</span>
                <span class="value">{{ $tickets->count() }}</span>
            </td>
            <td>
                <span class="label">Selesai</span>
                <span class="value">{{ $tickets->where('status', 'Completed')->count() }}</span>
            </td>
            <td>
                <span class="label">Dalam Proses</span>
                <span class="value">{{ $tickets->where('status', 'In Progress')->count() }}</span>
            </td>
            <td>
                <span class="label">Rata-rata Poin SLA</span>
                <span class="value">
                    @php
                        $withPoint = $tickets->whereNotNull('point');
                    @endphp
                    {{ $withPoint->count() > 0 ? round($withPoint->avg('point')).'%' : '-' }}
                </span>
            </td>
        </tr>
    </table>

    <table class="data">

    <thead>

    <tr>
        <th>No</th>
        <th>Kode Tiket</th>
        <th>Judul</th>
        <th>Pelapor</th>
        <th>Layanan</th>
        <th>Bidang</th>
        <th>Staff</th>
        <th>Prioritas</th>
        <th>Status</th>
        <th>Tgl Dibuat</th>
        <th>Tgl Selesai</th>
        <th class="text-center">SLA (Jam)</th>
        <th class="text-center">Poin</th>
    </tr>

    </thead>

    <tbody>

    @forelse($tickets as $ticket)

    <tr>

        <td>{{ $loop->iteration }}</td>
        <td>{{ $ticket->kode_ticket }}</td>
        <td>{{ $ticket->judul }}</td>
        <td>{{ $ticket->user->name ?? '-' }}</td>
        <td>{{ $ticket->service->nama_layanan ?? '-' }}</td>
        <td>{{ $ticket->service->department->nama_bidang ?? '-' }}</td>
        <td>{{ $ticket->staff->name ?? 'Belum diambil' }}</td>
        <td>{{ $ticket->prioritas }}</td>

        <td>
            @if($ticket->status == 'Completed')
                <span class="badge bg-success">Completed</span>
            @elseif($ticket->status == 'In Progress')
                <span class="badge bg-info">In Progress</span>
            @else
                <span class="badge bg-warning">To Do</span>
            @endif
        </td>

        <td>{{ $ticket->created_at?->format('d/m/Y H:i') }}</td>
        <td>{{ $ticket->completed_at?->format('d/m/Y H:i') ?? '-' }}</td>
        <td class="text-center">{{ $ticket->service->sla ?? '-' }}</td>
        <td class="text-center">
            {{ $ticket->point !== null ? number_format($ticket->point, 0).'%' : '-' }}
        </td>

    </tr>

    @empty

    <tr>
        <td colspan="13" class="text-center">Belum ada data tiket pada periode ini.</td>
    </tr>

    @endforelse

    </tbody>

    </table>
    <div class="ttd-wrap">
        <div class="ttd-box">
            <p>Pemalang, {{ now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <div class="ttd-space"></div>
            <p><strong>{{ auth()->user()->name }}</strong></p>
            <p>{{ ucfirst(auth()->user()->role) }} Helpdesk</p>
        </div>
        <div class="clearfix"></div>
    </div>

    <p class="footer-note">
        Dokumen ini dihasilkan otomatis oleh Sistem Helpdesk Pemkab Pemalang.
    </p>

</body>
</html>