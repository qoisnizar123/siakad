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
    public function dashboard()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return view('mahasiswa.dashboard', [
                'ipk' => 0, 'sksDiambil' => 0, 'semester' => 1, 'statusAkun' => 'Tidak Aktif', 'jadwals' => collect()
            ]);
        }

        // 💡 FIX: Ambil KRS pakai jadwal_id dan status 'approved'
        $krs = Krs::with('jadwal.matakuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'approved') 
            ->get();
            
        $sksDiambil = $krs->sum(function($k) {
            return $k->jadwal->matakuliah->sks ?? 0;
        });

        // Hitung IPK
        $nilais = \App\Models\Nilai::with('matakuliah')->where('mahasiswa_id', $mahasiswa->id)->get();
        $totalSksNilai = 0;
        $totalMutu = 0;
        
        foreach ($nilais as $n) {
            $sks = $n->matakuliah->sks ?? 0;
            $nilaiAngka = $n->nilai_angka ?? $n->nilai ?? 0;
            
            $bobot = $n->bobot ?? null;
            if (is_null($bobot)) {
                if ($nilaiAngka >= 85) { $bobot = 4; }
                elseif ($nilaiAngka >= 75) { $bobot = 3; }
                elseif ($nilaiAngka >= 60) { $bobot = 2; }
                elseif ($nilaiAngka >= 45) { $bobot = 1; }
                else { $bobot = 0; }
            }
            $totalSksNilai += $sks;
            $totalMutu += ($bobot * $sks);
        }
        $ipk = $totalSksNilai > 0 ? round($totalMutu / $totalSksNilai, 2) : 0.00;

        // Preview Jadwal
        $jadwalIds = $krs->pluck('jadwal_id');
        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])
            ->whereIn('id', $jadwalIds)
            ->orderBy('hari', 'asc')
            ->limit(5)
            ->get();

        $semester = $mahasiswa->semester ?? 1;
        $statusAkun = $mahasiswa->status ?? 'Aktif';

        return view('mahasiswa.dashboard', compact('ipk', 'sksDiambil', 'semester', 'statusAkun', 'jadwals'));
    }

    // === Fitur KRS Mahasiswa ===
    public function krs()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen'])->orderBy('hari', 'asc')->get();

        // 💡 FIX: keyBy jadwal_id
        $krsSaya = Krs::with('jadwal.matakuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get()
            ->keyBy('jadwal_id');

        $totalSksSaatIni = 0;
        foreach ($krsSaya as $krs) {
            if ($krs->status == 'approved') {
                $totalSksSaatIni += $krs->jadwal->matakuliah->sks ?? 0;
            }
        }

        return view('mahasiswa.krs', compact('mahasiswa', 'jadwals', 'krsSaya', 'totalSksSaatIni'));
    }

   public function storeKrs(Request $request)
    {
        // 1. Validasi Input Standar Laravel
        $request->validate([
            'jadwal_id'   => 'required|array',
            'jadwal_id.*' => 'exists:jadwal_kuliahs,id'
        ], [
            'jadwal_id.required' => 'Anda harus menceklis minimal satu jadwal mata kuliah.'
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // 2. Kalkulasi SKS Saat ini (Dari KRS yang sudah ada)
        $krsSaya = Krs::with('jadwal.matakuliah')->where('mahasiswa_id', $mahasiswa->id)->get();
        $sksSaatIni = $krsSaya->sum(function($krs) {
            return $krs->jadwal->matakuliah->sks ?? 0;
        });

        // 3. Kalkulasi Tambahan SKS (Dari form yang baru disubmit)
        $jadwalsDitambah = JadwalKuliah::with('matakuliah')->whereIn('id', $request->jadwal_id)->get();
        $sksTambahan = $jadwalsDitambah->sum(function($j) {
            return $j->matakuliah->sks ?? 0;
        });

        // 4. Proteksi Batas SKS
        if (($sksSaatIni + $sksTambahan) > 24) {
            return redirect()->back()->withErrors(['Batas SKS Terlampaui! Total SKS Anda melebihi batas maksimal 24 SKS.']);
        }

        // 5. Simpan ke Database
        foreach ($request->jadwal_id as $j_id) {
            Krs::firstOrCreate([
                'mahasiswa_id' => $mahasiswa->id,
                'jadwal_id'    => $j_id, 
            ], [
                'status'       => 'pending' 
            ]);
        }

        return redirect()->back()->with('success', 'KRS berhasil diajukan! Silakan tunggu persetujuan dari Dosen.');
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

        foreach ($nilais as $n) {
            $sks = $n->matakuliah->sks ?? 0;
            $nilaiAngka = $n->nilai_angka ?? $n->nilai ?? 0; 
            
            $bobot = $n->bobot ?? null;
            $grade = $n->grade ?? null;

            if (is_null($bobot) || is_null($grade)) {
                if ($nilaiAngka >= 85) { $bobot = 4; $grade = 'A'; }
                elseif ($nilaiAngka >= 75) { $bobot = 3; $grade = 'B'; }
                elseif ($nilaiAngka >= 60) { $bobot = 2; $grade = 'C'; }
                elseif ($nilaiAngka >= 45) { $bobot = 1; $grade = 'D'; }
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

        // 💡 FIX: Ambil jadwal dari KRS yang sudah di-approve dosen
        $krsSaya = Krs::with('jadwal.matakuliah')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'approved') 
            ->get();
            
        $jadwalIds = $krsSaya->pluck('jadwal_id');

        $jadwals = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])
            ->whereIn('id', $jadwalIds)
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $totalSks = $krsSaya->sum(function($krs) {
            return $krs->jadwal->matakuliah->sks ?? 0;
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
            return back()->with('error', 'Akses ditolak!');
        }

        if ($booking->status !== 'menunggu' && $booking->status !== 'dipesan') {
            return back()->with('error', 'Booking yang sudah diproses tidak bisa dibatalkan.');
        }

        $booking->delete();
        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}