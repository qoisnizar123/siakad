<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    // === Fitur Manajemen Data Dosen ===
    
    // Tampilkan Daftar Dosen
    public function index()
    {
        $dosens = Dosen::with('prodi')->latest()->get();
        $prodis = DB::table('prodis')->get();
        
        $totalDosen = $dosens->count();
        $dosenAktif = $dosens->where('status', 'Aktif')->count();
        $dosenCuti  = $dosens->where('status', 'Cuti')->count();

        return view('admin.data_dosen', compact('dosens', 'prodis', 'totalDosen', 'dosenAktif', 'dosenCuti'));
    }

    // Tambah Dosen Baru
    public function store(Request $request)
    {
        $request->validate([
            'nidn'       => 'required|unique:dosens,nidn|max:20',
            'nama_dosen' => 'required|string|max:150',
            'email'      => 'required|email|unique:dosens,email|unique:users,email',
            'prodi_id'   => 'required|exists:prodis,id',
            'status'     => 'required|string',
        ]);

        // Buat akun login user
        $user = User::create([
            'name'     => $request->nama_dosen,
            'email'    => $request->email,
            'password' => Hash::make('password123'),
            'role'     => 'dosen',
        ]);

        $data = $request->all();
        $data['user_id']    = $user->id;
        $data['nama']       = $request->nama_dosen;
        $data['nama_dosen'] = $request->nama_dosen;
        $data['jabatan']    = 'Dosen'; // Otomatis diset 1 nilai saja

        Dosen::create($data);

        return redirect()->back()->with('success', 'Akun login baru otomatis aktif dengan password default: password123');
    }

    // Update Data Dosen
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nidn'       => 'required|max:20|unique:dosens,nidn,' . $id,
            'nama_dosen' => 'required|string|max:150',
            'email'      => 'required|email|unique:dosens,email,' . $id . '|unique:users,email,' . $dosen->user_id,
            'prodi_id'   => 'required|exists:prodis,id',
            'status'     => 'required|string',
        ]);

        // Update juga email di tabel users jika akun terhubung
        if ($dosen->user_id) {
            $user = User::find($dosen->user_id);
            if ($user) {
                $user->update([
                    'name'  => $request->nama_dosen,
                    'email' => $request->email,
                ]);
            }
        }

        $data = $request->all();
        $data['nama']       = $request->nama_dosen;
        $data['nama_dosen'] = $request->nama_dosen;
        $data['jabatan']    = 'Dosen'; // Mengunci jabatan tetap dosen

        $dosen->update($data);

        return redirect()->back()->with('success', 'Data Dosen dan Akun Pengguna berhasil diperbarui!');
    }

    // Hapus Data Dosen
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        
        // Hapus akun loginnya juga jika ada
        if ($dosen->user_id) {
            User::where('id', $dosen->user_id)->delete();
        }
        
        $dosen->delete();
        
        return redirect()->back()->with('success', 'Data Dosen berhasil dihapus dari sistem!');
    }
}