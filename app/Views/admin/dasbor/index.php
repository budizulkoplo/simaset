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
  
    <!-- /.card -->
  
</div>






