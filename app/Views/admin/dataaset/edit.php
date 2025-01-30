<div class="container">
    <h3>Edit Data Aset</h3>

    <?= form_open(base_url('admin/dataaset/update/' . $dataaset['idaset'])); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label class="col-3">Kode Aset</label>
        <div class="col-9">
            <input type="text" name="kodeaset" class="form-control" placeholder="Kode Aset" value="<?= set_value('kodeaset', $dataaset['kodeaset']) ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Barang</label>
        <div class="col-9">
            <select name="idbarang" class="form-control" required>
                <option value="">Pilih Barang</option>
                <?php foreach ($barang as $item) : ?>
                    <option value="<?= $item['idbarang'] ?>" <?= ($item['idbarang'] == $dataaset['idbarang']) ? 'selected' : '' ?>><?= $item['namabarang'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Jumlah</label>
        <div class="col-9">
            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" value="<?= set_value('jumlah', $dataaset['jumlah']) ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Kondisi</label>
        <div class="col-9">
            <select name="kondisi" class="form-control" required>
                <option value="">Pilih Kondisi</option>
                <option value="Baik" <?= ($dataaset['kondisi'] == 'Baik') ? 'selected' : '' ?>>Baik</option>
                <option value="Renovasi" <?= ($dataaset['kondisi'] == 'Renovasi') ? 'selected' : '' ?>>Renovasi</option>
                <option value="Rusak" <?= ($dataaset['kondisi'] == 'Rusak') ? 'selected' : '' ?>>Rusak</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Lokasi</label>
        <div class="col-9">
            <select name="idlokasi" class="form-control" required>
                <option value="">Pilih Lokasi</option>
                <?php foreach ($lokasi as $item) : ?>
                    <option value="<?= $item['idlokasi'] ?>" <?= ($item['idlokasi'] == $dataaset['idlokasi']) ? 'selected' : '' ?>><?= $item['namalokasi'] ?></option>
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
                    <option value="<?= $item['idkelompok'] ?>" <?= ($item['idkelompok'] == $dataaset['idkelompok']) ? 'selected' : '' ?>><?= $item['kelompok'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Nilai Aset</label>
        <div class="col-9 input-group">
            <span class="input-group-text">Rp</span>
            <input type="text" name="nilaiaset" class="form-control" placeholder="Nilai Aset" value="<?= set_value('nilaiaset', $dataaset['nilaiaset']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/dataaset') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>