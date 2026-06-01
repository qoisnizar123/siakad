<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

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
        return view('admin.matakuliah');
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
    public function updateStatus(Request $request, $id)
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