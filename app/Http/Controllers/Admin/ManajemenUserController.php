<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    public function index()
    {
        // Mengambil semua user dari database local
        $users = User::latest()->get();

        // Hitung akumulasi statistik untuk kartu atas secara dinamis
        $totalUser  = $users->count();
        $admin      = $users->where('role', 'admin')->count();
        $dosen      = $users->where('role', 'dosen')->count();
        $mahasiswa  = $users->where('role', 'mahasiswa')->count();

        return view('admin.manajemen_user', compact('users', 'totalUser', 'admin', 'dosen', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,dosen,mahasiswa',
        ], [
            'email.unique' => 'Gagal! Alamat email tersebut sudah digunakan oleh akun lain.',
            'password.min' => 'Gagal! Kata sandi minimal wajib berisikan 6 karakter.'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => 'Aktif' // Nilai default aman
        ]);

        return redirect()->back()->with('success', 'Akun pengguna baru berhasil didaftarkan ke dalam sistem!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,dosen,mahasiswa',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Jika kolom status ada di database, ikut diperbarui
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }

        // Kondisional: Update password hanya jika admin mengisi kolom password baru
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Data kredensial pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Proteksi mutlak: Mencegah admin menghapus akunnya sendiri secara tidak sengaja saat login
        if ($user->id === auth()->id()) {
            return redirect()->back()->withErrors(['error' => 'Tindakan Ditolak! Anda tidak diizinkan menghapus akun Anda sendiri yang sedang aktif digunakan.']);
        }

        $user->delete();
        return redirect()->back()->with('success', 'Akun pengguna berhasil dibersihkan dari sistem!');
    }
}
