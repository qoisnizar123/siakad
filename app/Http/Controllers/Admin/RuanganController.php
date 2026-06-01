<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    // === Fitur Manajemen Data Ruangan Kelas ===
    
    // (Jika Anda punya halaman view untuk index, letakkan di sini)
    public function index()
    {
        // 
    }

    // Tambah Ruangan Baru
    public function store(Request $request)
    {
        // Validasi ketat agar database tidak "kotor"
        $request->validate([
            'nama_ruangan' => 'required|unique:ruangans,nama_ruangan|max:50',
            'kapasitas'    => 'required|integer|min:1',
            'lokasi'       => 'nullable|string'
        ]);

        Ruangan::create($request->all());

        return back()->with('success', 'Ruangan baru berhasil ditambahkan!');
    }

    // Update Data Ruangan
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'nama_ruangan' => 'required|max:50|unique:ruangans,nama_ruangan,' . $id,
            'kapasitas'    => 'required|integer',
        ]);

        $ruangan->update($request->all());

        return back()->with('success', 'Data ruangan berhasil diperbarui!');
    }

    // Hapus Ruangan
    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
        
        return back()->with('success', 'Ruangan berhasil dihapus.');
    }
}