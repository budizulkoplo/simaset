<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Pengadaan_model;
use App\Models\Barang_model;
use App\Models\Lokasiaset_model;

class Pengadaan extends BaseController
{
    protected $pengadaanModel;
    protected $barangModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->pengadaanModel = new Pengadaan_model();
        $this->barangModel = new Barang_model();
        $this->lokasiModel = new Lokasiaset_model();
    }

    public function index()
    {
        checklogin();

        $data = [
            'title' => 'Manajemen Pengadaan',
            'pengadaan' => $this->pengadaanModel->getPengadaanWithRelations(),
            'content' => 'admin/pengadaan/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function create()
    {
        checklogin();

        $lokasiModel = new \App\Models\Lokasiaset_model();
        $lokasi = $lokasiModel->findAll();
        $barangModel = new \App\Models\Barang_model();
        $barang = $barangModel->findAll();

        $data = [
            'title' => 'Manajemen Pengadaan',
            'barang' => $barang, 
            'lokasi' => $lokasi, 
            'pengadaan' => $this->pengadaanModel->findAll(),
            'content' => 'admin/pengadaan/tambah',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function add()
{
    checklogin();

    if ($this->request->getMethod() === 'post' && $this->validate([
        'idlokasi' => 'required|integer',
        'idbarang' => 'required',
        'jumlah' => 'required',
        'nilaiaset' => 'required|numeric',
    ])) {
        $this->pengadaanModel->save([
            'idlokasi' => $this->request->getPost('idlokasi'),
            'idbarang' => $this->request->getPost('idbarang'),
            'namaaset' => $this->barangModel->find($this->request->getPost('idbarang'))['namabarang'],
            'jumlah' => $this->request->getPost('jumlah'),
            'nilaiaset' => $this->request->getPost('nilaiaset'),
            'user' => session()->get('username'), // Mengambil username dari session
        ]);
        session()->setFlashdata('sukses', 'Data Pengadaan berhasil ditambahkan.');
        return redirect()->to(base_url('admin/pengadaan'));
    }

    $data = [
        'title' => 'Tambah Pengadaan',
        'barang' => $this->barangModel->findAll(),
        'lokasi' => $this->lokasiModel->findAll(),
        'content' => 'admin/pengadaan/add',
        'validation' => $this->validator,
    ];

    echo view('admin/layout/wrapper', $data);
}


    public function edit($id)
    {
        checklogin();

        $pengadaan = $this->pengadaanModel->find($id);

        if (!$pengadaan) {
            session()->setFlashdata('error', 'Data Pengadaan tidak ditemukan.');
            return redirect()->to(base_url('admin/pengadaan'));
        }

        $data = [
            'title' => 'Edit Pengadaan',
            'pengadaan' => $pengadaan,
            'barang' => $this->barangModel->findAll(),
            'lokasi' => $this->lokasiModel->findAll(),
            'content' => 'admin/pengadaan/edit',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function update($id)
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'idlokasi' => 'required|integer',
            'idbarang' => 'required',
            'jumlah' => 'required',
            'nilaiaset' => 'required|numeric',
            'user' => 'required|max_length[100]',
        ])) {
            $this->pengadaanModel->update($id, [
                'idlokasi' => $this->request->getPost('idlokasi'),
                'idbarang' => $this->request->getPost('idbarang'),
                'namaaset' => $this->barangModel->find($this->request->getPost('idbarang'))['namabarang'],
                'jumlah' => $this->request->getPost('jumlah'),
                'nilaiaset' => $this->request->getPost('nilaiaset'),
                'user' => session()->get('username'), // Mengambil username dari session
            ]);
            session()->setFlashdata('sukses', 'Data Pengadaan berhasil diperbarui.');
            return redirect()->to(base_url('admin/pengadaan'));
        }

        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    public function delete($id)
    {
        checklogin();

        if ($this->pengadaanModel->find($id)) {
            $this->pengadaanModel->delete($id);
            session()->setFlashdata('sukses', 'Data Pengadaan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data Pengadaan tidak ditemukan.');
        }

        return redirect()->to(base_url('admin/pengadaan'));
    }

    public function update_status()
{
    $input = json_decode(file_get_contents('php://input'), true);
    $idpengadaan = $input['idpengadaan'];
    $status = $input['status'];

    // Update status di tabel pengadaan
    $this->pengadaanModel->update($idpengadaan, ['status' => $status]);

    // Jika status disetujui, update jumlah di tabel dataaset
    if ($status === 'Disetujui') {
        $pengadaan = $this->pengadaanModel->find($idpengadaan);

        if ($pengadaan) {
            $dataasetModel = new \App\Models\Dataaset_model();

            $dataaset = $dataasetModel->where('idbarang', $pengadaan['idbarang'])->first();
            if ($dataaset) {
                $dataasetModel->update($dataaset['id'], [
                    'jumlah' => $dataaset['jumlah'] + $pengadaan['jumlah']
                ]);
            }
        }
    }

    return $this->response->setJSON(['status' => 'success', 'message' => 'Status berhasil diperbarui.']);
}

}