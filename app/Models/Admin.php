<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Karena nama tabel di database kita adalah 'admin' (bukan 'admins')
    protected $table = 'admin';

    // Nama Primary Key di tabel kita
    protected $primaryKey = 'id_admin';

    // Matikan timestamps karena tabel kita tidak punya kolom created_at/updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'username',
        'password',
        'nama',
    ];

    // Menyembunyikan password saat data dipanggil
    protected $hidden = [
        'password',
    ];
}