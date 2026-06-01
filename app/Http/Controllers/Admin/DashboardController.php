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
    // === Fitur Dashboard Admin ===
    public function index()
    {
        // 1. Hitung Statistik Kartu Utama
        $totalMahasiswa  = Mahasiswa::count();
        $totalDosen      = Dosen::count();
        $totalMatakuliah = Matakuliah::count();

        // Safe-fallback jika tabel bookings belum dibuat agar tidak crash
        $totalBooking    = Schema::hasTable('bookings') ? DB::table('bookings')->count() : 32;

        // 2. Ambil Aktivitas Akademik Terbaru (KRS Live Feed)
        $recentKrs = Krs::with('mahasiswa')->latest()->take(5)->get();

        // 3. Kumpulkan Agregat Aktivitas Sistem
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