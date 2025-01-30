<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Data Aset
    </button>
</p>

<?= form_open(base_url('admin/dataaset/add')); ?>
<?= csrf_field(); ?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Aset Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-3">Kode Aset</label>
                    <div class="col-9">
                        <input type="text" name="kodeaset" class="form-control" placeholder="Kode Aset" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Barang</label>
                    <div class="col-9">
                        <select name="idbarang" class="form-control" required>
                            <option value="">Pilih Barang</option>
                            <?php foreach ($barang as $item) : ?>
                                <option value="<?= $item['idbarang'] ?>"><?= $item['namabarang'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Jumlah</label>
                    <div class="col-9">
                        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Kondisi</label>
                    <div class="col-9">
                        <select name="kondisi" class="form-control" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik">Baik</option>
                            <option value="Renovasi">Renovasi</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Lokasi</label>
                    <div class="col-9">
                        <select name="idlokasi" class="form-control" required>
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($lokasi as $item) : ?>
                                <option value="<?= $item['idlokasi'] ?>"><?= $item['namalokasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Kelompok</label>
                    <div class="col-9">
                        <select name="idkelompok" class="form-control" required>
                            <option value="">Pilih Kelompok</option>
                            <?php foreach ($kelompok as $item) : ?>
                                <option value="<?= $item['idkelompok'] ?>"><?= $item['kelompok'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Nilai Aset</label>
                    <div class="col-9">
                        <input type="text" name="nilaiaset" class="form-control" placeholder="Nilai Aset" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?= form_close(); ?>