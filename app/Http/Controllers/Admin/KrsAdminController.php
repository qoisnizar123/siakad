<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class KrsAdminController extends Controller
{
    // === Fitur Validasi KRS Mahasiswa (Admin) ===
    
    // Tampilkan Data Pengajuan KRS
    public function index()
    {
        // Load data KRS beserta seluruh relasinya secara efisien
        $krsGrouped = Krs::with(['mahasiswa.prodi', 'jadwal.matakuliah'])
            ->get()
            ->groupBy('mahasiswa_id');

        $master_mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        $master_jadwal = JadwalKuliah::with('matakuliah')->where('status', 'Aktif')->get();

        // Kalkulasi Statistik
        $totalPengajuan = $krsGrouped->count();
        $disetujui      = 0;
        $menunggu       = 0;

        foreach ($krsGrouped as $krsItems) {
            // Jika ada satu saja mata kuliah yang 'pending', status mahasiswa dianggap 'Menunggu'
            if ($krsItems->contains('status', 'pending')) {
                $menunggu++;
            } else {
                $disetujui++;
            }
        }
        
        $ditolak = 0; // Cadangan status

        return view('admin.krs_mahasiswa', compact('krsGrouped', 'master_mahasiswa', 'master_jadwal', 'totalPengajuan', 'disetujui', 'menunggu', 'ditolak'));
    }

    // Admin Mendaftarkan Mahasiswa ke Kelas secara Manual
    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'jadwal_id'    => 'required|exists:jadwal_kuliahs,id',
        ]);

        // Proteksi duplikasi pengambilan kelas yang sama
        $cekDuplikasi = Krs::where('mahasiswa_id', $request->mahasiswa_id)
            ->where('jadwal_id', $request->jadwal_id)
            ->exists();

        if ($cekDuplikasi) {
            return redirect()->back()->withErrors(['error' => 'Gagal! Mahasiswa yang bersangkutan sudah terdaftar mengambil mata kuliah tersebut.']);
        }

        Krs::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'jadwal_id'    => $request->jadwal_id,
            'status'       => 'approved' // Jika admin yang menginputkan, otomatis disetujui
        ]);

        return redirect()->back()->with('success', 'Mata kuliah baru berhasil ditambahkan ke KRS Mahasiswa!');
    }

    // Persetujuan KRS Massal oleh Admin
    public function updateStatus(Request $request, $mahasiswa_id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved'
        ]);

        Krs::where('mahasiswa_id', $mahasiswa_id)->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status validasi KRS mahasiswa berhasil diperbarui!');
    }

    // Hapus/Reset Seluruh KRS Mahasiswa
    public function destroy($mahasiswa_id)
    {
        Krs::where('mahasiswa_id', $mahasiswa_id)->delete();
        
        return redirect()->back()->with('success', 'Seluruh data KRS mahasiswa berhasil dihapus dari sistem!');
    }
}