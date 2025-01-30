<?php
namespace App\Models;

use CodeIgniter\Model;

class Lokasiaset_model extends Model
{
    protected $table      = 'lokasiaset';
    protected $primaryKey = 'idlokasi';
    protected $allowedFields = ['namalokasi'];
    protected $useTimestamps = true; // Jika Anda ingin menggunakan created_at dan updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}