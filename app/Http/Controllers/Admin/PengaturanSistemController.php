<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PengaturanSistemController extends Controller
{
    public function index()
    {
        return view('admin.pengaturan_sistem');
    }

    public function update(Request $request)
    {
        // Ambil semua input form kecuali token keamanan laravel
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

    // 💡 FITUR AKSI CEPAT: Jalankan perintah artisan langsung dari browser
    public function clearCache()
    {
        Artisan::call('optimize:clear');
        return back()->with('success', 'Sistem berhasil disegarkan! Seluruh cache rute dan view telah dibersihkan.');
    }
}
