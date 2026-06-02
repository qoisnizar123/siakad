<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = \App\Models\Fakultas::create(['nama_fakultas' => 'Teknik']);

        $prodi = \App\Models\Prodi::create([
            'fakultas_id' => $fakultas->id,
            'nama_prodi' => 'Teknik Informatika'
        ]);

        \App\Models\MataKuliah::create([
            'kode_mk' => 'IF101',
            'nama_mk' => 'Pemrograman Web (Laravel)',
            'sks' => 3,
            'semester' => 1, // 💡 INI YANG KETINGGALAN
            'prodi_id' => $prodi->id
        ]);
    }
}