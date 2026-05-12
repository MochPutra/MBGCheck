<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap input dari kolom pencarian
        $keyword = $request->input('search');

        // Jika ada pencarian, gunakan ILIKE (khusus PostgreSQL agar case-insensitive)
        if ($keyword) {
            $makanans = Makanan::with('nilaiGizi')
                ->where('nama_makanan', 'ILIKE', "%" . $keyword . "%")
                ->get();
        } else {
            // Jika tidak ada pencarian, tampilkan semua makanan
            $makanans = Makanan::with('nilaiGizi')->get();
        }

        return view('makanan.index', compact('makanans', 'keyword'));
    }
    public function show($id)
    {
        // Ambil data makanan beserta relasi gizi dan resepnya
        $makanan = \App\Models\Makanan::with(['nilaiGizi', 'resep'])->findOrFail($id);
        
        return view('makanan.show', compact('makanan'));
    }
}