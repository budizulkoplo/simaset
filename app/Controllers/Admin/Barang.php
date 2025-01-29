<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\barang_model;
use App\Models\kategoribarang_model;

class Barang extends BaseController
{
    public function index()
{
    checklogin();
    
    $barang_model = new barang_model();
    $kategoriModel = new kategoribarang_model();

    $data = [
        'title' => 'Manajemen Barang',
        'barang' => $barang_model->findAll(),
        'kategoribarang' => $kategoriModel->findAll() ?? [], // Pastikan selalu array
        'content' => 'admin/barang/index',
    ];
    
    echo view('admin/layout/wrapper', $data);
}


    public function add()
    {
        checklogin();
        
        // Ambil data kategori untuk dropdown
        $kategoriModel = new Kategoribarang_model();
        $kategoriBarang = $kategoriModel->findAll();
        
        if ($this->request->getMethod() === 'post' && $this->validate([
            'idkategoribarang' => 'required|integer',
            'namabarang'       => 'required',
            'tahunperolehan'   => 'required|max_length[5]',
            'merk'              => 'required|max_length[100]',
        ])) {
            $model = new barang_model();
            $model->save([
                'idkategoribarang' => $this->request->getPost('idkategoribarang'),
                'namabarang'       => $this->request->getPost('namabarang'),
                'tahunperolehan'   => $this->request->getPost('tahunperolehan'),
                'merk'              => $this->request->getPost('merk'),
            ]);
            session()->setFlashdata('sukses', 'Barang berhasil ditambahkan.');
            return redirect()->to(base_url('admin/barang'));
        }

        $data = [
            'title' => 'Tambah Barang',
            'kategori_barang' => $kategoriBarang,
            'content' => 'admin/barang/add',
            'validation' => $this->validator,
        ];
        
        echo view('admin/layout/wrapper', $data);
    }

    public function edit($id)
    {
        checklogin();
        
        $model = new barang_model();
        $barang = $model->find($id);
        
        if (!$barang) {
            session()->setFlashdata('error', 'Barang tidak ditemukan.');
            return redirect()->to(base_url('admin/barang'));
        }
        
        // Ambil data kategori untuk dropdown
        $kategoriModel = new Kategoribarang_model();
        $kategoriBarang = $kategoriModel->findAll();
        
        $data = [
            'title' => 'Edit Barang',
            'barang' => $barang,
            'kategori_barang' => $kategoriBarang,
            'content' => 'admin/barang/edit',
            'validation' => \Config\Services::validation(),
        ];
        
        echo view('admin/layout/wrapper', $data);
    }

    public function update($id)
    {
        checklogin();
        
        if ($this->request->getMethod() === 'post' && $this->validate([
            'idkategoribarang' => 'required|integer',
            'namabarang'       => 'required',
            'tahunperolehan'   => 'required|max_length[5]',
            'merk'              => 'required|max_length[100]',
        ])) {
            $model = new barang_model();
            
            $barang = $model->find($id);
            if (!$barang) {
                session()->setFlashdata('error', 'Barang tidak ditemukan.');
                return redirect()->to(base_url('admin/barang'));
            }
            
            $model->update($id, [
                'idkategoribarang' => $this->request->getPost('idkategoribarang'),
                'namabarang'       => $this->request->getPost('namabarang'),
                'tahunperolehan'   => $this->request->getPost('tahunperolehan'),
                'merk'              => $this->request->getPost('merk'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
            
            session()->setFlashdata('sukses', 'Barang berhasil diperbarui.');
            return redirect()->to(base_url('admin/barang'));
        }
        
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    public function delete($id)
    {
        checklogin();
        
        $model = new barang_model();
        if ($model->find($id)) {
            $model->delete($id);
            session()->setFlashdata('sukses', 'Barang berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Barang tidak ditemukan.');
        }
        
        return redirect()->to(base_url('admin/barang'));
    }
}
