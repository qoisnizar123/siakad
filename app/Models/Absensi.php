<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // 💡 KUNCI AMAN: Mengizinkan semua kolom diisi secara massal (Bypass Mass Assignment)
    protected $guarded = [];

    // Relasi balik ke tabel Pertemuan
    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id');
    }

    // Relasi balik ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
