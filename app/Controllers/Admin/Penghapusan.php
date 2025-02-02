<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Penghapusan_model;
use App\Models\Dataaset_model;

class Penghapusan extends BaseController
{
    protected $penghapusanModel;

    public function __construct()
    {
        $this->penghapusanModel = new Penghapusan_model();
        $this->dataasetModel = new Dataaset_model();
    }

    public function index()
    {
        checklogin();

        $data = [
            'title' => 'Manajemen Penghapusan Aset',
            'penghapusan' => $this->penghapusanModel->getPenghapusanWithAset(),
            'content' => 'admin/penghapusan/index',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function add()
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodeaset' => 'required',
            'jumlahdihapuskan' => 'required|integer',
            'penyebab' => 'required',
            'tanggalhapus' => 'required|valid_date',
        ])) {
            // Ambil data aset berdasarkan kodeaset
            $kodeaset = $this->request->getPost('kodeaset');
            $dataaset = $this->dataasetModel->where('kodeaset', $kodeaset)->first();

            if (!$dataaset) {
                session()->setFlashdata('error', 'Kode Aset tidak ditemukan.');
                return redirect()->back()->withInput();
            }

            // Cek apakah jumlah dihapuskan melebihi jumlah yang tersedia
            $jumlahdihapuskan = $this->request->getPost('jumlahdihapuskan');
            if ($jumlahdihapuskan > $dataaset['jumlah']) {
                session()->setFlashdata('error', 'Jumlah dihapuskan melebihi jumlah yang tersedia.');
                return redirect()->back()->withInput();
            }
        }

        $data = [
            'title' => 'Tambah Penghapusan',
            'dataaset' => $this->dataasetModel->findAll(),
            'content' => 'admin/penghapusan/tambah',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function store()
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'kodeaset' => 'required',
            'jumlahdihapuskan' => 'required|integer',
            'penyebab' => 'required',
            'tanggalhapus' => 'required|valid_date',
        ])) {
            // Ambil data aset berdasarkan kodeaset
            $kodeaset = $this->request->getPost('kodeaset');
            $dataaset = $this->dataasetModel->where('kodeaset', $kodeaset)->first();

            if (!$dataaset) {
                session()->setFlashdata('error', 'Kode Aset tidak ditemukan.');
                return redirect()->back()->withInput();
            }

            // Cek apakah jumlah dihapuskan melebihi jumlah yang tersedia
            $jumlahdihapuskan = $this->request->getPost('jumlahdihapuskan');
            if ($jumlahdihapuskan > $dataaset['jumlah']) {
                session()->setFlashdata('error', 'Jumlah dihapuskan melebihi jumlah yang tersedia.');
                return redirect()->back()->withInput();
            }

            // Simpan data penghapusan
            $this->penghapusanModel->save([
                'idaset' => $dataaset['idaset'],
                'kodeaset' => $dataaset['kodeaset'],
                'namaaset' => $dataaset['namaaset'],
                'jumlahdihapuskan' => $jumlahdihapuskan,
                'penyebab' => $this->request->getPost('penyebab'),
                'tanggalhapus' => $this->request->getPost('tanggalhapus'),
            ]);

            // Kurangi jumlah aset di tabel dataaset
            $this->dataasetModel->update($dataaset['idaset'], [
                'jumlah' => $dataaset['jumlah'] - $jumlahdihapuskan,
            ]);

            session()->setFlashdata('sukses', 'Data Penghapusan berhasil ditambahkan.');
            return redirect()->to(base_url('admin/penghapusan'));
        }

        $data = [
            'title' => 'Tambah Penghapusan',
            'dataaset' => $this->dataasetModel->findAll(),
            'content' => 'admin/penghapusan/tambah',
            'validation' => $this->validator,
        ];

        echo view('admin/layout/wrapper', $data);
    }
    
    public function create()
    {
        checklogin();

        $data = [
            'title' => 'Tambah Penghapusan Aset',
            'content' => 'admin/penghapusan/tambah',
        ];

        echo view('admin/layout/wrapper', $data);
    }


    public function edit($id)
    {
        checklogin();

        $penghapusan = $this->penghapusanModel->getPenghapusanById($id);

        if (!$penghapusan) {
            session()->setFlashdata('error', 'Data penghapusan tidak ditemukan.');
            return redirect()->to(base_url('admin/penghapusan'));
        }

        $data = [
            'title' => 'Edit Penghapusan Aset',
            'penghapusan' => $penghapusan,
            'content' => 'admin/penghapusan/edit',
        ];

        echo view('admin/layout/wrapper', $data);
    }

    public function update($id)
    {
        checklogin();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'idaset' => 'required|integer',
            'kodeaset' => 'required|max_length[50]',
            'namaaset' => 'required|max_length[100]',
            'jumlahdihapuskan' => 'required|integer',
            'penyebab' => 'required|max_length[255]',
            'tanggalhapus' => 'required|valid_date',
        ])) {
            $this->penghapusanModel->updatePenghapusan($id, [
                'idaset' => $this->request->getPost('idaset'),
                'kodeaset' => $this->request->getPost('kodeaset'),
                'namaaset' => $this->request->getPost('namaaset'),
                'jumlahdihapuskan' => $this->request->getPost('jumlahdihapuskan'),
                'penyebab' => $this->request->getPost('penyebab'),
                'tanggalhapus' => $this->request->getPost('tanggalhapus'),
            ]);

            session()->setFlashdata('sukses', 'Data penghapusan berhasil diperbarui.');
            return redirect()->to(base_url('admin/penghapusan'));
        }

        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    public function delete($id)
    {
        checklogin();

        if ($this->penghapusanModel->getPenghapusanById($id)) {
            $this->penghapusanModel->hapusPenghapusan($id);
            session()->setFlashdata('sukses', 'Data penghapusan berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Data penghapusan tidak ditemukan.');
        }

        return redirect()->to(base_url('admin/penghapusan'));
    }
}
?>