<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
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
        // Validasi data yang masuk
        $request->validate([
            'kode_mk'  => 'required|unique:matakuliahs,kode_mk|max:10',
            'nama_mk'  => 'required|string|max:100',
            'sks'      => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        // Simpan ke database
        Matakuliah::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Mata Kuliah ' . $request->nama_mk . ' berhasil ditambahkan!'
        ], 201);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
