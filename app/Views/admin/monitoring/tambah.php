<div class="container">
    <h3>Tambah Monitoring</h3>

    <?= form_open(base_url('admin/monitoring/add')); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kode Aset</label>
        <div class="col-9">
            <select name="kodeaset" class="form-control" required>
                <option value="">Pilih Kode Aset</option>
                <?php foreach ($dataaset as $item) : ?>
                    <option value="<?= $item['kodeaset'] ?>"><?= $item['kodeaset'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kerusakan</label>
        <div class="col-9">
            <input type="text" name="kerusakan" class="form-control konten" placeholder="Kerusakan">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Akibat Kerusakan</label>
        <div class="col-9">
            <input type="text" name="akibatkerusakan" class="form-control konten" placeholder="Akibat Kerusakan">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Faktor Pengaruh</label>
        <div class="col-9">
            <input type="text" name="faktorpengaruh" class="form-control konten" placeholder="Faktor Pengaruh">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Monitoring</label>
        <div class="col-9">
            <input type="text" name="monitoring" class="form-control konten" placeholder="Monitoring">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Langkah Perbaikan</label>
        <div class="col-9">
            <input type="text" name="langkahperbaikan" class="form-control konten" placeholder="Langkah Perbaikan">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Jumlah Kerusakan</label>
        <div class="col-9">
            <input type="number" name="jumlahkerusakan" class="form-control" placeholder="Jumlah Kerusakan">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="<?= base_url('admin/monitoring') ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?= form_close(); ?>
</div>