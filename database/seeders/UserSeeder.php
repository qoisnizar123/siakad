<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Dosen users
        User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@siakad.com',
            'nidn' => '0012345678',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
        ]);

        User::create([
            'name' => 'Prof. Siti Nurhaliza',
            'email' => 'siti@siakad.com',
            'nidn' => '0087654321',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
        ]);

        // Mahasiswa users
        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@student.com',
            'npm' => '2021001',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Sinta Dewi',
            'email' => 'sinta@student.com',
            'npm' => '2021002',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Rudi Pratama',
            'email' => 'rudi@student.com',
            'npm' => '2021003',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);
    }
}
