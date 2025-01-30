<div class="container">
    <h3>Edit Lokasi Aset</h3>

    <?= form_open(base_url('admin/lokasiaset/update/' . $lokasiaset['idlokasi'])); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label for="namalokasi" class="col-3 col-form-label">Nama Lokasi</label>
        <div class="col-9">
            <input type="text" id="namalokasi" name="namalokasi" class="form-control" placeholder="Nama Lokasi" value="<?= set_value('namalokasi', $lokasiaset['namalokasi']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/lokasiaset') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>