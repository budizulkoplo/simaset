<?php

namespace App\Models;

use CodeIgniter\Model;

class barang_model extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'idbarang';
    protected $allowedFields = ['idkategoribarang', 'namabarang', 'tahunperolehan', 'merk', 'created_at', 'updated_at'];

    public function getBarangWithKategori()
    {
        return $this->select('barang.*, kategoribarang.kodekategori, kategoribarang.namakategori')
                    ->join('kategoribarang', 'kategoribarang.idkategoribarang = barang.idkategoribarang')
                    ->findAll();
    }
    }
