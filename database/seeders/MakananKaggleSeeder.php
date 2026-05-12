<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Makanan;
use App\Models\NilaiGizi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Penting untuk fungsi pencarian kata

class MakananKaggleSeeder extends Seeder
{
    public function run()
    {
        // Daftar 3 file CSV Anda
        $files = [
            storage_path('app/DataMBGCheck1.csv'),
            storage_path('app/DatasetMBGCheck2.csv'),
            storage_path('app/DataMBGCheck3.csv')
        ];

        $jumlahData = 0;

        foreach ($files as $file) {
            if (!file_exists($file)) {
                $this->command->error("File tidak ditemukan: " . basename($file));
                continue;
            }

            // Buka file CSV
            $csvData = fopen($file, 'r');
            
            // Lewati baris pertama (Header). Perhatikan kita pakai pemisah ';' (titik koma)
            fgetcsv($csvData, 0, ';');

            // Mulai baca baris demi baris
            while (($row = fgetcsv($csvData, 0, ';')) !== false) {
                
                // Hentikan jika baris kosong
                if (!isset($row[1])) continue;

                $namaMakanan = $row[1];
                
                // --- DETEKSI KATEGORI OTOMATIS ---
                $kategori = $this->tentukanKategori($namaMakanan);

                // 1. Simpan ke tabel makanan
                $makanan = Makanan::create([
                    'nama_makanan' => $namaMakanan,
                    'kategori' => $kategori,
                ]);

                // 2. Gabungkan data Lemak, Serat, Gula, Sodium ke kolom vitamin
                // Format: Lemak: ...g, Serat: ...g, Gula: ...g, Sodium: ...mg
                $infoTambahan = "Lemak: {$row[3]}g, Serat: {$row[6]}g, Gula: {$row[7]}g, Sodium: {$row[8]}mg";

                // 3. Simpan ke tabel nilai_gizi
                NilaiGizi::create([
                    'id_makanan' => $makanan->id_makanan,
                    'kalori' => (float) $row[2],
                    'protein' => (float) $row[4],
                    'karbohidrat' => (float) $row[5],
                    'vitamin' => $infoTambahan,
                ]);

                $jumlahData++;
            }

            fclose($csvData);
        }

        // Beri pesan sukses di terminal
        $this->command->info("Selesai! Berhasil mengimpor {$jumlahData} data makanan dari 3 file CSV sekaligus.");
    }

    // Fungsi Ajaib untuk Menebak Kategori dari Nama Makanan
    private function tentukanKategori($nama)
    {
        $namaLower = strtolower($nama);

        if (Str::contains($namaLower, ['nasi', 'roti', 'mie', 'jagung', 'gandum', 'pasta', 'kentang', 'ubi', 'singkong'])) {
            return 'Makanan Pokok';
        } elseif (Str::contains($namaLower, ['ayam', 'sapi', 'ikan', 'telur', 'daging', 'udang', 'tahu', 'tempe', 'kambing'])) {
            return 'Lauk Pauk';
        } elseif (Str::contains($namaLower, ['sayur', 'bayam', 'kangkung', 'wortel', 'brokoli', 'tomat', 'selada', 'kol'])) {
            return 'Sayuran';
        } elseif (Str::contains($namaLower, ['buah', 'apel', 'jeruk', 'pisang', 'kelapa', 'mangga', 'nance', 'kaktus', 'melon'])) {
            return 'Buah-buahan';
        } elseif (Str::contains($namaLower, ['susu', 'keju', 'krim', 'yogurt', 'butter', 'mentega', 'catupiry'])) {
            return 'Susu';
        } else {
            // Jika tidak terdeteksi kata kuncinya, masukkan ke Pelengkap / Lainnya
            return 'Bahan Pelengkap / Lainnya';
        }
    }
}