<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKuliah;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\Ruangan;
use Carbon\Carbon;

class JadwalKuliahController extends Controller
{
    // === Fitur Manajemen Jadwal Kuliah ===
    
    // Tampilkan Daftar Jadwal
    public function index()
    {
        $jadwal = JadwalKuliah::with(['matakuliah', 'dosen', 'ruangan'])->latest()->get();

        $master_mk = Matakuliah::all();
        $master_dosen = Dosen::all(); 
        $master_ruangan = Ruangan::all();

        // Kalkulasi Statistik
        $totalJadwal = $jadwal->count();
        $kelasAktif = $jadwal->where('status', 'Aktif')->count();
        $ruanganDigunakan = $jadwal->pluck('ruangan_id')->unique()->count();

        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');
        $jadwalHariIni = $jadwal->where('hari', $hariIni)->count();

        return view('admin.jadwal_kuliah', compact(
            'jadwal', 'master_mk', 'master_dosen', 'master_ruangan', 
            'totalJadwal', 'kelasAktif', 'ruanganDigunakan', 'jadwalHariIni'
        ));
    }

    // Tambah Jadwal Baru
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id'      => 'required|exists:dosens,id',
            'ruangan_id'    => 'required|exists:ruangans,id',
            'hari'          => 'required|string',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
            'semester'      => 'required|integer|min:1|max:8',
            'status'        => 'required|string',
        ]);

        $data = $request->all();
        $data['mata_kuliah_id'] = $request->mata_kuliah_id;

        JadwalKuliah::create($data);

        return redirect()->back()->with('success', 'Jadwal Kuliah baru berhasil ditambahkan!');
    }

    // Update Jadwal Kuliah
    public function update(Request $request, $id)
    {
        $j = JadwalKuliah::findOrFail($id);
        
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id'      => 'required|exists:dosens,id',
            'ruangan_id'    => 'required|exists:ruangans,id',
            'hari'          => 'required|string',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required',
            'semester'      => 'required|integer|min:1|max:8',
            'status'        => 'required|string',
        ]);

        $j->update($request->all());
        
        return redirect()->back()->with('success', 'Jadwal Kuliah berhasil diperbarui!');
    }

    // Hapus Jadwal Kuliah
    public function destroy($id)
    {
        JadwalKuliah::findOrFail($id)->delete();
        
        return redirect()->back()->with('success', 'Jadwal Kuliah berhasil dihapus!');
    }
}