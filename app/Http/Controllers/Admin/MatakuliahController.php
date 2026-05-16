<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class MatakuliahController extends Controller
{
    public function index()
    {
        // Mengambil mata kuliah beserta data relasi prodi-nya
        $matakuliah = Matakuliah::with('prodi')->latest()->get();

        // Ambil data langsung dari tabel prodis untuk di-looping di modal dropdown
        $prodis = DB::table('prodis')->get();

        $totalMatakuliah = $matakuliah->count();
        $totalSks = $matakuliah->sum('sks');
        $wajib = $matakuliah->where('semester', '<=', 6)->count();
        $pilihan = $matakuliah->where('semester', '>', 6)->count();

        return view('admin.matakuliah', compact('matakuliah', 'totalMatakuliah', 'totalSks', 'wajib', 'pilihan', 'prodis'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodis,id', // 💡 Wajib dipilih dan harus ada di tabel prodis
            'kode_mk'  => 'required|unique:mata_kuliahs,kode_mk|max:10',
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        Matakuliah::create($request->all());

        return redirect()->back()->with('success', 'Mata Kuliah baru berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $mk = Matakuliah::findOrFail($id);

        $request->validate([
            'prodi_id' => 'required|exists:prodis,id', // 💡 Tambahkan juga di bagian update
            'kode_mk'  => 'required|max:10|unique:mata_kuliahs,kode_mk,' . $id,
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        $mk->update($request->all());

        return redirect()->back()->with('success', 'Data Mata Kuliah berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $mk = Matakuliah::findOrFail($id);
        $mk->delete();

        return redirect()->back()->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
