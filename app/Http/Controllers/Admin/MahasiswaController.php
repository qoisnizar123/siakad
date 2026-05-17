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
    public function index()
    {
        $mahasiswas = Mahasiswa::with('prodi')->latest()->get();
        $prodis = DB::table('prodis')->get();

        // Hitung statistik sesuai komponen kartu atas
        $totalMahasiswa = $mahasiswas->count();
        $mahasiswaAktif = $mahasiswas->where('status', 'Aktif')->count();
        $mahasiswaCuti  = $mahasiswas->where('status', 'Cuti')->count();
        $alumni         = $mahasiswas->where('status', 'Alumni')->count();

        return view('admin.data_mahasiswa', compact('mahasiswas', 'prodis', 'totalMahasiswa', 'mahasiswaAktif', 'mahasiswaCuti', 'alumni'));
    }

    public function store(Request $request)
    {
        // 1. GERBANG UTAMA: Validasi Ketat dengan Pesan Kustom
        $request->validate([
            'nim'            => 'required|unique:mahasiswas,nim|max:25',
            'nama_mahasiswa' => 'required|string|max:150',
            'email'          => 'required|email|unique:mahasiswas,email|unique:users,email', // Dicek ke kedua tabel
            'prodi_id'       => 'required|exists:prodis,id',
            'semester'       => 'required|integer|min:1|max:14',
            'angkatan'       => 'required|string|max:4',
            'status'         => 'required|string',
        ], [
            // 💡 CUSTOM MESSAGES: Memberikan alasan yang jelas saat validasi gagal
            'nim.unique'   => 'Gagal! NIM yang Anda masukkan sudah terdaftar untuk mahasiswa lain.',
            'email.unique' => 'Gagal! Email ini sudah digunakan oleh akun lain di sistem. Silakan gunakan email student yang berbeda.',
            'email.email'  => 'Format penulisan email tidak valid.',
        ]);

        // 2. TAMENG KEDUA: Transaksi Database (Hanya dieksekusi jika lolos gerbang utama)
        DB::beginTransaction();

        try {
            // Buat akun login
            $user = User::create([
                'name'     => $request->nama_mahasiswa,
                'email'    => $request->email,
                'password' => Hash::make('12345678'), // Password default, bisa diubah nanti oleh mahasiswa
                'role'     => 'mahasiswa',
            ]);

            // Ikat user_id ke data mahasiswa
            $data = $request->all();
            $data['user_id'] = $user->id;

            Mahasiswa::create($data);

            // Jika semua sukses, kunci data ke database
            DB::commit();

            return redirect()->back()->with('success', 'Akun login mahasiswa otomatis aktif dengan password default: 12345678');
        } catch (\Exception $e) {
            // Jika ada kendala sistem tak terduga, batalkan semua (Rollback)
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

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

        // Sinkronisasi data ke tabel users jika diubah oleh admin
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
