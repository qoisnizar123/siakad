<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class NilaiKhsController extends Controller
{
    // === Fitur Manajemen Input Nilai Akademik ===
    
    // Tampilkan Daftar Nilai
    public function index()
    {
        $nilais = Nilai::with(['mahasiswa', 'matakuliah'])->latest()->get();
        $master_mahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        $master_mk = Matakuliah::all();

        $totalNilai = $nilais->count();
        $mahasiswaLulus = $nilais->where('status', 'Lulus')->count();
        $remedial = $nilais->where('status', 'Remedial')->count();

        // Rata-rata bobot sebagai representasi IPK di dashboard
        $ipkTertinggi = $nilais->avg('bobot') ?? 0.00;
        $ipkTertinggi = number_format($ipkTertinggi, 2);

        return view('admin.nilai_khs', compact('nilais', 'master_mahasiswa', 'master_mk', 'totalNilai', 'ipkTertinggi', 'mahasiswaLulus', 'remedial'));
    }

    // Tambah/Update Nilai (Konversi Otomatis)
    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id'   => 'required|exists:mahasiswas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai_angka'    => 'required|numeric|min:0|max:100',
        ]);

        $angka = $request->nilai_angka;

        // Aturan standar konversi nilai akademik
        if ($angka >= 85) {
            $huruf = 'A'; $bobot = 4.00; $status = 'Lulus';
        } elseif ($angka >= 75) {
            $huruf = 'B'; $bobot = 3.00; $status = 'Lulus';
        } elseif ($angka >= 60) {
            $huruf = 'C'; $bobot = 2.00; $status = 'Lulus';
        } elseif ($angka >= 45) {
            $huruf = 'D'; $bobot = 1.00; $status = 'Perbaikan';
        } else {
            $huruf = 'E'; $bobot = 0.00; $status = 'Remedial';
        }

        // Mencegah duplikasi nilai: akan di-overwrite jika sudah ada
        Nilai::updateOrCreate(
            ['mahasiswa_id' => $request->mahasiswa_id, 'mata_kuliah_id' => $request->mata_kuliah_id],
            ['nilai_angka' => $angka, 'nilai_huruf' => $huruf, 'bobot' => $bobot, 'status' => $status]
        );

        return redirect()->back()->with('success', 'Nilai akademik berhasil diproses dan dikonversi otomatis oleh sistem!');
    }

    // Hapus Nilai
    public function destroy($id)
    {
        Nilai::findOrFail($id)->delete();
        
        return redirect()->back()->with('success', 'Data record nilai berhasil dihapus!');
    }
}