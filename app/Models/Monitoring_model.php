<?php
namespace App\Models;

use CodeIgniter\Model;

class Monitoring_model extends Model
{
    protected $table      = 'monitoring';
    protected $primaryKey = 'idmonitoring';
    protected $allowedFields = ['kodeaset', 'kerusakan', 'akibatkerusakan', 'faktorpengaruh', 'monitoring', 'langkahperbaikan', 'jumlahkerusakan'];
    protected $useTimestamps = true; // Jika Anda ingin menggunakan created_at dan updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Relasi dengan tabel dataaset
    public function getDataasetWithRelations()
    {
        return $this->select('dataaset.*, lokasiaset.namalokasi, kelompokekonomis.kelompok')
                    ->join('lokasiaset', 'lokasiaset.idlokasi = dataaset.idlokasi')
                    ->join('kelompokekonomis', 'kelompokekonomis.idkelompok = dataaset.idkelompok')
                    ->findAll();
    }
    
    public function getDataaset()
    {
        return $this->db->table('dataaset')->get()->getResultArray();
    }
}