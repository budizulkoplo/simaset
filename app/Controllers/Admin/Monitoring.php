<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Monitoring_model;
use App\Models\Dataaset_model;

class Monitoring extends BaseController
{
    protected $monitoringModel;
    protected $dataasetModel;

    public function __construct()
    {
        $this->monitoringModel = new Monitoring_model();
        $this->dataasetModel = new Dataaset_model();
    }

    public function index()
    {
        checklogin();
        $barangModel = new \App\Models\Barang_model();
        $barang = $barangModel->findAll();

        // Ambil data lokasi dari model Lokasiaset_model
        $lokasiModel = new \App\Models\Lokasiaset_model();
        $lokasi = $lokasiModel->findAll();

        // Ambil data kelompok dari model Kelompokekonomis_model
        $kelompokModel = new \App\Models\Kelompokekonomis_model();
        $kelompok = $kelompokModel->findAll();

        $data = [
            'title' => 'Manajemen Monitoring',
            'dataaset' => $this->dataasetModel->getDataasetWithRelations(),
            'monitoring' => $this->monitoringModel->findAll(),
            'content' => 'admin/monitoring/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function create()
    {
        checklogin();
        $barangModel = new \App\Models\Barang_model();
        $barang = $barangModel->findAll();

        // Ambil data lokasi dari model Lokasiaset_model
        $lokasiModel = new \App\Models\Lokasiaset_model();
        $lokasi = $lokasiModel->findAll();

        // Ambil data kelompok dari model Kelompokekonomis_model
        $kelompokModel = new \App\Models\Kelompokekonomis_model();
        $kelompok = $kelompokModel->findAll();

        $data = [
            'title' => 'Manajemen Monitoring',
            'dataaset' => $this->dataasetModel->getDataasetWithRelations(),
            'monitoring' => $this->monitoringModel->findAll(),
            'content' => 'admin/monitoring/tambah',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function add()
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodeaset' => 'required|max_length[50]',
            'kerusakan' => 'required',
            'akibatkerusakan' => 'required',
            'faktorpengaruh' => 'required',
            'monitoring' => 'required',
            'langkahperbaikan' => 'required',
            'jumlahkerusakan' => 'required|integer',
        ])) {
            $this->monitoringModel->save([
                'kodeaset' => $this->request->getPost('kodeaset'),
                'kerusakan' => $this->request->getPost('kerusakan'),
                'akibatkerusakan' => $this->request->getPost('akibatkerusakan'),
                'faktorpengaruh' => $this->request->getPost('faktorpengaruh'),
                'monitoring' => $this->request->getPost('monitoring'),
                'langkahperbaikan' => $this->request->getPost('langkahperbaikan'),
                'jumlahkerusakan' => $this->request->getPost('jumlahkerusakan'),
            ]);
            session()->setFlashdata('sukses', 'Data Monitoring berhasil ditambahkan.');
            return redirect()->to(base_url('admin/monitoring'));
        }

        $data = [
            'title' => 'Tambah Monitoring',
            'dataaset' => $this->dataasetModel->findAll(),
            'content' => 'admin/monitoring/add',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function edit($id)
    {
        checklogin();

        $monitoring = $this->monitoringModel->find($id);

        if (!$monitoring) {
            session()->setFlashdata('error', 'Data Monitoring tidak ditemukan.');
            return redirect()->to(base_url('admin/monitoring'));
        }

        $data = [
            'title' => 'Edit Monitoring',
            'monitoring' => $monitoring,
            'dataaset' => $this->dataasetModel->findAll(),
            'content' => 'admin/monitoring/edit',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function update($id)
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodeaset' => 'required|max_length[50]',
            'kerusakan' => 'required',
            'akibatkerusakan' => 'required',
            'faktorpengaruh' => 'required',
            'monitoring' => 'required',
            'langkahperbaikan' => 'required',
            'jumlahkerusakan' => 'required|integer',
        ])) {
            $this->monitoringModel->update($id, [
                'kodeaset' => $this->request->getPost('kodeaset'),
                'kerusakan' => $this->request->getPost('kerusakan'),
                'akibatkerusakan' => $this->request->getPost('akibatkerusakan'),
                'faktorpengaruh' => $this->request->getPost('faktorpengaruh'),
                'monitoring' => $this->request->getPost('monitoring'),
                'langkahperbaikan' => $this->request->getPost('langkahperbaikan'),
                'jumlahkerusakan' => $this->request->getPost('jumlahkerusakan'),
            ]);
            session()->setFlashdata('sukses', 'Data Monitoring berhasil diperbarui.');
            return redirect()->to(base_url('admin/monitoring'));
        }

        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    
    public function delete($id)
    {
        checklogin();

        if ($this->monitoringModel->find($id)) {
            $this->monitoringModel->delete($id);
            session()->setFlashdata('sukses', 'Data Monitoring berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data Monitoring tidak ditemukan.');
        }

        return redirect()->to(base_url('admin/monitoring'));
    }
}