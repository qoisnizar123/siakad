<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    // === Fitur Manajemen Data Mahasiswa ===
    
    // Tampilkan Daftar Mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::with('prodi')->latest()->get();
        $prodis = DB::table('prodis')->get();

        $totalMahasiswa = $mahasiswas->count();
        $mahasiswaAktif = $mahasiswas->where('status', 'Aktif')->count();
        $mahasiswaCuti  = $mahasiswas->where('status', 'Cuti')->count();
        $alumni         = $mahasiswas->where('status', 'Alumni')->count();

        return view('admin.data_mahasiswa', compact('mahasiswas', 'prodis', 'totalMahasiswa', 'mahasiswaAktif', 'mahasiswaCuti', 'alumni'));
    }

    // Tambah Mahasiswa Baru
    public function store(Request $request)
    {
        // Validasi Ketat dengan Pesan Kustom
        $request->validate([
            'nim'            => 'required|unique:mahasiswas,nim|max:25',
            'nama_mahasiswa' => 'required|string|max:150',
            'email'          => 'required|email|unique:mahasiswas,email|unique:users,email',
            'prodi_id'       => 'required|exists:prodis,id',
            'semester'       => 'required|integer|min:1|max:14',
            'angkatan'       => 'required|string|max:4',
            'status'         => 'required|string',
        ], [
            'nim.unique'   => 'Gagal! NIM yang Anda masukkan sudah terdaftar untuk mahasiswa lain.',
            'email.unique' => 'Gagal! Email ini sudah digunakan oleh akun lain di sistem.',
            'email.email'  => 'Format penulisan email tidak valid.',
        ]);

        // Gunakan Transaksi Database
        DB::beginTransaction();

        try {
            $user = User::create([
                'name'     => $request->nama_mahasiswa,
                'email'    => $request->email,
                'password' => Hash::make('12345678'), // Password default
                'role'     => 'mahasiswa',
            ]);

            $data = $request->all();
            $data['user_id'] = $user->id;

            Mahasiswa::create($data);

            DB::commit();

            return redirect()->back()->with('success', 'Akun login mahasiswa otomatis aktif dengan password default: 12345678');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    // Update Data Mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim'            => 'required|max:25|unique:mahasiswas,nim,' . $id,
            'nama_mahasiswa' => 'required|string|max:150',
            'email'          => 'required|email|unique:mahasiswas,email,' . $id . '|unique:users,email,' . $mahasiswa->user_id,
            'prodi_id'       => 'required|exists:prodis,id',
            'semester'       => 'required|integer|min:1|max:14',
            'angkatan'       => 'required|string|max:4',
            'status'         => 'required|string',
        ]);

        if ($mahasiswa->user_id) {
            $user = User::find($mahasiswa->user_id);
            if ($user) {
                $user->update([
                    'name'  => $request->nama_mahasiswa,
                    'email' => $request->email,
                ]);
            }
        }

        $mahasiswa->update($request->all());

        return redirect()->back()->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    // Hapus Data Mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        if ($mahasiswa->user_id) {
            User::where('id', $mahasiswa->user_id)->delete();
        }
        
        $mahasiswa->delete();
        
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil dihapus dari sistem!');
    }
}