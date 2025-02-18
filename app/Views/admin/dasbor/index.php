<?php 
$session = \Config\Services::session();
use App\Models\Dasbor_model;

$m_dasbor = new Dasbor_model();
?>
<div class="alert bg-lazis">
	<h4>Hai <em class="text-white"><?= $session->get('nama') ?></em></h4>
</div>


<div class="row">
  
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-lock"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pengguna Website</span>
        <span class="info-box-number"><?= angka($m_dasbor->user()) ?></span>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-md-3">
    <a href="<?= site_url('admin/laporan/aset') ?>" class="text-decoration-none">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-edit"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data Aset</span>
                <span class="info-box-number"><?= angka($m_dasbor->dataaset()) ?></span>
            </div>
        </div>
    </a>
</div>

<div class="col-12 col-sm-6 col-md-3">
    <a href="<?= site_url('admin/laporan/pengadaan') ?>" class="text-decoration-none">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data Pengadaan</span>
                <span class="info-box-number"><?= angka($m_dasbor->pengadaan()) ?></span>
            </div>
        </div>
    </a>
</div>


<div class="col-12 col-sm-6 col-md-3">
    <a href="<?= site_url('admin/laporan/penghapusan') ?>" class="text-decoration-none">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-trash"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data Penghapusan</span>
                <span class="info-box-number"><?= angka($m_dasbor->penghapusan()) ?></span>
            </div>
        </div>
    </a>
</div>

  
    <!-- /.card -->
  
</div>






