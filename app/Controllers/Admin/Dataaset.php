<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Dataaset_model;
use App\Models\Barang_model;
use App\Models\Lokasiaset_model;
use App\Models\Kelompokekonomis_model;

class Dataaset extends BaseController
{
    protected $dataasetModel;
    protected $barangModel;
    protected $lokasiModel;
    protected $kelompokModel;

    public function __construct()
    {
        $this->dataasetModel = new Dataaset_model();
        $this->barangModel = new Barang_model();
        $this->lokasiModel = new Lokasiaset_model();
        $this->kelompokModel = new Kelompokekonomis_model();
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
            'title' => 'Manajemen Data Aset',
            'barang' => $barang, // Kirim data barang ke view
            'lokasi' => $lokasi, // Kirim data lokasi ke view
            'kelompok' => $kelompok, // Kirim data kelompok ke view
            'dataaset' => $this->dataasetModel->getDataasetWithRelations(),
            'content' => 'admin/dataaset/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function create()
    {
        checklogin();  // Pastikan pengguna sudah login
        $barangModel = new \App\Models\Barang_model();
        $barang = $barangModel->findAll();

        // Ambil data lokasi dari model Lokasiaset_model
        $lokasiModel = new \App\Models\Lokasiaset_model();
        $lokasi = $lokasiModel->findAll();

        // Ambil data kelompok dari model Kelompokekonomis_model
        $kelompokModel = new \App\Models\Kelompokekonomis_model();
        $kelompok = $kelompokModel->findAll();

        $data = [
            'title'   => 'Pendataan Aset',
            'barang' => $barang, // Kirim data barang ke view
            'lokasi' => $lokasi, // Kirim data lokasi ke view
            'kelompok' => $kelompok, // Kirim data kelompok ke view
            'dataaset' => $this->dataasetModel->getDataasetWithRelations(),
            'content' => 'admin/dataaset/tambah',  // View untuk form tambah wakaf
        ];
        echo view('admin/layout/wrapper', $data);
    }

    public function add()
{
    checklogin();

    // Ambil data barang dari model Barang_model
    $barangModel = new \App\Models\Barang_model();
    $barang = $barangModel->findAll();

    // Ambil data lokasi dari model Lokasiaset_model
    $lokasiModel = new \App\Models\Lokasiaset_model();
    $lokasi = $lokasiModel->findAll();

    // Ambil data kelompok dari model Kelompokekonomis_model
    $kelompokModel = new \App\Models\Kelompokekonomis_model();
    $kelompok = $kelompokModel->findAll();

    if ($this->request->getMethod() === 'post' && $this->validate([
        'kodeaset' => 'required|max_length[50]',
        'idbarang' => 'required|integer',
        'jumlah' => 'required',
        'kondisi' => 'required|in_list[Baik,Renovasi,Rusak]',
        'idlokasi' => 'required|integer',
        'idkelompok' => 'required|integer',
        'nilaiaset' => 'required|numeric',
    ])) {
        $this->dataasetModel->save([
            'kodeaset' => $this->request->getPost('kodeaset'),
            'idbarang' => $this->request->getPost('idbarang'),
            'namaaset' => $barangModel->find($this->request->getPost('idbarang'))['namabarang'],
            'jumlah' => $this->request->getPost('jumlah'),
            'kondisi' => $this->request->getPost('kondisi'),
            'idlokasi' => $this->request->getPost('idlokasi'),
            'idkelompok' => $this->request->getPost('idkelompok'),
            'nilaiaset' => $this->request->getPost('nilaiaset'),
        ]);
        session()->setFlashdata('sukses', 'Data Aset berhasil ditambahkan.');
        return redirect()->to(base_url('admin/dataaset'));
    }

    $data = [
        'title' => 'Tambah Data Aset',
        'barang' => $barang, // Kirim data barang ke view
        'lokasi' => $lokasi, // Kirim data lokasi ke view
        'kelompok' => $kelompok, // Kirim data kelompok ke view
        'content' => 'admin/dataaset/add',
        'validation' => $this->validator,
    ];

    echo view('admin/layout/wrapper', $data);
}

    public function edit($id)
    {
        checklogin();

        $dataaset = $this->dataasetModel->find($id);

        if (!$dataaset) {
            session()->setFlashdata('error', 'Data Aset tidak ditemukan.');
            return redirect()->to(base_url('admin/dataaset'));
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodeaset' => 'required|max_length[50]',
            'idbarang' => 'required|integer',
            'jumlah' => 'required',
            'kondisi' => 'required|in_list[Baik,Renovasi,Rusak]',
            'idlokasi' => 'required|integer',
            'idkelompok' => 'required|integer',
            'nilaiaset' => 'required|numeric',
        ])) {
            $this->dataasetModel->update($id, [
                'kodeaset' => $this->request->getPost('kodeaset'),
                'idbarang' => $this->request->getPost('idbarang'),
                'namaaset' => $this->barangModel->find($this->request->getPost('idbarang'))['namabarang'],
                'jumlah' => $this->request->getPost('jumlah'),
                'kondisi' => $this->request->getPost('kondisi'),
                'idlokasi' => $this->request->getPost('idlokasi'),
                'idkelompok' => $this->request->getPost('idkelompok'),
                'nilaiaset' => $this->request->getPost('nilaiaset'),
            ]);
            session()->setFlashdata('sukses', 'Data Aset berhasil diperbarui.');
            return redirect()->to(base_url('admin/dataaset'));
        }

        $data = [
            'title' => 'Edit Data Aset',
            'dataaset' => $dataaset,
            'barang' => $this->barangModel->findAll(),
            'lokasi' => $this->lokasiModel->findAll(),
            'kelompok' => $this->kelompokModel->findAll(),
            'content' => 'admin/dataaset/edit',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function update($id)
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodeaset' => 'required|max_length[50]',
            'idbarang' => 'required|integer',
            'jumlah' => 'required',
            'kondisi' => 'required|in_list[Baik,Renovasi,Rusak]',
            'idlokasi' => 'required|integer',
            'idkelompok' => 'required|integer',
            'nilaiaset' => 'required|numeric',
        ])) {
            $this->dataasetModel->update($id, [
                'kodeaset' => $this->request->getPost('kodeaset'),
                'idbarang' => $this->request->getPost('idbarang'),
                'namaaset' => $this->barangModel->find($this->request->getPost('idbarang'))['namabarang'],
                'jumlah' => $this->request->getPost('jumlah'),
                'kondisi' => $this->request->getPost('kondisi'),
                'idlokasi' => $this->request->getPost('idlokasi'),
                'idkelompok' => $this->request->getPost('idkelompok'),
                'nilaiaset' => $this->request->getPost('nilaiaset'),
            ]);
            session()->setFlashdata('sukses', 'Data Aset berhasil diperbarui.');
            return redirect()->to(base_url('admin/dataaset'));
        }

        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    public function delete($id)
    {
        checklogin();

        if ($this->dataasetModel->find($id)) {
            $this->dataasetModel->delete($id);
            session()->setFlashdata('sukses', 'Data Aset berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data Aset tidak ditemukan.');
        }

        return redirect()->to(base_url('admin/dataaset'));
    }
}