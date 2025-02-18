<?php

namespace App\Models;

use CodeIgniter\Model;

class Dasbor_model extends Model
{
    // berita
   

    // user
    public function user()
    {
        $builder = $this->db->table('users');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    public function dataaset()
    {
        $builder = $this->db->table('dataaset');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    public function pengadaan()
    {
        $builder = $this->db->table('pengadaan');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    public function penghapusan()
    {
        $builder = $this->db->table('penghapusan');
        $query   = $builder->get();

        return $query->getNumRows();
    }

    
    // transaksi
    
}
