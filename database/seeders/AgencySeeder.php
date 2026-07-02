<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgencySeeder extends Seeder
{
    public function run(): void
    {
        Agency::create([
            'nama_dinas' => 'Dinas Komunikasi dan Informatika Kabupaten Pemalang',
            'kode_dinas' => 'DISKOMINFO',
            'status' => true,
        ]);
    }
}