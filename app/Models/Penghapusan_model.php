<?php
namespace App\Models;

use CodeIgniter\Model;

class Penghapusan_model extends Model
{
    protected $table      = 'penghapusan'; // Nama tabel penghapusan
    protected $primaryKey = 'idhapus'; // Primary key tabel penghapusan
    protected $allowedFields = [
        'idaset', 'kodeaset', 'namaaset', 'jumlahdihapuskan', 'penyebab', 'tanggalhapus'
    ]; // Field yang diizinkan untuk diisi

    // Jika Anda ingin menggunakan timestamps (created_at, updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Method untuk mengambil data penghapusan dengan join ke tabel dataaset
    public function getPenghapusanWithAset()
    {
        $query = $this->db->query("
            SELECT 
                p.idhapus,
                p.idaset,
                p.kodeaset,
                p.namaaset,
                p.jumlahdihapuskan,
                p.penyebab,
                p.tanggalhapus,
                a.nilaiaset,
                b.tahunperolehan
            FROM 
                penghapusan p
                JOIN dataaset a ON p.idaset = a.idaset join barang b on a.idbarang=b.idbarang
        ");

        return $query->getResultArray(); // Mengembalikan hasil query sebagai array
    }

    // Method untuk mengambil data penghapusan berdasarkan ID
    public function getPenghapusanById($id)
    {
        return $this->find($id); // Menggunakan method find() bawaan CodeIgniter
    }

    // Method untuk menambahkan data penghapusan
    public function tambahPenghapusan($data)
    {
        return $this->insert($data); // Menggunakan method insert() bawaan CodeIgniter
    }

    // Method untuk mengupdate data penghapusan
    public function updatePenghapusan($id, $data)
    {
        return $this->update($id, $data); // Menggunakan method update() bawaan CodeIgniter
    }

    // Method untuk menghapus data penghapusan
    public function hapusPenghapusan($id)
    {
        return $this->delete($id); // Menggunakan method delete() bawaan CodeIgniter
    }
}
?>