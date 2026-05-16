<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi super ketat agar database tidak "kotor"
        $request->validate([
            'nama_ruangan' => 'required|unique:ruangans,nama_ruangan|max:50',
            'kapasitas'    => 'required|integer|min:1',
            'lokasi'       => 'nullable|string'
        ]);

        // 2. Simpan ke Database
        Ruangan::create($request->all());

        return back()->with('success', 'Ruangan baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
