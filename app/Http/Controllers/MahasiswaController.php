<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use App\Models\JadwalKuliah;
use App\Models\Mahasiswa;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    // === Fitur Dashboard Mahasiswa ===
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Fallback jika akun belum terhubung dengan profil
        if (!$mahasiswa) {
            return view('mahasiswa.dashboard', [
                'ipk' => 0,
                'sksDiambil' => 0,
                'semester' => 1,
                'statusAkun' => 'Tidak Aktif',
                'jadwals' => collect()
            ]);
        }

        // 1. Hitung SKS Diambil (Dari KRS)
        $krs = Krs::with('matakuliah')->where('mahasiswa_id', $mahasiswa->id)->get();
        $sksDiambil = $krs->sum(function($k) {
            return $k->matakuliah->sks ?? 0;
        });

        // 2. Hitung IPK (Dari Nilai)
        $nilais = \App\Models\Nilai::with('matakuliah')->where('mahasiswa_id', $mahasiswa->id)->get();
        $totalSksNilai = 0;
        $totalMutu = 0;
        
        foreach ($nilais as $n) {
            $sks = $n->matakuliah->sks ?? 0;
            $nilaiAngka = $n->nilai_angka ?? $n->nilai ?? 0;
            
            $bobot = $n->bobot ?? null;
            if (is_null($bobot)) {
                if ($nilaiAngka >= 85) { $bobot = 4; }
                elseif ($nilaiAngka >= 70) { $bobot = 3; }
                elseif ($nilaiAngka >= 55) { $bobot = 2; }
                elseif ($nilaiAngka >= 40) { $bobot = 1; }
                else { $bobot = 0; }
            }
            $totalSksNilai += $sks;
            $totalMutu += ($bobot * $sks);
        }
        
        $ipk = $totalSksNilai > 0 ? round($totalMutu / $totalSksNilai, 2) : 0.00;

        // 3. Ambil Jadwal Kuliah (Max 5 untuk preview)
        $mkIds = $krs->pluck('mata_kuliah_id');
        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])
            ->whereIn('mata_kuliah_id', $mkIds)
            ->orderBy('hari', 'asc')
            ->limit(5)
            ->get();

        $semester = $mahasiswa->semester ?? 1;
        $statusAkun = $mahasiswa->status ?? 'Aktif';

        return view('mahasiswa.dashboard', compact('ipk', 'sksDiambil', 'semester', 'statusAkun', 'jadwals'));
    }

    // === Fitur KRS Mahasiswa ===
    
    // Halaman Pengisian KRS
    public function krs()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen'])->orderBy('hari', 'asc')->get();

        // Jadikan keyBy 'mata_kuliah_id' agar mudah dicek di Blade
        $krsSaya = Krs::where('mahasiswa_id', $mahasiswa->id)->get()->keyBy('mata_kuliah_id');

        $totalSksSaatIni = 0;
        foreach ($krsSaya as $krs) {
            $totalSksSaatIni += $krs->matakuliah->sks ?? 0;
        }

        return view('mahasiswa.krs', compact('mahasiswa', 'jadwals', 'krsSaya', 'totalSksSaatIni'));
    }

    // Proses Simpan Pengajuan KRS
    public function storeKrs(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|array',
        ], [
            'mata_kuliah_id.required' => 'Anda harus memilih minimal satu mata kuliah untuk diajukan.'
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Validasi SKS Maksimal
        $krsSaya = Krs::with('matakuliah')->where('mahasiswa_id', $mahasiswa->id)->get();
        $sksSaatIni = $krsSaya->sum(function($krs) {
            return $krs->matakuliah->sks ?? 0;
        });

        $sksTambahan = \App\Models\Matakuliah::whereIn('id', $request->mata_kuliah_id)->sum('sks');

        if (($sksSaatIni + $sksTambahan) > 24) {
            return redirect()->back()->withErrors(['Batas SKS Terlampaui! Total SKS Anda melebihi batas maksimal 24 SKS.']);
        }

        // Proses Simpan
        foreach ($request->mata_kuliah_id as $mk_id) {
            Krs::firstOrCreate([
                'mahasiswa_id' => $mahasiswa->id,
                'mata_kuliah_id' => $mk_id,
            ], [
                'status' => 'Menunggu' 
            ]);
        }

        return redirect()->back()->with('success', 'KRS berhasil diajukan! Silakan tunggu persetujuan dari Dosen bersangkutan.');
    }

    // === Fitur KHS & Penilaian ===
    public function khs()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $nilais = \App\Models\Nilai::with('matakuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get();

        $totalSks = 0;
        $totalMutu = 0;
        $totalMataKuliah = $nilais->count();

        // Kalkulasi Mutu & Grade Otomatis
        foreach ($nilais as $n) {
            $sks = $n->matakuliah->sks ?? 0;
            $nilaiAngka = $n->nilai_angka ?? $n->nilai ?? 0; 
            
            $bobot = $n->bobot ?? null;
            $grade = $n->grade ?? null;

            if (is_null($bobot) || is_null($grade)) {
                if ($nilaiAngka >= 85) { $bobot = 4; $grade = 'A'; }
                elseif ($nilaiAngka >= 70) { $bobot = 3; $grade = 'B'; }
                elseif ($nilaiAngka >= 55) { $bobot = 2; $grade = 'C'; }
                elseif ($nilaiAngka >= 40) { $bobot = 1; $grade = 'D'; }
                else { $bobot = 0; $grade = 'E'; }
            }

            $mutu = $bobot * $sks;
            
            $n->calculated_grade = $grade;
            $n->calculated_bobot = $bobot;
            $n->calculated_mutu = $mutu;

            $totalSks += $sks;
            $totalMutu += $mutu;
        }

        $ips = $totalSks > 0 ? round($totalMutu / $totalSks, 2) : 0.00;
        $ipk = $ips;

        return view('mahasiswa.khs', compact(
            'mahasiswa', 'nilais', 'totalSks', 'totalMutu', 'totalMataKuliah', 'ips', 'ipk'
        ));
    }

    // === Fitur Jadwal Kuliah ===
    public function jadwalKuliah()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Ambil ID mata kuliah yang terdaftar di KRS
        $krsSaya = Krs::with('matakuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get();
        $mkIds = $krsSaya->pluck('mata_kuliah_id');

        // Tarik jadwal hanya untuk mata kuliah di KRS
        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])
            ->whereIn('mata_kuliah_id', $mkIds)
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $totalSks = $krsSaya->sum(function($krs) {
            return $krs->matakuliah->sks ?? 0;
        });

        $semesterMahasiswa = $mahasiswa->semester ?? 1;

        return view('mahasiswa.jadwal_kuliah', compact('jadwals', 'totalSks', 'semesterMahasiswa'));
    }

    // === Fitur Booking Ruangan ===
    public function booking()
    {
        $ruangan = Ruangan::all();
        $bookings = Booking::where('user_id', auth()->id())->latest()->get();
        return view('mahasiswa.booking_ruangan', compact('ruangan', 'bookings'));
    }

    // Proses Pemesanan Ruangan
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

    // Proses Pembatalan Pemesanan
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