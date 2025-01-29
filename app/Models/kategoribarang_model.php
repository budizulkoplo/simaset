<?php

namespace App\Models;

use CodeIgniter\Model;

class kategoribarang_model extends Model
{
    protected $table = 'kategoribarang';
    protected $primaryKey = 'idkategoribarang';
    protected $allowedFields = ['kodekategori', 'namakategori', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
