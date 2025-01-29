<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Barang
    </button>
</p>

<?= form_open(base_url('admin/barang/add')); ?>
<?= csrf_field(); ?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <label class="col-3">Kategori Barang</label>
                    <div class="col-9">
                        <select name="idkategoribarang" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategoribarang as $kategori) : ?>
                                <option value="<?= $kategori['idkategoribarang'] ?>">
                                    <?= $kategori['kodekategori'] . ' - ' . $kategori['namakategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Nama Barang</label>
                    <div class="col-9">
                        <input type="text" name="namabarang" class="form-control" placeholder="Nama Barang" value="<?= set_value('namabarang') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Tahun Perolehan</label>
                    <div class="col-9">
                        <input type="text" name="tahunperolehan" class="form-control" placeholder="Tahun Perolehan (contoh: 2023)" value="<?= set_value('tahunperolehan') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Merk</label>
                    <div class="col-9">
                        <input type="text" name="merk" class="form-control" placeholder="Merk Barang" value="<?= set_value('merk') ?>" required>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Tutup
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<?= form_close(); ?>
