<?php
namespace App\Models;

use CodeIgniter\Model;

class Penyusutan_model extends Model
{
    protected $table      = 'dataaset'; // Nama tabel data aset
    protected $primaryKey = 'idaset'; // Primary key tabel data aset
    protected $allowedFields = [
        'kodeaset', 'idbarang', 'jumlah', 'kondisi', 'nilaiaset', 
        'totalnilaiaset', 'tahunperolehan', 'merk', 'idlokasi', 'idkelompok'
    ]; // Field yang diizinkan untuk diisi

    // Jika Anda ingin menggunakan timestamps (created_at, updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Method untuk mengambil data aset dengan perhitungan penyusutan
    public function getAsetWithPenyusutan()
    {
        $query = $this->db->query("
            SELECT 
    idaset, 
    kodeaset, 
    a.idbarang, 
    namaaset, 
    jumlah, 
    kondisi, 
    nilaiaset,
    totalnilaiaset,
    tahunperolehan,
    merk,
    namalokasi,
    kelompok,
    masamanfaat,
    penyusutan,
    YEAR(CURDATE()) - tahunperolehan AS lama_pemakaian,
    CASE 
        WHEN (YEAR(CURDATE()) - tahunperolehan) >= 1 AND (YEAR(CURDATE()) - tahunperolehan) <= masamanfaat 
        THEN nilaiaset * (penyusutan / 100) * (YEAR(CURDATE()) - tahunperolehan)
        WHEN (YEAR(CURDATE()) - tahunperolehan) > masamanfaat
        THEN nilaiaset * (penyusutan / 100) * masamanfaat
        ELSE 0
    END AS nilai_penyusutan,
    CASE 
        WHEN (YEAR(CURDATE()) - tahunperolehan) >= 1 AND (YEAR(CURDATE()) - tahunperolehan) <= masamanfaat
        THEN nilaiaset - (nilaiaset * (penyusutan / 100) * (YEAR(CURDATE()) - tahunperolehan))
        WHEN (YEAR(CURDATE()) - tahunperolehan) > masamanfaat
        THEN nilaiaset - (nilaiaset * (penyusutan / 100) * masamanfaat)
        ELSE nilaiaset
    END AS nilaiaset_setelah_penyusutan
FROM 
    dataaset a 
    JOIN barang b ON a.idbarang = b.idbarang
    JOIN lokasiaset c ON a.idlokasi = c.idlokasi 
    JOIN kelompokekonomis d ON a.idkelompok = d.idkelompok;
        ");

        return $query->getResultArray(); // Mengembalikan hasil query sebagai array
    }
}
?>