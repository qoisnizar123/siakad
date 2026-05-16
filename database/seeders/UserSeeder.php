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
        // Admin
        User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        // Dosen
        User::create([
            'name' => 'Dosen Teknik',
            'email' => 'dosen@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'dosen',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'mahasiswa',
        ]);
    }
}
