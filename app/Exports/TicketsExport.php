<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketsExport implements FromCollection
{
    protected ?int $departmentId;

    public function __construct(?int $departmentId = null)
    {
        $this->departmentId = $departmentId;
    }

    public function collection()
    {
        $query = Ticket::with(['user', 'service', 'staff']);

        if ($this->departmentId) {
            $query->whereHas('service', function ($q) {
                $q->where('department_id', $this->departmentId);
            });
        }

        return $query->get();
    }
}