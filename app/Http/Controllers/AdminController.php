<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\MataKuliah;
use App\Models\Prodi;

class AdminController extends Controller
{
    // === Fitur Dashboard ===
    public function index()
    {
        return view('admin.dashboard');
    }

    // === Fitur Data Master Utama ===
    public function dataMahasiswa()
    {
        return view('admin.data_mahasiswa');
    }

    public function dataDosen()
    {
        return view('admin.data_dosen');
    }

    public function mataKuliah()
    {
        // 1. Ambil data untuk ditampilkan di tabel
        $matakuliah = MataKuliah::with('prodi')->get();
        $prodis = Prodi::all();

        // 2. Hitung statistik LANGSUNG DARI DATABASE (Query Builder)
        $totalMatakuliah = MataKuliah::count();
        $wajib = MataKuliah::where('jenis_mk', 'Wajib')->count();
        $pilihan = MataKuliah::where('jenis_mk', 'Pilihan')->count();
        $totalSks = MataKuliah::sum('sks');

        // 3. Lempar ke Blade
        return view('admin.matakuliah', compact(
            'matakuliah', 'prodis', 'totalMatakuliah', 'wajib', 'pilihan', 'totalSks'
        ));
    }

    public function jadwalKuliah()
    {
        return view('admin.jadwal_kuliah');
    }

    // === Fitur Data Akademik ===
    public function krsMahasiswa()
    {
        return view('admin.krs_mahasiswa');
    }

    public function nilaiKHS()
    {
        return view('admin.nilai_khs');
    }

    // === Fitur Booking Ruangan ===
    public function bookingIndex()
    {
        // Mengambil semua data booking, diurutkan dari yang terbaru
        $bookings = Booking::with(['user', 'ruangan'])->latest()->get();
        return view('admin.booking_ruangan', compact('bookings'));
    }

    // Memproses persetujuan atau penolakan
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status
        ]);

        $pesan = $request->status == 'disetujui' ? 'Booking telah disetujui!' : 'Booking telah ditolak.';

        return back()->with('success', $pesan);
    }

    // === Fitur Pengaturan Sistem ===
    public function manajemenUser()
    {
        return view('admin.manajemen_user');
    }

    public function pengaturanSistem()
    {
        return view('admin.pengaturan_sistem');
    }
}