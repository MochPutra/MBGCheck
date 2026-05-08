<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memvalidasi login (Sesuai Sequence Diagram Anda)
    public function validasiLogin(Request $request)
    {
        // 1. Ambil inputan user
        $username = $request->input('username');
        $password = $request->input('password');

        // 2. Cari admin berdasarkan username
        $admin = Admin::where('username', $username)->first();

        // 3. Cek apakah admin ada DAN passwordnya cocok
        // Kita bandingkan password inputan dengan hash di database
        // Karena hash dummy kita buat statis, khusus tahap ini kita pakai perbandingan langsung jika Hash gagal (fallback untuk belajar)
        if ($admin && Hash::check($password, $admin->password)) {
            // Login Berhasil -> Simpan sesi
            session([
                'is_admin' => true,
                'admin_id' => $admin->id_admin,
                'admin_nama' => $admin->nama
            ]);
            
            return redirect('/')->with('success', 'Selamat datang, ' . $admin->nama);
        }

        // Login Gagal -> Kembalikan ke halaman login bawa pesan error
        return back()->with('error', 'Username atau Password salah!');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush(); // Hapus semua sesi
        return redirect('/login');
    }
}