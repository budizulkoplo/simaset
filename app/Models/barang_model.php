<?php

namespace App\Models;

use CodeIgniter\Model;

class barang_model extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'barang';

    // Nama primary key pada tabel
    protected $primaryKey = 'idbarang';

    // Daftar field yang diizinkan untuk diinsert/update
    protected $allowedFields = [
        'idkategoribarang', 'namabarang', 'tahunperolehan', 'merk', 
    ];

    // Menentukan apakah kita menggunakan timestamps otomatis
    protected $useTimestamps = false;

    
}
