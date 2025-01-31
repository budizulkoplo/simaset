<div class="container-fluid">
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
