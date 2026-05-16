<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens';

    protected $fillable = [
        'user_id',
        'nidn',
        'nama_dosen',
        'email',
        'prodi_id',
        'jabatan',
        'status'
    ];

    // Relasi ke tabel prodis
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
