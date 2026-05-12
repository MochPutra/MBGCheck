<?php

namespace App\Http\Controllers;

use App\Models\JadwalMenu;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminJadwalMenuController extends Controller
{
    public function index()
    {
        if (!session('is_admin')) {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin!');
        }

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

        // Ambil daftar makanan untuk dropdown
        $makanans = Makanan::with('nilaiGizi')->get();

        return view('admin.jadwal.index', compact('jadwalMenus', 'haris', 'makanans', 'minggu', 'tahun'));
    }

    public function store(Request $request)
    {
        if (!session('is_admin')) {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin!');
        }

        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'minggu' => 'required|integer',
            'tahun' => 'required|integer',
            'nama_makanan' => 'required|array',
            'nama_makanan.*' => 'required|string',
            'kalori' => 'nullable|array',
            'kalori.*' => 'nullable|numeric|min:0',
            'protein' => 'nullable|array',
            'protein.*' => 'nullable|numeric|min:0',
            'karbohidrat' => 'nullable|array',
            'karbohidrat.*' => 'nullable|numeric|min:0',
            'vitamin' => 'nullable|array',
            'vitamin.*' => 'nullable|string',
        ]);

        // Process each food item
        $namaItems = $request->nama_makanan ?? [];
        $kaloriItems = $request->kalori ?? [];
        $proteinItems = $request->protein ?? [];
        $karboItems = $request->karbohidrat ?? [];
        $vitaminItems = $request->vitamin ?? [];

        $idPilihs = $request->input('id_makanan_pilih', []);

        foreach ($namaItems as $index => $namaItem) {
            if (empty($namaItem)) continue; // Skip empty items

            // Hanya cocokkan ke tabel makanan jika ada ID numerik (PostgreSQL menolak string di kolom integer)
            $idPilih = isset($idPilihs[$index]) ? trim((string) $idPilihs[$index]) : '';
            $makanan = null;
            if ($idPilih !== '' && ctype_digit($idPilih)) {
                $makanan = Makanan::where('id_makanan', (int) $idPilih)->first();
            } elseif (ctype_digit(trim((string) $namaItem))) {
                $makanan = Makanan::where('id_makanan', (int) trim((string) $namaItem))->first();
            }
            
            $dataToCreate = [
                'hari' => $request->hari,
                'minggu' => $request->minggu,
                'tahun' => $request->tahun,
                'dipesan_oleh' => session('admin_nama'),
            ];

            if ($makanan) {
                $dataToCreate['id_makanan'] = $makanan->id_makanan;
            } else {
                // Jika adalah input custom
                $dataToCreate['nama_makanan_custom'] = $namaItem;
                $dataToCreate['kalori_custom'] = $kaloriItems[$index] ?? null;
                $dataToCreate['protein_custom'] = $proteinItems[$index] ?? null;
                $dataToCreate['karbohidrat_custom'] = $karboItems[$index] ?? null;
                $dataToCreate['vitamin_custom'] = $vitaminItems[$index] ?? null;
            }

            // Izinkan multiple entries per day
            JadwalMenu::create($dataToCreate);
        }

        return back()->with('success', 'Menu untuk ' . $request->hari . ' berhasil ditambahkan!');
    }

    public function searchMakanan(Request $request)
    {
        $query = $request->get('q', '');
        
        $makanans = Makanan::where('nama_makanan', 'like', "%$query%")
            ->with('nilaiGizi')
            ->limit(10)
            ->get()
            ->map(function ($m) {
                return [
                    'id' => $m->id_makanan,
                    'text' => $m->nama_makanan . ' (' . $m->kategori . ')',
                    'kalori' => $m->nilaiGizi->kalori ?? 0,
                    'protein' => $m->nilaiGizi->protein ?? 0,
                    'karbohidrat' => $m->nilaiGizi->karbohidrat ?? 0,
                    'vitamin' => $m->nilaiGizi->vitamin ?? '-',
                ];
            });

        return response()->json($makanans);
    }

    public function destroy($id_jadwal)
    {
        if (!session('is_admin')) {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin!');
        }

        $jadwal = JadwalMenu::findOrFail($id_jadwal);
        $hari = $jadwal->hari;
        $jadwal->delete();

        return back()->with('success', 'Menu untuk ' . $hari . ' berhasil dihapus!');
    }
}
