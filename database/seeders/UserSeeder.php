<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data prodi yang baru saja dibuat oleh AcademicSeeder
        $prodi = Prodi::first();

        User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}