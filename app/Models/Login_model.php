<?php

namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model
{
    protected $table = ''; // Tidak digunakan karena query custom


    public function login($username, $password)
    {
        // Koneksi ke database
        $db = \Config\Database::connect();
        
        // Ambil data user berdasarkan username
        $builder = $db->table('users')
            ->select('id_user as id, nama, username, password, gambar as foto, akses_level, idranting')
            ->where('username', $username)
            ->get();
        
        $user = $builder->getRowArray();  // Ambil hasil query sebagai array
    
        // Periksa apakah user ditemukan
        if (!$user) {
            return false; // Username tidak ditemukan
        }
    
        // Verifikasi password dengan password_hash()
        if (!password_verify($password, $user['password'])) {
            return false; // Password salah
        }
    
        // Jika password benar, kembalikan data user (tanpa password)
        unset($user['password']); // Hapus password agar tidak dikembalikan
        return $user;
    }
    
}




