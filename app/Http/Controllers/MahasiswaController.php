<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pengecekan aman jika relasi mahasiswa belum terikat di DB local
        $semester = $user->mahasiswa->semester ?? 1;
        $statusAkun = $user->status ?? 'Aktif';

        // 1. Hitung SKS Riil (Sesuaikan mata_kuliah_id dan mata_kuliahs)
        $sksDiambil = DB::table('krs')
            ->join('jadwal_kuliahs', 'krs.jadwal_id', '=', 'jadwal_kuliahs.id')
            ->join('mata_kuliahs', 'jadwal_kuliahs.mata_kuliah_id', '=', 'mata_kuliahs.id') // 💡 Perbaikan di mata_kuliah_id
            ->where('krs.mahasiswa_id', $user->mahasiswa->id ?? 0)
            ->where('krs.status', 'approved')
            ->sum('mata_kuliahs.sks') ?? 0;

        // 2. Hitung Total Bobot Nilai
        $totalBobot = DB::table('nilais')
            ->join('mata_kuliahs', 'nilais.mata_kuliah_id', '=', 'mata_kuliahs.id') // 💡 Pastikan pakai mata_kuliah_id jika di tabel nilais juga sama
            ->where('nilais.mahasiswa_id', $user->mahasiswa->id ?? 0)
            ->sum(DB::raw('nilais.bobot * mata_kuliahs.sks'));

        // 3. Hitung Total SKS Nilai
        $totalSksNilai = DB::table('nilais')
            ->join('mata_kuliahs', 'nilais.mata_kuliah_id', '=', 'mata_kuliahs.id')
            ->where('nilais.mahasiswa_id', $user->mahasiswa->id ?? 0)
            ->sum('mata_kuliahs.sks');

        $ipk = $totalSksNilai > 0 ? round($totalBobot / $totalSksNilai, 2) : 0.00;

        // Nilai mock-up aman jika database lokal kelompokmu masih kosong
        if ($ipk == 0) {
            $ipk = 3.75;
        }
        if ($sksDiambil == 0) {
            $sksDiambil = 21;
        }

        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])
            ->where('semester', $semester)
            ->where('status', 'Aktif')
            ->get();

        return view('mahasiswa.dashboard', compact('ipk', 'sksDiambil', 'semester', 'statusAkun', 'jadwals'));
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
        return redirect()->route('mahasiswa.jadwal_kuliah');
    }

    public function booking()
    {
        $ruangan = Ruangan::all();
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();
        return view('mahasiswa.booking_ruangan', compact('ruangan', 'bookings'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal'    => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan'   => 'required|min:5',
        ]);

        $isBentrok = Booking::where('ruangan_id', $request->ruangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'ditolak')
            ->where(function ($query) use ($request) {
                $query->where('jam_mulai', '<', $request->jam_selesai)
                    ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->exists();

        if ($isBentrok) {
            return back()->withInput()->with('error', 'Waduh, ruangan tersebut sudah dibooking orang lain di jam yang sama.');
        }

        Booking::create([
            'user_id'     => Auth::id(),
            'ruangan_id'  => $request->ruangan_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan'   => $request->keperluan,
            'status'      => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.booking')->with('success', 'Permintaan booking berhasil dikirim!');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            return back()->with('error', 'Waduh, kamu tidak punya akses untuk membatalkan booking ini!');
        }

        if ($booking->status !== 'menunggu' && $booking->status !== 'dipesan') {
            return back()->with('error', 'Booking yang sudah diproses tidak bisa dibatalkan.');
        }

        $booking->delete();
        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
