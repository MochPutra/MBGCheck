<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $table = 'makanan';
    protected $primaryKey = 'id_makanan';
    public $timestamps = false;

    protected $fillable = ['nama_makanan', 'kategori', 'gambar'];

    // Relasi 1-to-1 ke tabel nilai_gizi
    public function nilaiGizi()
    {
        return $this->hasOne(NilaiGizi::class, 'id_makanan', 'id_makanan');
    }
    // Relasi ke tabel resep (1 makanan punya 1 resep)
    public function resep()
    {
        return $this->hasOne(Resep::class, 'id_makanan', 'id_makanan');
    }
}