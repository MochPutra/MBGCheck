<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KalkulatorGiziController extends Controller
{
    public function index()
    {
        return view('kalkulator.index');
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'berat' => 'required|numeric|min:20|max:300',
            'tinggi' => 'required|numeric|min:100|max:250',
            'usia' => 'required|numeric|min:10|max:100',
            'gender' => 'required|in:pria,wanita',
            'aktivitas' => 'required|in:1.2,1.375,1.55,1.725,1.9',
            'tujuan' => 'required|in:deficit,maintain,surplus',
        ]);

        $berat = $request->berat;
        $tinggi = $request->tinggi;
        $usia = $request->usia;
        $gender = $request->gender;
        $aktivitas = (float) $request->aktivitas;
        $tujuan = $request->tujuan;

        // Mifflin-St Jeor Equation for BMR
        if ($gender === 'pria') {
            $bmr = (10 * $berat) + (6.25 * $tinggi) - (5 * $usia) + 5;
        } else {
            $bmr = (10 * $berat) + (6.25 * $tinggi) - (5 * $usia) - 161;
        }

        // TDEE (Total Daily Energy Expenditure)
        $tdee = round($bmr * $aktivitas);

        // Adjust based on goal
        switch ($tujuan) {
            case 'deficit':
                $targetKalori = round($tdee * 0.8); // -20%
                $tujuanLabel = 'Defisit Kalori (Turun Berat Badan)';
                $proteinPerKg = 1.6; // higher protein during deficit
                $karboPersen = 0.40;
                $lemakPersen = 0.30;
                break;
            case 'surplus':
                $targetKalori = round($tdee * 1.15); // +15%
                $tujuanLabel = 'Surplus Kalori (Naik Massa Otot)';
                $proteinPerKg = 2.0;
                $karboPersen = 0.50;
                $lemakPersen = 0.20;
                break;
            default:
                $targetKalori = $tdee;
                $tujuanLabel = 'Maintenance (Jaga Berat Badan)';
                $proteinPerKg = 1.2;
                $karboPersen = 0.50;
                $lemakPersen = 0.25;
                break;
        }

        // Macro targets
        $targetProtein = round($berat * $proteinPerKg);
        $targetKarbo = round(($targetKalori * $karboPersen) / 4); // 4 cal/g
        $targetLemak = round(($targetKalori * $lemakPersen) / 9); // 9 cal/g

        // BMI
        $bmi = round($berat / (($tinggi / 100) ** 2), 1);
        if ($bmi < 18.5) $bmiStatus = 'Kurus';
        elseif ($bmi < 25) $bmiStatus = 'Normal';
        elseif ($bmi < 30) $bmiStatus = 'Gemuk';
        else $bmiStatus = 'Obesitas';

        // Food recommendations from database
        $rekomendasiProtein = Makanan::select('makanan.id_makanan', 'makanan.nama_makanan', 'makanan.kategori',
                'nilai_gizi.kalori', 'nilai_gizi.protein', 'nilai_gizi.karbohidrat')
            ->join('nilai_gizi', 'makanan.id_makanan', '=', 'nilai_gizi.id_makanan')
            ->where('nilai_gizi.protein', '>', 10)
            ->orderByDesc('nilai_gizi.protein')
            ->limit(10)
            ->get();

        $rekomendasiRendahKalori = Makanan::select('makanan.id_makanan', 'makanan.nama_makanan', 'makanan.kategori',
                'nilai_gizi.kalori', 'nilai_gizi.protein', 'nilai_gizi.karbohidrat')
            ->join('nilai_gizi', 'makanan.id_makanan', '=', 'nilai_gizi.id_makanan')
            ->where('nilai_gizi.kalori', '>', 0)
            ->where('nilai_gizi.kalori', '<=', 150)
            ->where('nilai_gizi.protein', '>', 3)
            ->orderBy('nilai_gizi.kalori')
            ->limit(10)
            ->get();

        $rekomendasiEnergi = Makanan::select('makanan.id_makanan', 'makanan.nama_makanan', 'makanan.kategori',
                'nilai_gizi.kalori', 'nilai_gizi.protein', 'nilai_gizi.karbohidrat')
            ->join('nilai_gizi', 'makanan.id_makanan', '=', 'nilai_gizi.id_makanan')
            ->where('nilai_gizi.karbohidrat', '>', 15)
            ->where('nilai_gizi.kalori', '>', 100)
            ->orderByDesc('nilai_gizi.karbohidrat')
            ->limit(10)
            ->get();

        return view('kalkulator.hasil', compact(
            'berat', 'tinggi', 'usia', 'gender', 'aktivitas', 'tujuan',
            'bmr', 'tdee', 'targetKalori', 'tujuanLabel',
            'targetProtein', 'targetKarbo', 'targetLemak',
            'bmi', 'bmiStatus',
            'rekomendasiProtein', 'rekomendasiRendahKalori', 'rekomendasiEnergi'
        ));
    }
}
