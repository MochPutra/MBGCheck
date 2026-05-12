<?php

namespace App\Http\Controllers;

use App\Models\JadwalMenu;
use Illuminate\Http\Request;

class JadwalMenuController extends Controller
{
    public function show()
    {
        // Ambil minggu dan tahun saat ini
        $minggu = now()->isoWeek;
        $tahun = now()->year;

        // Ambil jadwal menu untuk minggu ini
        $jadwalMenus = JadwalMenu::where('minggu', $minggu)
            ->where('tahun', $tahun)
            ->with('makanan.nilaiGizi')
            ->get()
            ->groupBy('hari');

        // Daftar hari dalam seminggu
        $haris = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('jadwal-menu', compact('jadwalMenus', 'haris', 'minggu', 'tahun'));
    }
}
