<?php
namespace App\Models;

use CodeIgniter\Model;

class Pengadaan_model extends Model
{
    protected $table      = 'pengadaan';
    protected $primaryKey = 'idpengadaan';
    protected $allowedFields = ['idlokasi', 'idbarang', 'namaaset', 'jumlah', 'nilaiaset', 'status', 'user'];
    protected $useTimestamps = true; // Jika Anda ingin menggunakan created_at dan updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPengadaanWithRelations()
    {
        return $this->select('pengadaan.*, lokasiaset.namalokasi')
                    ->join('lokasiaset', 'lokasiaset.idlokasi = pengadaan.idlokasi')
                    ->findAll();
    }

    // Relasi dengan tabel lokasiaset
    public function getLokasi()
    {
        return $this->db->table('lokasiaset')->get()->getResultArray();
    }

    // Relasi dengan tabel barang
    public function getBarang()
    {
        return $this->db->table('barang')->get()->getResultArray();
    }
}