<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilais';
    protected $fillable = ['mahasiswa_id', 'mata_kuliah_id', 'nilai_angka', 'nilai_huruf', 'bobot', 'status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'mata_kuliah_id');
    }
}
