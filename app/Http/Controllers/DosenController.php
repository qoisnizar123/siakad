<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        return view('dosen.dashboard');
    }
    public function matakuliah()
    {
        return view('dosen.matakuliah');
    }
    public function dataMahasiswa()
    {
        return view('dosen.data_mahasiswa');
    }
    public function absensi()
    {
        return view('dosen.absensi_mahasiswa');
    }
    public function nilai()
    {
        return view('dosen.nilai');
    }
    public function jadwalMengajar()
    {
        return view('dosen.jadwal_mengajar');
    }
}
