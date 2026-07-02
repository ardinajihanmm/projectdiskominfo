<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create([
            'agency_id' => 1,
            'nama_bidang' => 'Bidang Pengelolaan Aplikasi Informatika',
            'status' => true,
        ]);
    }
}