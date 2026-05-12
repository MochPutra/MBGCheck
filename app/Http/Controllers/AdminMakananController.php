<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\MakananExport;

class AdminMakananController extends Controller
{
    public function index(Request $request)
    {
        // Mengecek apakah user benar-benan admin (keamanan tambahan)
        if (!session('is_admin')) {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin!');
        }

        // Query dasar
        $query = Makanan::with('nilaiGizi', 'resep');

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan kalori
        if ($request->filled('kalori_min')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('kalori', '>=', $request->kalori_min);
            });
        }
        if ($request->filled('kalori_max')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('kalori', '<=', $request->kalori_max);
            });
        }

        // Filter berdasarkan protein
        if ($request->filled('protein_min')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('protein', '>=', $request->protein_min);
            });
        }
        if ($request->filled('protein_max')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('protein', '<=', $request->protein_max);
            });
        }

        // Ambil data dengan filter
        $makanans = $query->orderBy('id_makanan', 'desc')->get();

        // Ambil daftar kategori untuk filter
        $kategoris = Makanan::distinct('kategori')->pluck('kategori');
        
        return view('admin.makanan.index', compact('makanans', 'kategoris'));
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

    public function export(Request $request)
    {
        if (!session('is_admin')) {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin!');
        }

        // Query dasar dengan filter yang sama seperti index
        $query = Makanan::with('nilaiGizi', 'resep');

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan kalori
        if ($request->filled('kalori_min')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('kalori', '>=', $request->kalori_min);
            });
        }
        if ($request->filled('kalori_max')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('kalori', '<=', $request->kalori_max);
            });
        }

        // Filter berdasarkan protein
        if ($request->filled('protein_min')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('protein', '>=', $request->protein_min);
            });
        }
        if ($request->filled('protein_max')) {
            $query->whereHas('nilaiGizi', function($q) use ($request) {
                $q->where('protein', '<=', $request->protein_max);
            });
        }

        // Gunakan query untuk export
        $makanans = $query->orderBy('id_makanan', 'desc')->get();

        // Buat export dengan data yang difilter
        return Excel::download(new class($makanans) implements FromCollection, WithHeadings {
            private $makanans;

            public function __construct($makanans)
            {
                $this->makanans = $makanans;
            }

            public function collection()
            {
                return $this->makanans->map(function ($makanan) {
                    return [
                        'ID' => $makanan->id_makanan,
                        'Nama Makanan' => $makanan->nama_makanan,
                        'Kategori' => $makanan->kategori,
                        'Kalori' => $makanan->nilaiGizi ? $makanan->nilaiGizi->kalori : '-',
                        'Protein' => $makanan->nilaiGizi ? $makanan->nilaiGizi->protein : '-',
                        'Karbohidrat' => $makanan->nilaiGizi ? $makanan->nilaiGizi->karbohidrat : '-',
                        'Vitamin' => $makanan->nilaiGizi ? $makanan->nilaiGizi->vitamin : '-',
                    ];
                });
            }

            public function headings(): array
            {
                return [
                    'ID',
                    'Nama Makanan',
                    'Kategori',
                    'Kalori',
                    'Protein',
                    'Karbohidrat',
                    'Vitamin',
                ];
            }
        }, 'laporan_makanan_filtered.xlsx');
    }
}