<?php
namespace App\Models;

use CodeIgniter\Model;

class Dataaset_model extends Model
{
    protected $table      = 'dataaset';
    protected $primaryKey = 'idaset';
    protected $allowedFields = ['kodeaset', 'idbarang', 'namaaset', 'jumlah', 'kondisi', 'idlokasi', 'idkelompok', 'nilaiaset'];
    protected $useTimestamps = true; // Jika Anda ingin menggunakan created_at dan updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Relasi dengan tabel barang
    public function getBarang()
    {
        return $this->db->table('barang')->get()->getResultArray();
    }

    // Relasi dengan tabel lokasiaset
    public function getLokasi()
    {
        return $this->db->table('lokasiaset')->get()->getResultArray();
    }

    // Relasi dengan tabel kelompokekonomis
    public function getKelompok()
    {
        return $this->db->table('kelompokekonomis')->get()->getResultArray();
    }
}