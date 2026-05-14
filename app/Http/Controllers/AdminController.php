<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dataMahasiswa()
    {
        return view('admin.data_mahasiswa');
    }
    public function dataDosen()
    {
        return view('admin.data_dosen');
    }
    public function mataKuliah()
    {
        return view('admin.matakuliah');
    }
    public function jadwalKuliah()
    {
        return view('admin.jadwal_kuliah');
    }
    public function krsMahasiswa()
    {
        return view('admin.krs_mahasiswa');
    }
    public function nilaiKHS()
    {
        return view('admin.nilai_khs');
    }
    public function bookingRuangan()
    {
        return view('admin.booking_ruangan');
    }
    public function manajemenUser()
    {
        return view('admin.manajemen_user');
    }
    public function pengaturanSistem()
    {
        return view('admin.pengaturan_sistem');
    }
}