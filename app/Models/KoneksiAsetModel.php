<?php
namespace App\Models;

use CodeIgniter\Model;

class KoneksiAsetModel extends Model
{
    protected $table = 'koneksi_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idaset', 'koneksiidaset', 'created_at', 'updated_at'];
}