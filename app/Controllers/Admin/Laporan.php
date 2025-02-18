<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WakafModel;

class Laporan extends BaseController
{
    public function aset()
{
    $m_aset = new \App\Models\Dataaset_model();
    $m_lokasi = new \App\Models\Lokasiaset_model();

    // Ambil input filter dari request
    $idlokasi = $this->request->getGet('idlokasi');
    $tahunpengadaan = $this->request->getGet('tahunpengadaan');

    // Query dasar dengan join ke tabel barang
    $query = $m_aset->select('dataaset.*, barang.tahunperolehan,barang.merk, lokasiaset.namalokasi')
        ->join('lokasiaset', 'lokasiaset.idlokasi = dataaset.idlokasi', 'left')
        ->join('barang', 'barang.idbarang = dataaset.idbarang', 'left'); // Join ke tabel barang

    // Tambahkan filter lokasi jika dipilih
    if (!empty($idlokasi)) {
        $query->where('dataaset.idlokasi', $idlokasi);
    }

    // Tambahkan filter tahun pengadaan jika dipilih
    if (!empty($tahunpengadaan)) {
        $query->where('barang.tahunperolehan', $tahunpengadaan);
    }

    // Ambil data aset
    $dataAset = $query->findAll();

    // Ambil data lokasi untuk dropdown filter
    $dataLokasi = $m_lokasi->findAll();

    // Kirim data ke view
    $data = [
        'title'         => 'Laporan Data Aset',
        'printstatus'   => 'print',
        'dataAset'      => $dataAset,
        'dataLokasi'    => $dataLokasi,
        'idlokasi'      => $idlokasi,
        'tahunpengadaan' => $tahunpengadaan,
        'content'       => 'admin/laporan/aset',
    ];

    return view('admin/layout/wrapper', $data);
}


public function pengadaan()
{
    $m_pengadaan = new \App\Models\Pengadaan_model();
    $m_lokasi = new \App\Models\Lokasiaset_model();

    // Ambil input filter dari request
    $idlokasi = $this->request->getGet('idlokasi');
    $tahunpengadaan = $this->request->getGet('tahunpengadaan');

    // Query dasar dengan join ke tabel barang
    $query = $m_pengadaan->select('pengadaan.*, barang.namabarang, lokasiaset.namalokasi')
        ->join('lokasiaset', 'lokasiaset.idlokasi = pengadaan.idlokasi', 'left')
        ->join('barang', 'barang.idbarang = pengadaan.idbarang', 'left'); // Join ke tabel barang

    // Tambahkan filter lokasi jika dipilih
    if (!empty($idlokasi)) {
        $query->where('pengadaan.idlokasi', $idlokasi);
    }

    // Tambahkan filter tahun pengadaan berdasarkan created_at jika dipilih
    if (!empty($tahunpengadaan)) {
        $query->where('YEAR(pengadaan.created_at)', $tahunpengadaan);
    }

    // Ambil data pengadaan
    $dataPengadaan = $query->findAll();

    // Ambil data lokasi untuk dropdown filter
    $dataLokasi = $m_lokasi->findAll();

    // Kirim data ke view
    $data = [
        'title'         => 'Laporan Data Pengadaan',
        'printstatus'   => 'print',
        'dataPengadaan' => $dataPengadaan,
        'dataLokasi'    => $dataLokasi,
        'idlokasi'      => $idlokasi,
        'tahunpengadaan' => $tahunpengadaan,
        'content'       => 'admin/laporan/pengadaan',
    ];

    return view('admin/layout/wrapper', $data);
}

public function penghapusan()
{
    $m_penghapusan = new \App\Models\Penghapusan_model();
    $m_lokasi = new \App\Models\Lokasiaset_model();

    // Ambil input filter dari request
    $idlokasi = $this->request->getGet('idlokasi');
    $tahunhapus = $this->request->getGet('tahunhapus');

    // Query dasar dengan join ke dataaset dan lokasiaset
    $query = $m_penghapusan
        ->select('penghapusan.*, lokasiaset.namalokasi, dataaset.idlokasi')
        ->join('dataaset', 'dataaset.idaset = penghapusan.idaset')
        ->join('lokasiaset', 'dataaset.idlokasi = lokasiaset.idlokasi');

    // Tambahkan filter lokasi jika dipilih
    if (!empty($idlokasi)) {
        $query->where('dataaset.idlokasi', $idlokasi);
    }

    // Tambahkan filter tahun penghapusan jika dipilih
    if (!empty($tahunhapus)) {
        $query->where('YEAR(penghapusan.tanggalhapus)', $tahunhapus);
    }


    // Ambil data penghapusan
    $dataPenghapusan = $query->findAll();

    // Ambil data lokasi untuk dropdown filter
    $dataLokasi = $m_lokasi->findAll();

    // Kirim data ke view
    $data = [
        'title'         => 'Laporan Data Penghapusan',
        'printstatus'   => 'print',
        'dataPenghapusan' => $dataPenghapusan,
        'dataLokasi'    => $dataLokasi,
        'idlokasi'      => $idlokasi,
        'tahunhapus'    => $tahunhapus,
        'content'       => 'admin/laporan/penghapusan',

    ];

    return view('admin/layout/wrapper', $data);
}




}
