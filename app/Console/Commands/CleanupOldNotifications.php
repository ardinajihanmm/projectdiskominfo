<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;

class CleanupOldNotifications extends Command
{
    protected $signature = 'notifications:cleanup';

    protected $description = 'Hapus notifikasi (semua role) yang sudah lebih dari 30 hari';

    public function handle(): void
    {
        $deleted = Notification::where('created_at', '<', now()->subDays(30))
            ->delete();

        $this->info("Berhasil menghapus {$deleted} notifikasi yang sudah lebih dari 30 hari.");
    }
}