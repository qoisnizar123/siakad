<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;
    protected $guarded = []; 

    // Relasi ke jadwal (biarkan jika sudah ada, tidak usah diubah)
    public function jadwal()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadwal_id');
    }
}
