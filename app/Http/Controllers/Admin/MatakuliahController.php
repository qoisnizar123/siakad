<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class MatakuliahController extends Controller
{
    // === Fitur Manajemen Data Mata Kuliah ===
    
    // Tampilkan Daftar Mata Kuliah
    public function index()
    {
        $matakuliah = Matakuliah::with('prodi')->latest()->get();
        $prodis = DB::table('prodis')->get();

        $totalMatakuliah = $matakuliah->count();
        $totalSks = $matakuliah->sum('sks');
        $wajib = $matakuliah->where('semester', '<=', 6)->count();
        $pilihan = $matakuliah->where('semester', '>', 6)->count();

        return view('admin.matakuliah', compact('matakuliah', 'totalMatakuliah', 'totalSks', 'wajib', 'pilihan', 'prodis'));
    }

    // Tambah Mata Kuliah Baru
    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodis,id', 
            'kode_mk'  => 'required|unique:mata_kuliahs,kode_mk|max:10',
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        Matakuliah::create($request->all());

        return redirect()->back()->with('success', 'Mata Kuliah baru berhasil ditambahkan!');
    }

    // Update Mata Kuliah
    public function update(Request $request, string $id)
    {
        $mk = Matakuliah::findOrFail($id);

        $request->validate([
            'prodi_id' => 'required|exists:prodis,id',
            'kode_mk'  => 'required|max:10|unique:mata_kuliahs,kode_mk,' . $id,
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $mk->update($request->all());

        return redirect()->back()->with('success', 'Data Mata Kuliah berhasil diperbarui!');
    }

    // Hapus Mata Kuliah
    public function destroy(string $id)
    {
        $mk = Matakuliah::findOrFail($id);
        $mk->delete();

        return redirect()->back()->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}