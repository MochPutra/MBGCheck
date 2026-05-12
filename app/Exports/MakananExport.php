<?php

namespace App\Exports;

use App\Models\Makanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MakananExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Makanan::with('nilaiGizi')->get()->map(function ($makanan) {
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
}