<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class KrsAdminController extends Controller
{
    public function index()
    {
        // Load data KRS beserta seluruh relasi berlapisnya secara efisien
        $krsGrouped = Krs::with(['mahasiswa.prodi', 'jadwal.matakuliah'])
            ->get()
            ->groupBy('mahasiswa_id');

        $master_mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        $master_jadwal = JadwalKuliah::with('matakuliah')->where('status', 'Aktif')->get();

        // 💡 KALKULASI STATISTIK BERDASARKAN ENUM BROWSER
        $totalPengajuan = $krsGrouped->count();
        $disetujui      = 0;
        $menunggu       = 0;

        foreach ($krsGrouped as $krsItems) {
            // Jika ada satu saja mata kuliah yang masih 'pending', status mahasiswa dianggap 'Menunggu'
            if ($krsItems->contains('status', 'pending')) {
                $menunggu++;
            } else {
                $disetujui++;
            }
        }
        $ditolak = 0; // Kolom cadangan statis karena opsi enum database hanya pending & approved

        return view('admin.krs_mahasiswa', compact('krsGrouped', 'master_mahasiswa', 'master_jadwal', 'totalPengajuan', 'disetujui', 'menunggu', 'ditolak'));
    }

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
            'status'       => 'approved' // Jika admin yang menginputkan langsung, otomatis disetujui
        ]);

        return redirect()->back()->with('success', 'Mata kuliah baru berhasil ditambahkan ke KRS Mahasiswa!');
    }

    public function updateStatus(Request $request, $mahasiswa_id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved'
        ]);

        // Persetujuan massal untuk seluruh mata kuliah milik mahasiswa tersebut
        Krs::where('mahasiswa_id', $mahasiswa_id)->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status validasi KRS mahasiswa berhasil diperbarui!');
    }

    public function destroy($mahasiswa_id)
    {
        // Bersihkan seluruh krs mahasiswa terpilih
        Krs::where('mahasiswa_id', $mahasiswa_id)->delete();
        return redirect()->back()->with('success', 'Seluruh data KRS mahasiswa berhasil dihapus dari sistem!');
    }
}
