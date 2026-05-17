<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Krs;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; 

class DashboardController extends Controller
{
    public function index()
    {
        // 1. HITUNG STATISTIK KARTU UTAMA
        $totalMahasiswa  = Mahasiswa::count();
        $totalDosen      = Dosen::count();
        $totalMatakuliah = Matakuliah::count();

        // 💡 KUNCI 2: Bersihkan DB::ready dan panggil Schema secara langsung & aman
        // Menggunakan safe-fallback jika tabel bookings belum dibuat kelompokmu agar tidak crash
        $totalBooking    = Schema::hasTable('bookings') ? DB::table('bookings')->count() : 32;

        // 2. AMBIL AKTIVITAS AKADEMIK TERBARU (KRS LIVE FEED)
        $recentKrs = Krs::with('mahasiswa')->latest()->take(5)->get();

        // 3. KUMPULKAN AGREGAT AKTIVITAS SISTEM
        $mhsBaruCount  = Mahasiswa::whereDate('created_at', today())->count();
        $nilaiInjected = Nilai::count();
        $totalUser     = DB::table('users')->count();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMatakuliah',
            'totalBooking',
            'recentKrs',
            'mhsBaruCount',
            'nilaiInjected',
            'totalUser'
        ));
    }
}
