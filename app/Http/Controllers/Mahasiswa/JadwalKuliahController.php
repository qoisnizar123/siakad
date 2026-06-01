<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        // 1. Ambil data akun user yang sedang login beserta data profil induk mahasiswanya
        $user = Auth::user();

        // Proteksi jika akun user belum terikat ke profil mahasiswa lokal
        if (!$user || $user->role !== 'mahasiswa' || !$user->mahasiswa) {
            return redirect()->to('/')->withErrors(['error' => 'Profil data mahasiswa Anda tidak ditemukan.']);
        }

        // 2. Kunci semester berjalan milik mahasiswa tersebut (contoh: Semester 3 atau 5)
        $semesterMahasiswa = $user->mahasiswa->semester;

        // 3. CORE QUERY: Ambil jadwal kuliah yang HANYA dibuka untuk semester mahasiswa ini
        // Eager loading matakuliah, dosen, dan ruangan agar performa database lokal kencang
        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])
            ->where('semester', $semesterMahasiswa)
            ->where('status', 'Aktif')
            ->orderByRaw("CASE 
                WHEN hari = 'Senin' THEN 1 
                WHEN hari = 'Selasa' THEN 2 
                WHEN hari = 'Rabu' THEN 3 
                WHEN hari = 'Kamis' THEN 4 
                WHEN hari = 'Jumat' THEN 5 
                ELSE 6 END")
            ->get();

        // 4. Hitung ringkasan statistik kecil untuk info atas panel mahasiswa
        $totalMatakuliah = $jadwals->unique('mata_kuliah_id')->count();
        $totalSks = $jadwals->sum(function ($j) {
            return $j->matakuliah->sks ?? 0;
        });

        return view('mahasiswa.jadwal_kuliah', compact('jadwals', 'semesterMahasiswa', 'totalMatakuliah', 'totalSks'));
    }
}
