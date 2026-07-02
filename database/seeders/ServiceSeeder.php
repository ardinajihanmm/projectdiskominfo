<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::insert([
            [
                'department_id' => 1,
                'nama_layanan' => 'Wifi Desa',
                'deskripsi' => 'Layanan pemasangan dan pemeliharaan Wifi Desa',
                'sla' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama_layanan' => 'Domain desa.id',
                'deskripsi' => 'Pengajuan domain desa.id',
                'sla' => 5,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama_layanan' => 'Jaringan Intra Pemerintah',
                'deskripsi' => 'Layanan jaringan intra pemerintah',
                'sla' => 3,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama_layanan' => 'Website',
                'deskripsi' => 'Layanan pengelolaan website',
                'sla' => 7,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama_layanan' => 'Pusat Data',
                'deskripsi' => 'Layanan pusat data',
                'sla' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama_layanan' => 'Subdomain',
                'deskripsi' => 'Layanan subdomain',
                'sla' => 2,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_id' => 1,
                'nama_layanan' => 'SPLP IPPD',
                'deskripsi' => 'Layanan SPLP IPPD',
                'sla' => 5,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}