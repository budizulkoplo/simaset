<div class="container">
    <h3>Edit Kategori Barang</h3>

    <?= form_open(base_url('admin/kategoribarang/update/' . $kategori['idkategoribarang'])); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label for="kodekategori" class="col-3 col-form-label">Kode Kategori</label>
        <div class="col-9">
            <input type="text" id="kodekategori" name="kodekategori" class="form-control" placeholder="Kode Kategori" value="<?= set_value('kodekategori', $kategori['kodekategori']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="namakategori" class="col-3 col-form-label">Nama Kategori</label>
        <div class="col-9">
            <input type="text" id="namakategori" name="namakategori" class="form-control" placeholder="Nama Kategori" value="<?= set_value('namakategori', $kategori['namakategori']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/kategoribarang') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
