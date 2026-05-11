<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Dosen
        User::create([
            'name' => 'Dosen Teknik',
            'email' => 'dosen@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Hanif Mahasiswa',
            'email' => 'hanif@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        $this->call([
        UserSeeder::class,
        AcademicSeeder::class,
        RoomSeeder::class,
    ]);
    }
}
