<!DOCTYPE html>
<html>
<head>
    <style>
        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid black;
            padding:8px;
        }

        th{
            background:#0d6efd;
            color:white;
        }
    </style>
</head>
<body>

<h2>Data Ticket</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>Judul</th>
<th>Pelapor</th>
<th>Layanan</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($tickets as $ticket)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $ticket->judul }}</td>

<td>{{ $ticket->user->name }}</td>

<td>{{ $ticket->service->nama_layanan }}</td>

<td>{{ $ticket->status }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>