<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap input dari kolom pencarian dan filter kategori
        $keyword = $request->input('search');
        $kategori = $request->input('kategori');

        // Ambil semua kategori unik untuk dropdown filter
        $kategoris = Makanan::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        // Build query
        $query = Makanan::with('nilaiGizi');

        // Filter berdasarkan pencarian
        if ($keyword) {
            $query->where('nama_makanan', 'ILIKE', "%" . $keyword . "%");
        }

        // Filter berdasarkan kategori
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $makanans = $query->paginate(50);

        // Agar parameter search & kategori tetap terbawa saat pindah halaman
        $makanans->appends(['search' => $keyword, 'kategori' => $kategori]);

        return view('makanan.index', compact('makanans', 'keyword', 'kategoris', 'kategori'));
    }
    public function show($id)
    {
        // Ambil data makanan beserta relasi gizi dan resepnya
        $makanan = \App\Models\Makanan::with(['nilaiGizi', 'resep'])->findOrFail($id);
        
        return view('makanan.show', compact('makanan'));
    }
}