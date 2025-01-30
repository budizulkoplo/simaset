<div class="container">
    <h3>Edit Monitoring</h3>

    <?= form_open(base_url('admin/monitoring/update/' . $monitoring['idmonitoring'])); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kode Aset</label>
        <div class="col-9">
            <select name="kodeaset" class="form-control" required>
                <option value="">Pilih Kode Aset</option>
                <?php foreach ($dataaset as $item) : ?>
                    <option value="<?= $item['kodeaset'] ?>" <?= ($item['kodeaset'] == $monitoring['kodeaset']) ? 'selected' : '' ?>><?= $item['kodeaset'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kerusakan</label>
        <div class="col-9">
            <input type="text" name="kerusakan" class="form-control" placeholder="Kerusakan" value="<?= set_value('kerusakan', $monitoring['kerusakan']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Akibat Kerusakan</label>
        <div class="col-9">
            <input type="text" name="akibatkerusakan" class="form-control" placeholder="Akibat Kerusakan" value="<?= set_value('akibatkerusakan', $monitoring['akibatkerusakan']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Faktor Pengaruh</label>
        <div class="col-9">
            <input type="text" name="faktorpengaruh" class="form-control" placeholder="Faktor Pengaruh" value="<?= set_value('faktorpengaruh', $monitoring['faktorpengaruh']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Monitoring</label>
        <div class="col-9">
            <input type="text" name="monitoring" class="form-control" placeholder="Monitoring" value="<?= set_value('monitoring', $monitoring['monitoring']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Langkah Perbaikan</label>
        <div class="col-9">
            <input type="text" name="langkahperbaikan" class="form-control" placeholder="Langkah Perbaikan" value="<?= set_value('langkahperbaikan', $monitoring['langkahperbaikan']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Jumlah Kerusakan</label>
        <div class="col-9">
            <input type="number" name="jumlahkerusakan" class="form-control" placeholder="Jumlah Kerusakan" value="<?= set_value('jumlahkerusakan', $monitoring['jumlahkerusakan']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Perubahan
            </button>
            <a href="<?= base_url('admin/monitoring') ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?= form_close(); ?>
</div>