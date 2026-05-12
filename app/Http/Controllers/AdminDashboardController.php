<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\NilaiGizi;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // === STATISTIK RINGKASAN ===
        $totalMakanan = Makanan::count();
        $totalKategori = Makanan::distinct('kategori')->count('kategori');
        $avgKalori = round(NilaiGizi::avg('kalori'), 1);
        $avgProtein = round(NilaiGizi::avg('protein'), 1);

        // === CHART 1: Distribusi Kategori (Donut) ===
        $kategoriData = Makanan::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->get();

        // === CHART 2: Rata-rata Gizi per Kategori (Bar) ===
        $giziPerKategori = Makanan::select(
                'makanan.kategori',
                DB::raw('ROUND(AVG(nilai_gizi.kalori)::numeric, 1) as avg_kalori'),
                DB::raw('ROUND(AVG(nilai_gizi.protein)::numeric, 1) as avg_protein'),
                DB::raw('ROUND(AVG(nilai_gizi.karbohidrat)::numeric, 1) as avg_karbohidrat')
            )
            ->join('nilai_gizi', 'makanan.id_makanan', '=', 'nilai_gizi.id_makanan')
            ->groupBy('makanan.kategori')
            ->orderBy('makanan.kategori')
            ->get();

        // === CHART 3: Top 10 Makanan Tertinggi Kalori (Horizontal Bar) ===
        $topKalori = Makanan::select('makanan.nama_makanan', 'nilai_gizi.kalori')
            ->join('nilai_gizi', 'makanan.id_makanan', '=', 'nilai_gizi.id_makanan')
            ->orderByDesc('nilai_gizi.kalori')
            ->limit(10)
            ->get();

        // === CHART 4: Top 10 Makanan Tertinggi Protein (Horizontal Bar) ===
        $topProtein = Makanan::select('makanan.nama_makanan', 'nilai_gizi.protein')
            ->join('nilai_gizi', 'makanan.id_makanan', '=', 'nilai_gizi.id_makanan')
            ->orderByDesc('nilai_gizi.protein')
            ->limit(10)
            ->get();

        // === CHART 5: Distribusi Kalori (Histogram - range buckets) ===
        $kaloriRanges = NilaiGizi::select(
                DB::raw("CASE
                    WHEN kalori <= 50 THEN '0-50'
                    WHEN kalori <= 100 THEN '51-100'
                    WHEN kalori <= 200 THEN '101-200'
                    WHEN kalori <= 300 THEN '201-300'
                    WHEN kalori <= 500 THEN '301-500'
                    ELSE '500+'
                END as range_label"),
                DB::raw("CASE
                    WHEN kalori <= 50 THEN 1
                    WHEN kalori <= 100 THEN 2
                    WHEN kalori <= 200 THEN 3
                    WHEN kalori <= 300 THEN 4
                    WHEN kalori <= 500 THEN 5
                    ELSE 6
                END as range_order"),
                DB::raw('count(*) as total')
            )
            ->groupBy('range_label', 'range_order')
            ->orderBy('range_order')
            ->get();

        // === CHART 6: Rasio Makronutrien Keseluruhan (Radial) ===
        $totalProtein = NilaiGizi::sum('protein');
        $totalKarbo = NilaiGizi::sum('karbohidrat');
        $totalKaloriSum = NilaiGizi::sum('kalori');
        $totalMakro = $totalProtein + $totalKarbo;
        $rasioProtein = $totalMakro > 0 ? round(($totalProtein / $totalMakro) * 100, 1) : 0;
        $rasioKarbo = $totalMakro > 0 ? round(($totalKarbo / $totalMakro) * 100, 1) : 0;

        return view('admin.dashboard', compact(
            'totalMakanan', 'totalKategori', 'avgKalori', 'avgProtein',
            'kategoriData', 'giziPerKategori', 'topKalori', 'topProtein',
            'kaloriRanges', 'rasioProtein', 'rasioKarbo'
        ));
    }
}
