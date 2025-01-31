<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Penyusutan_model;
use App\Models\Barang_model;
use App\Models\Lokasiaset_model;

class Penyusutan extends BaseController
{
    protected $penyusutanModel;
    protected $barangModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->penyusutanModel = new Penyusutan_model();
        $this->barangModel = new Barang_model();
        $this->lokasiModel = new Lokasiaset_model();
    }

    public function index()
    {
        checklogin();


        $data = [
            'title' => 'Manajemen Penyusutan Aset',
            'penyusutan' => $this->penyusutanModel->getAsetWithPenyusutan(),
            'content' => 'admin/penyusutan/index', // Lokasi view
        ];

        echo view('admin/layout/wrapper', $data);

    }

    public function detail($id)
{
    checklogin();

    // Ambil data aset berdasarkan ID
    $asetList = $this->penyusutanModel->getAsetWithPenyusutan();
    $aset = array_values(array_filter($asetList, fn($item) => $item['idaset'] == $id));

    if (empty($aset)) {
        session()->setFlashdata('error', 'Data aset tidak ditemukan.');
        return redirect()->to(base_url('admin/penyusutan'));
    }

    // Ambil data aset pertama
    $aset = $aset[0];

    // Hitung penyusutan per tahun mulai dari tahun kedua
    $tahunSekarang = date('Y');
    $tahunPengadaan = $aset['tahunperolehan'];
    $nilaiAsetAwal = $aset['nilaiaset'];
    $penyusutanPerTahun = ($nilaiAsetAwal * ($aset['penyusutan'] / 100));

    $detailPenyusutan = [];
    $nilaiAset = $nilaiAsetAwal;
    $akumulasiPenyusutan = 0;

    for ($tahun = $tahunPengadaan; $tahun <= $tahunSekarang; $tahun++) {
        if ($tahun > $tahunPengadaan) { // Mulai penyusutan dari tahun kedua
            if ($akumulasiPenyusutan + $penyusutanPerTahun >= $nilaiAsetAwal) {
                $penyusutanPerTahun = $nilaiAsetAwal - $akumulasiPenyusutan;
                $nilaiAset = 0; // Nilai aset menjadi 0
            } else {
                $nilaiAset -= $penyusutanPerTahun;
            }

            $akumulasiPenyusutan += $penyusutanPerTahun;
        }

        // Simpan data penyusutan
        $detailPenyusutan[] = [
            'tahun' => $tahun,
            'penyusutan' => ($tahun > $tahunPengadaan) ? $penyusutanPerTahun : 0,
            'akumulasi_penyusutan' => $akumulasiPenyusutan,
            'nilai_aset' => max(0, $nilaiAset), // Pastikan tidak negatif
        ];

        // Jika nilai aset sudah habis, hentikan perulangan
        if ($nilaiAset <= 0) {
            break;
        }
    }

    $data = [
        'title' => 'Detail Penyusutan Aset',
        'aset' => $aset,
        'detailPenyusutan' => $detailPenyusutan,
        'content' => 'admin/penyusutan/detail',
    ];

    echo view('admin/layout/wrapper', $data);
}



}
?>