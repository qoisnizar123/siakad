<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    // Menampilkan semua daftar booking
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
}
