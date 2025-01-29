<?php

use App\Controllers\BaseController;
namespace App\Controllers\Admin;

use App\Models\kategoribarang_model;


class KategoriBarang extends BaseController
{
    public function index()
    {
        checklogin();
        
        $model = new kategoribarang_model();
        $data = [
            'title' => 'Manajemen Kategori Barang',
            'kategoribarang' => $model->findAll(),
            'content' => 'admin/kategoribarang/index',
        ];
        
        echo view('admin/layout/wrapper', $data);
    }

    public function add()
    {
        checklogin();
        
        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodekategori' => 'required',
            'namakategori' => 'required',
        ])) {
            $model = new kategoribarang_model();
            $model->save([
                'kodekategori' => $this->request->getPost('kodekategori'),
                'namakategori' => $this->request->getPost('namakategori'),
            ]);
            session()->setFlashdata('sukses', 'Kategori barang berhasil ditambahkan.');
            return redirect()->to(base_url('admin/kategoribarang'));
        }

        $data = [
            'title' => 'Tambah Kategori Barang',
            'content' => 'admin/kategoribarang/add',
            'validation' => $this->validator,
        ];
        
        echo view('admin/layout/wrapper', $data);
    }

    public function edit($id)
{
    checklogin();
    
    $model = new kategoribarang_model();
    $kategori = $model->find($id);
    
    if (!$kategori) {
        session()->setFlashdata('error', 'Kategori barang tidak ditemukan.');
        return redirect()->to(base_url('admin/kategoribarang'));
    }
    
    $data = [
        'title' => 'Edit Kategori Barang',
        'kategori' => $kategori,
        'content' => 'admin/kategoribarang/edit',
        'validation' => \Config\Services::validation(),
    ];
    
    echo view('admin/layout/wrapper', $data);
}

public function update($id)
{
    checklogin();
    
    if ($this->request->getMethod() === 'post' && $this->validate([
        'kodekategori' => 'required',
        'namakategori' => 'required',
    ])) {
        $model = new kategoribarang_model();
        
        $kategori = $model->find($id);
        if (!$kategori) {
            session()->setFlashdata('error', 'Kategori barang tidak ditemukan.');
            return redirect()->to(base_url('admin/kategoribarang'));
        }
        
        $model->update($id, [
            'kodekategori' => $this->request->getPost('kodekategori'),
            'namakategori' => $this->request->getPost('namakategori'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        session()->setFlashdata('sukses', 'Kategori barang berhasil diperbarui.');
        return redirect()->to(base_url('admin/kategoribarang'));
    }
    
    return redirect()->back()->withInput()->with('validation', $this->validator);
}


    public function delete($id)
    {
        checklogin();
        
        $model = new kategoribarang_model();
        if ($model->find($id)) {
            $model->delete($id);
            session()->setFlashdata('sukses', 'Kategori barang berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Kategori barang tidak ditemukan.');
        }
        
        return redirect()->to(base_url('admin/kategoribarang'));
    }
}
