<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected ?int $departmentId;

    public function __construct(?int $departmentId = null)
    {
        $this->departmentId = $departmentId;
    }

    public function collection()
    {
        $query = Ticket::with(['user', 'service.department', 'staff']);

        if ($this->departmentId) {
            $query->whereHas('service', function ($q) {
                $q->where('department_id', $this->departmentId);
            });
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Tiket',
            'Judul',
            'Pelapor',
            'Layanan',
            'Bidang',
            'Staff',
            'Prioritas',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Selesai',
            'SLA (Jam)',
            'Poin (%)',
        ];
    }

    public function map($ticket): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $ticket->kode_ticket,
            $ticket->judul,
            $ticket->user->name ?? '-',
            $ticket->service->nama_layanan ?? '-',
            $ticket->service->department->nama_bidang ?? '-',
            $ticket->staff->name ?? 'Belum diambil',
            $ticket->prioritas,
            $ticket->status,
            optional($ticket->created_at)->format('d/m/Y H:i'),
            optional($ticket->completed_at)->format('d/m/Y H:i') ?? '-',
            $ticket->service->sla ?? '-',
            $ticket->point !== null ? number_format($ticket->point, 0) : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0D6EFD'],
                ],
            ],
        ];
    }
    public function exportPdf()
{
    $admin = auth()->user();

    $query = Ticket::with(['user', 'service.department', 'staff']);

    if ($admin->isScopedToDepartment()) {
        $query->whereHas('service', function ($q) use ($admin) {
            $q->where('department_id', $admin->department_id);
        });
    }

    $tickets = $query->get();

    $departmentName = $admin->isScopedToDepartment()
        ? $admin->department->nama_bidang
        : null;

    $pdf = Pdf::loadView('admin.ticket.pdf', compact('tickets', 'departmentName'));

    return $pdf->download('data-ticket.pdf');
}
}