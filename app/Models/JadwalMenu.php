<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMenu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_menus';
    protected $primaryKey = 'id_jadwal';
    public $timestamps = true;

    protected $fillable = [
        'id_makanan',
        'hari',
        'minggu',
        'tahun',
        'dipesan_oleh',
        'nama_makanan_custom',
        'kalori_custom',
        'protein_custom',
        'karbohidrat_custom',
        'vitamin_custom',
    ];

    // Relasi ke Makanan
    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'id_makanan', 'id_makanan');
    }
}
