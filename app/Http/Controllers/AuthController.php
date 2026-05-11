<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'role' => 'required|in:mahasiswa,dosen,admin',
            'identifier' => 'required|string',
            'password' => 'required|string',
        ], [
            'role.required' => 'Pilih peran anda terlebih dahulu',
            'identifier.required' => 'Masukkan NPM / NIDN / Email',
            'password.required' => 'Masukkan password',
        ]);

        // Tentukan field untuk pencarian (email atau identitas unik)
        $fieldType = $this->getFieldType($validated['identifier']);
        
        // Siapkan kredensial
        $credentials = [
            $fieldType => $validated['identifier'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ];

        // Coba autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect sesuai role
            return redirect()->intended($this->getRedirectPath($validated['role']));
        }

        // Jika gagal
        return back()
            ->withInput($request->only('identifier', 'role'))
            ->withErrors([
                'login' => 'Kredensial tidak sesuai atau akun tidak ditemukan.'
            ]);
    }

    /**
     * Tentukan tipe field untuk pencarian (email, npm, atau nidn)
     */
    private function getFieldType($identifier)
    {
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        } elseif (is_numeric($identifier)) {
            // Jika semua angka, bisa NPM atau NIDN
            return 'npm'; // default ke NPM
        }
        return 'npm';
    }

    /**
     * Tentukan halaman redirect sesuai role
     */
    private function getRedirectPath($role)
    {
        return match($role) {
            'mahasiswa' => '/dashboard_mahasiswa',
            'dosen' => '/dashboard_dosen',
            'admin' => '/admin',
            default => '/'
        };
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda telah berhasil logout dari sistem.');
    }
}