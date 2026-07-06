<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder data master
        $this->call([
            AgencySeeder::class,
            DepartmentSeeder::class,
            ServiceSeeder::class,
        ]);

        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'no_hp' => '08123456789',
            'instansi' => 'Diskominfo',
        ]);
    }
}
