<?php 
use App\Models\Konfigurasi_model;

$session = \Config\Services::session();
$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();
$username=$session->get('nama');
?>
<style>

    /* Header Laporan */
    .print-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        position: relative;
    }

    .print-header img {
        width: 80px;
        height: auto;
        position: absolute;
        left: 0;
    }

    .header-text {
        width: 100%;
        text-align: center;
    }

    .header-text h2 {
        margin: 5px 0;
        font-size: 22px;
    }

    .header-text h4 {
        margin: 5px 0;
        font-size: 16px;
        font-weight: normal;
    }

    /* Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #000;
    }

 

    th {
        background-color: #f0f0f0;
    }

    /* Form Filter */
    .filter-form {
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 8px;
    }

    .form-control {
        padding: 8px;
        font-size: 12pt;
        width: 250px;
        margin-right: 10px;
    }

    .btn {
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    /* Media Print: Hanya Cetak Laporan */
    @media print {
        .filter-form,
        .btn-print,
        .btn,
        footer {
            display: none;
        }

        .print-header img {
            width: 60px;
        }

        .print-header h2 {
            font-size: 20px;
        }

        body {
            font-size: 12px;
        }
    }
</style>

    <script>
        function printPage() {
            window.print();
        }
    </script>

    

    <div class="container-fluid">
        <!-- Header Laporan -->
            <div class="print-header">
            <img src="<?php echo base_url('assets/upload/image/'.$site['icon']) ?>" alt="Logo">
            <div class="header-text">
                <h2><?php echo $site['singkatan'] ?></h2>
                <h4>Data Penyusutan</h4>
                
            </div>
        </div>
        <hr>
    <!-- Informasi Aset -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Aset</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Kode Aset:</strong> <?= esc($aset['kodeaset']) ?></p>
                    <p><strong>Nama Aset:</strong> <?= esc($aset['namaaset']) ?></p>
                    <p><strong>Jumlah:</strong> <?= esc($aset['jumlah']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Nilai Aset Awal:</strong> Rp. <?= number_format($aset['nilaiaset'], 2) ?></p>
                    <p><strong>Tahun Perolehan:</strong> <?= esc($aset['tahunperolehan']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Detail Penyusutan Per Tahun -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Penyusutan Per Tahun</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Penyusutan (Rp)</th>
                            <th>Akumulasi Penyusutan (Rp)</th>
                            <th>Nilai Aset Setelah Penyusutan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailPenyusutan as $detail) { ?>
                        <tr>
                            <td><?= esc($detail['tahun']) ?></td>
                            <td>Rp. <?= number_format($detail['penyusutan'], 2) ?></td>
                            <td>Rp. <?= number_format($detail['akumulasi_penyusutan'], 2) ?></td>
                            <td>Rp. <?= number_format($detail['nilai_aset'], 2) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="<?= base_url('admin/penyusutan') ?>" class="btn btn-secondary mb-4">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>
</div>
