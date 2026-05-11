<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Ruangan::create(['nama_ruangan' => 'Lab Komputer 1', 'kapasitas' => 25]);
        \App\Models\Ruangan::create(['nama_ruangan' => 'Ruang Teori A2', 'kapasitas' => 40]);
    }
}
