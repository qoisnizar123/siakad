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

        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Siakad',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun & Profil Dosen
        $userDosen = User::create([
            'name' => 'Dosen Teknik',
            'email' => 'dosen@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'dosen',
        ]);
        
        // Buat profil otomatis
        Dosen::create([
            'user_id' => $userDosen->id,
            'nidn' => '1122334455',
            'nama_dosen' => 'Dosen Teknik, M.Kom',
            'email' => 'dosen@siakad.com',
            'prodi_id' => $prodi->id,
            'jabatan' => 'Lektor',
            'status' => 'Aktif'
        ]);

        // 3. Buat Akun & Profil Mahasiswa
        $userMhs = User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@siakad.com',
            'password' => bcrypt('12345678'),
            'role' => 'mahasiswa',
        ]);
        
        // Buat profil otomatis
        Mahasiswa::create([
            'user_id' => $userMhs->id,
            'nim' => '22010001',
            'nama_mahasiswa' => 'Mahasiswa',
            'email' => 'mahasiswa@siakad.com',
            'prodi_id' => $prodi->id,
            'semester' => 1,
            'angkatan' => '2022',
            'status' => 'Aktif'
        ]);
    }
}