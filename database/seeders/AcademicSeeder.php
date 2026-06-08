<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\MataKuliah;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        $fakultas = Fakultas::create(['nama_fakultas' => 'Teknik']);

        $prodi = Prodi::create([
            'fakultas_id' => $fakultas->id,
            'nama_prodi' => 'Teknik Informatika'
        ]);

        MataKuliah::create([
            'kode_mk' => 'IF101',
            'nama_mk' => 'Pemrograman Web (Laravel)',
            'sks' => 3,
            'semester' => 1,
            'prodi_id' => $prodi->id
        ]);
    }
}