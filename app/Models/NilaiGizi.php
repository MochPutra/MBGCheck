<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiGizi extends Model
{
    // Beritahu Laravel nama tabel yang benar di PostgreSQL
    protected $table = 'nilai_gizi';
    
    // Beritahu Laravel nama Primary Key-nya
    protected $primaryKey = 'id_gizi';
    
    // Matikan timestamps karena tabel kita tidak punya created_at/updated_at
    public $timestamps = false;

    // Opsional: Relasi balik ke tabel Makanan
    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'id_makanan', 'id_makanan');
    }

    // Izinkan kolom-kolom ini diisi secara otomatis
    protected $fillable = ['id_makanan', 'kalori', 'protein', 'karbohidrat', 'vitamin'];
}