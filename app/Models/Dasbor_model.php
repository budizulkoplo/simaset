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
    // transaksi
    
}
