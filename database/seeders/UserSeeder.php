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
        \App\Models\User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Dosen
        \App\Models\User::create([
            'name' => 'Dosen Teknik',
            'email' => 'dosen@siakad.com',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        // Mahasiswa
        \App\Models\User::create([
            'name' => 'Hanif Mahasiswa',
            'email' => 'hanif@siakad.com',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);
    }
}
