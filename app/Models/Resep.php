<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    // Nama tabel di database
    protected $table = 'resep';
    
    // Primary key tabel
    protected $primaryKey = 'id_resep';
    
    // Karena kita tidak pakai kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = ['id_makanan', 'bahan_bahan'];

    // Relasi balik ke Makanan
    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'id_makanan', 'id_makanan');
    }
}