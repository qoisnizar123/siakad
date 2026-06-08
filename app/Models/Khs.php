<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    // 💡 Buka gembok keamanan untuk simpan nilai
    protected $guarded = [];

    // 💡 Relasi ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    // 💡 Relasi ke tabel Mata Kuliah (Sekalian ditambahkan untuk jaga-jaga)
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'mata_kuliah_id');
    }
}