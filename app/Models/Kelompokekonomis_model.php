<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelompokekonomis_model extends Model
{
    protected $table = 'kelompokekonomis_model'; // Nama tabel di database
    protected $primaryKey = 'idkelompok'; // Primary Key

    protected $allowedFields = ['kelompok', 'masamanfaat', 'penyusutan']; // Kolom yang bisa diisi

    public $timestamps = false; // Jika tabel tidak pakai created_at dan updated_at
}
