<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PengaturanSistemController extends Controller
{
    // === Fitur Konfigurasi Global Sistem ===
    
    // Tampilkan Halaman Pengaturan
    public function index()
    {
        return view('admin.pengaturan_sistem');
    }

    // Proses Simpan Pengaturan
    public function update(Request $request)
    {
        $inputs = $request->except('_token');

        // Looping dan simpan secara dinamis ke database
        foreach ($inputs as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Konfigurasi global Sistem Akademik berhasil diperbarui!');
    }

    // 💡 FITUR AKSI CEPAT: Clear Cache via Browser
    public function clearCache()
    {
        Artisan::call('optimize:clear');
        
        return back()->with('success', 'Sistem berhasil disegarkan! Seluruh cache rute dan view telah dibersihkan.');
    }
}