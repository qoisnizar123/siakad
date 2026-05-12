<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.dashboard');
    }
    public function krs()
    {
        return view('mahasiswa.krs');
    }
    public function khs()
    {
        return view('mahasiswa.khs');
    }
    public function jadwal()
    {
        return view('mahasiswa.jadwal_kuliah');
    }
    public function booking()
    {
        $ruangan = Ruangan::all();
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();
        return view('mahasiswa.booking_ruangan', compact('ruangan', 'bookings'));
    }
    public function storeBooking(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal'    => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan'   => 'required|min:5',
        ]);

        // 2. Logika Cek Bentrok (The Golden Rule)
        // Kita cari apakah ada booking yang jamnya bersinggungan
        $isBentrok = Booking::where('ruangan_id', $request->ruangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'ditolak') // Booking yang sudah ditolak abaikan saja
            ->where(function ($query) use ($request) {
                $query->where('jam_mulai', '<', $request->jam_selesai)
                    ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->exists();

        if ($isBentrok) {
            return back()->withInput()->with('error', 'Waduh, ruangan tersebut sudah dibooking orang lain di jam yang sama. Coba cari jam atau ruangan lain ya!');
        }

        // 3. Simpan Data
        Booking::create([
            'user_id'     => Auth::id(),
            'ruangan_id'  => $request->ruangan_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan'   => $request->keperluan,
            'status'      => 'menunggu', // Default awal
        ]);

        return redirect()->route('mahasiswa.booking')->with('success', 'Permintaan booking berhasil dikirim! Silakan cek statusnya secara berkala.');
    }
}
