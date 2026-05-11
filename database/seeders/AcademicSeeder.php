<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
            'prodi_id' => $prodi->id
        ]);
    }
}
