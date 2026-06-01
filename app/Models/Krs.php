<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    // 💡 Mengunci nama tabel asli kelompokmu
    protected $table = 'krs';

    protected $guarded = [];

    // Relasi ke data profil induk Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    // Relasi ke data Jadwal Kuliah
    public function jadwal()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadwal_id');
    }

    public function matakuliah()
    {
        // Menghubungkan Krs dengan tabel Matakuliah lewat kolom 'mata_kuliah_id'
        return $this->belongsTo(Matakuliah::class, 'mata_kuliah_id');
    }
}
