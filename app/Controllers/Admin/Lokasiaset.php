<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Lokasiaset_model;

class Lokasiaset extends BaseController
{
    protected $lokasiasetModel;

    public function __construct()
    {
        $this->lokasiasetModel = new Lokasiaset_model();
    }

    public function index()
    {
        checklogin(); // Pastikan fungsi ini sudah ada untuk memeriksa login

        $data = [
            'title' => 'Manajemen Lokasi Aset',
            'lokasiaset' => $this->lokasiasetModel->findAll(),
            'content' => 'admin/lokasiaset/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function add()
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'namalokasi' => 'required|max_length[100]',
        ])) {
            $this->lokasiasetModel->save([
                'namalokasi' => $this->request->getPost('namalokasi'),
            ]);
            session()->setFlashdata('sukses', 'Lokasi Aset berhasil ditambahkan.');
            return redirect()->to(base_url('admin/lokasiaset'));
        }

        $data = [
            'title' => 'Tambah Lokasi Aset',
            'content' => 'admin/lokasiaset/add',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function edit($id)
    {
        checklogin();

        $lokasiaset = $this->lokasiasetModel->find($id);

        if (!$lokasiaset) {
            session()->setFlashdata('error', 'Lokasi Aset tidak ditemukan.');
            return redirect()->to(base_url('admin/lokasiaset'));
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'namalokasi' => 'required|max_length[100]',
        ])) {
            $this->lokasiasetModel->update($id, [
                'namalokasi' => $this->request->getPost('namalokasi'),
            ]);
            session()->setFlashdata('sukses', 'Lokasi Aset berhasil diperbarui.');
            return redirect()->to(base_url('admin/lokasiaset'));
        }

        $data = [
            'title' => 'Edit Lokasi Aset',
            'lokasiaset' => $lokasiaset,
            'content' => 'admin/lokasiaset/edit',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }
    public function update($id)
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'namalokasi' => 'required|max_length[100]',
        ])) {
            $this->lokasiasetModel->update($id, [
                'namalokasi' => $this->request->getPost('namalokasi'),
            ]);
            session()->setFlashdata('sukses', 'Lokasi Aset berhasil diperbarui.');
            return redirect()->to(base_url('admin/lokasiaset'));
        }

        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    public function delete($id)
    {
        checklogin();

        if ($this->lokasiasetModel->find($id)) {
            $this->lokasiasetModel->delete($id);
            session()->setFlashdata('sukses', 'Lokasi Aset berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Lokasi Aset tidak ditemukan.');
        }

        return redirect()->to(base_url('admin/lokasiaset'));
    }
}