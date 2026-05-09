<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Buat User Admin
    \App\Models\User::create([
        'name' => 'Admin Siakad',
        'email' => 'admin@siakad.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // Buat Data Fakultas & Prodi
    $fakultas = \App\Models\Fakultas::create(['nama_fakultas' => 'Teknik']);
    \App\Models\Prodi::create([
        'fakultas_id' => $fakultas->id,
        'nama_prodi' => 'Informatika'
    ]);

    // Tambahkan Ruangan untuk Testing Booking
    \App\Models\Ruangan::create([
        'nama_ruangan' => 'Lab Komp 1',
        'kapasitas' => 30
    ]);
}
}
