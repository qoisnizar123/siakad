<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.dashboard');
    }
    public function krs()
    {
        return view('mahasiswa.krs');
    }
    public function khs()
    {
        return view('mahasiswa.khs');
    }
    public function jadwal()
    {
        return view('mahasiswa.jadwal_kuliah');
    }
    public function booking()
    {
        return view('mahasiswa.booking_ruangan');
    }
}
