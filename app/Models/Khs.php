<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'khs';

    // Membuka proteksi kolom agar bisa di-input massal oleh Dosen Controller
    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'nilai_angka',
        'nilai_huruf',
        'semester'
    ];

    // Hubungan relasi balik ke Mata Kuliah (Opsional tapi bagus untuk nanti di sisi mahasiswa)
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'mata_kuliah_id');
    }
}