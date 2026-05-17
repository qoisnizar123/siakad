<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    // 💡 Mengunci nama tabel asli kelompokmu
    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'jadwal_id',
        'status'
    ];

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
}
