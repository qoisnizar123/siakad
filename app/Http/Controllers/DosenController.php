<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\JadwalKuliah;
use App\Models\Krs;
use App\Models\Khs;
use App\Models\Absensi;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DosenController extends Controller
{
    // === Fitur Dashboard Dosen ===
    public function dashboard()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        
        $totalMk = 0;
        $totalMahasiswa = 0;
        $totalPertemuan = 0;
        $rataRataNilai = 0;
        $jadwals = collect();
        $aktivitasTerbaru = collect();

        if ($dosen) {
            $jadwalIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('id');
            $mkIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('mata_kuliah_id')->unique();

            $totalMk = $mkIds->count();
            
            // 💡 FIX: Hitung mahasiswa unik dari jadwal_id & status approved
            $totalMahasiswa = Krs::whereIn('jadwal_id', $jadwalIds)
                ->where('status', 'approved')
                ->distinct('mahasiswa_id')
                ->count('mahasiswa_id');

            $totalPertemuan = Pertemuan::whereIn('jadwal_id', $jadwalIds)->count();

            $jadwals = JadwalKuliah::with(['matakuliah'])
                ->where('dosen_id', $dosen->id)
                ->orderBy('hari', 'asc')
                ->limit(5)
                ->get();
                
            $aktivitasTerbaru = Pertemuan::with('jadwal.matakuliah')
                ->whereIn('jadwal_id', $jadwalIds)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        }

        return view('dosen.dashboard', compact(
            'dosen', 'totalMk', 'totalMahasiswa', 'totalPertemuan', 'rataRataNilai', 'jadwals', 'aktivitasTerbaru'
        ));
    }

    // === Fitur Jadwal Mengajar ===
    public function jadwalMengajar(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = collect();
        $jadwalHariIni = collect();
        
        $totalJadwal = 0;
        $jadwalHariIniCount = 0;

        $hariRealTime = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd'); 
        $filterHari = $request->input('hari', 'Semua Hari'); 

        if ($filterHari != 'Semua Hari') {
            $judulJadwalBawah = "Jadwal Hari Ini (" . $filterHari . ")";
            $hariPencarianCard = $filterHari;
        } else {
            $judulJadwalBawah = "Jadwal Hari Ini";
            $hariPencarianCard = $hariRealTime; 
        }

        if ($dosen) {
            $query = JadwalKuliah::with(['matakuliah'])->where('dosen_id', $dosen->id);
            if ($filterHari != 'Semua Hari') {
                $query->where('hari', $filterHari);
            }
            $jadwals = $query->orderBy('hari', 'asc')->orderBy('jam_mulai', 'asc')->get();

            $totalJadwal = JadwalKuliah::where('dosen_id', $dosen->id)->count();
            
            $jadwalHariIni = JadwalKuliah::with(['matakuliah'])
                ->where('dosen_id', $dosen->id)
                ->where('hari', $hariPencarianCard)
                ->orderBy('jam_mulai', 'asc')
                ->get();
            $jadwalHariIniCount = $jadwalHariIni->count();
        }

        $mataKuliahOptions = JadwalKuliah::with('matakuliah')->where('dosen_id', $dosen->id ?? 0)->get()->unique('mata_kuliah_id');

        return view('dosen.jadwal_mengajar', compact(
            'dosen', 'jadwals', 'totalJadwal', 'jadwalHariIniCount', 
            'jadwalHariIni', 'judulJadwalBawah', 'mataKuliahOptions'
        ));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required',
            'kelas' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required|string',
            'metode' => 'required|string',
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->first();

        JadwalKuliah::create([
            'dosen_id' => $dosen->id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
            'metode' => $request->metode,
        ]);

        return redirect()->back()->with('success', 'Jadwal mengajar baru berhasil ditambahkan.');
    }

    // === Fitur Penilaian Mahasiswa ===
    public function nilai()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $khsRecords = collect();
        $jadwals = collect();

        if ($dosen) {
            $jadwals = JadwalKuliah::with('matakuliah')
                ->where('dosen_id', $dosen->id)
                ->get();

            $mataKuliahIds = $jadwals->pluck('mata_kuliah_id');

            $khsRecords = Khs::with(['mahasiswa', 'matakuliah'])
                ->whereIn('mata_kuliah_id', $mataKuliahIds)
                ->get();
        }

        return view('dosen.nilai', compact('dosen', 'khsRecords', 'jadwals'));
    }

    public function indexNilai()
    {
        return $this->nilai();
    }
        
    public function inputNilai(int $jadwal_id)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwal = JadwalKuliah::with('matakuliah')->findOrFail($jadwal_id);
        
        // 💡 FIX: Gunakan jadwal_id dan approved
        $mahasiswas = Krs::with('mahasiswa')
            ->where('jadwal_id', $jadwal_id)
            ->where('status', 'approved')
            ->get();
        
        return view('dosen.input_nilai', compact('dosen', 'jadwal', 'mahasiswas'));
    }
            
    public function storeNilai(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $mahasiswa_id => $skor) {
            if ($skor >= 85) $huruf = 'A';
            elseif ($skor >= 75) $huruf = 'B';
            elseif ($skor >= 65) $huruf = 'C';
            elseif ($skor >= 50) $huruf = 'D';
            else $huruf = 'E';

            Khs::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa_id,
                    'mata_kuliah_id' => $request->mata_kuliah_id,
                ],
                [
                    'nilai_angka' => $skor,
                    'nilai_huruf' => $huruf,
                    'semester' => $request->semester,
                ]
            );
        }

        return redirect()->route('dosen.nilai')->with('success', 'Nilai mahasiswa berhasil disimpan!');
    }
    
    public function destroyNilai(int $id)
    {
        $khs = Khs::findOrFail($id);
        $khs->delete();

        return redirect()->route('dosen.nilai')->with('success', 'Data nilai mahasiswa berhasil dihapus dari sistem!');
    }

    // === Fitur Mata Kuliah Dosen ===
    public function matakuliah()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = collect();
        
        if ($dosen) {
            $jadwals = JadwalKuliah::with(['matakuliah'])
                ->where('dosen_id', $dosen->id)
                ->get();
        }
            
        return view('dosen.matakuliah', compact('dosen', 'jadwals'));
    }

    public function storeMatakuliah(Request $request)
    {
        // 1. Validasi kita tambah untuk menerima input jadwal
        $request->validate([
            'kode_mk' => 'required|string|max:50',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer',
            'semester' => 'required|string|max:50',
            'ruangan_id' => 'required|integer',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->first();

        // 2. Simpan Data Mata Kuliah
        $mk = Matakuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'prodi_id' => $dosen->prodi_id, 
        ]);

       // 3. Simpan Jadwal
        JadwalKuliah::create([
            'dosen_id' => $dosen->id,
            'mata_kuliah_id' => $mk->id,
            'semester' => $request->semester,
            'ruangan_id' => $request->ruangan_id,             
            'hari' => $request->hari,             
            'jam_mulai' => $request->jam_mulai,     
            'jam_selesai' => $request->jam_selesai, 
        ]);

        return redirect()->back()->with('success', 'Mata kuliah dan jadwal mengajar berhasil ditambahkan.');
    }
            
    // === Fitur Persetujuan KRS Mahasiswa ===
    public function dataMahasiswa()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $krsRecords = collect();

        if ($dosen) {
            // 💡 FIX: Gunakan jadwal_id 
            $jadwalIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('id');

            $krsRecords = Krs::with(['mahasiswa', 'jadwal.matakuliah'])
                ->whereIn('jadwal_id', $jadwalIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('dosen.data_mahasiswa', compact('dosen', 'krsRecords'));
    }

    public function approveKrs(int $id)
    {
        $krs = Krs::findOrFail($id);
        $krs->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Mahasiswa berhasil disetujui masuk ke kelas.');
    }

    public function rejectKrs(int $id)
    {
        $krs = Krs::findOrFail($id);
        $krs->update(['status' => 'pending']);

        return redirect()->back()->with('success', 'Pengajuan kelas mahasiswa ditolak.');
    }

    // === Fitur Absensi Perkuliahan ===
    public function absensi(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = collect();

        if ($dosen) {
            $jadwals = JadwalKuliah::with('matakuliah')
                ->where('dosen_id', $dosen->id)
                ->get();
        }

        return view('dosen.absensi_mahasiswa', compact('dosen', 'jadwals'));
    }

    public function absensiKelas(int $jadwal_id, Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = JadwalKuliah::with('matakuliah')->where('dosen_id', $dosen->id)->get();
        $jadwal_terpilih = JadwalKuliah::with('matakuliah')->findOrFail($jadwal_id);

        $pertemuans = Pertemuan::where('jadwal_id', $jadwal_id)->orderBy('pertemuan_ke', 'asc')->get();
        $pertemuan_aktif = null;
        $mahasiswas = collect();

        if ($request->has('pertemuan_id') && $request->pertemuan_id != '') {
            $pertemuan_aktif = Pertemuan::findOrFail($request->pertemuan_id);
            
            // 💡 FIX: Gunakan jadwal_id dan approved
            $mahasiswas = Krs::with(['mahasiswa', 'mahasiswa.absensi' => function($q) use ($pertemuan_aktif) {
                $q->where('pertemuan_id', $pertemuan_aktif->id);
            }])
            ->where('jadwal_id', $jadwal_id)
            ->where('status', 'approved')
            ->get();
        }

        return view('dosen.absensi_mahasiswa', compact('dosen', 'jadwals', 'jadwal_terpilih', 'pertemuans', 'pertemuan_aktif', 'mahasiswas'));
    }

    public function storePertemuan(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'pertemuan_ke' => 'required|integer',
            'tanggal_pertemuan' => 'required|date',
            'catatan_materi' => 'nullable|string'
        ]);

    Pertemuan::create($request->except('_token'));
        return redirect()->back()->with('success', 'Sesi pertemuan baru berhasil dibuat.');
    }

    public function storeAbsensi(Request $request)
    {
        $request->validate([
            'pertemuan_id' => 'required',
            'kehadiran' => 'required|array'
        ]);

        foreach ($request->kehadiran as $mahasiswa_id => $data) {
            Absensi::updateOrCreate(
                [
                    'pertemuan_id' => $request->pertemuan_id,
                    'mahasiswa_id' => $mahasiswa_id
                ],
                [
                    'status_kehadiran' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null
                ]
            );
        }

        return redirect()->back()->with('success', 'Data absensi mahasiswa berhasil disimpan.');
    }
}