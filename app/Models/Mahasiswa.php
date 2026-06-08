<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $fillable = [
        'user_id',
        'nim',
        'nama_mahasiswa',
        'email',
        'prodi_id',
        'semester',
        'status',
        'angkatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
    public function absensi()
    {
        return $this->hasMany(\App\Models\Absensi::class, 'mahasiswa_id');
    }
}
