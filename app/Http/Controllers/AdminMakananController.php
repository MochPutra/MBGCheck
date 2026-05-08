<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;

class AdminMakananController extends Controller
{
    public function index()
    {
        // Mengecek apakah user benar-benar admin (keamanan tambahan)
        if (!session('is_admin')) {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin!');
        }

        // Ambil semua data makanan beserta nilai gizinya
        $makanans = Makanan::with('nilaiGizi')->orderBy('id_makanan', 'desc')->get();
        
        return view('admin.makanan.index', compact('makanans'));
    }
    // Menampilkan halaman form tambah makanan
    public function create()
    {
        if (!session('is_admin')) return redirect('/login');
        return view('admin.makanan.create');
    }

    // Memproses data dari form ke database
    public function store(Request $request)
    {
        // 1. Simpan ke tabel makanan terlebih dahulu
        $makanan = Makanan::create([
            'nama_makanan' => $request->input('nama_makanan'),
            'kategori' => $request->input('kategori'),
        ]);

        // 2. Simpan nilai gizinya menggunakan ID makanan yang baru saja dibuat
        \App\Models\NilaiGizi::create([
            'id_makanan' => $makanan->id_makanan,
            'kalori' => $request->input('kalori'),
            'protein' => $request->input('protein'),
            'karbohidrat' => $request->input('karbohidrat'),
            'vitamin' => $request->input('vitamin') ?? '-', // Jika kosong, isi dengan strip (-)
        ]);

        // 3. Kembalikan ke halaman tabel
        return redirect('/admin/makanan')->with('success', 'Data makanan berhasil ditambahkan!');
    }
}