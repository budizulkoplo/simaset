<div class="container">
    <h3>Tambah Data Aset Baru</h3>

    <?= form_open(base_url('admin/dataaset/add')); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kode Aset</label>
        <div class="col-9">
            <input type="text" name="kodeaset" class="form-control" placeholder="Kode Aset" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Barang</label>
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
        <label class="col-3 col-form-label">Jumlah</label>
        <div class="col-9">
            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kondisi</label>
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
        <label class="col-3 col-form-label">Lokasi</label>
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
        <label class="col-3 col-form-label">Kelompok</label>
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
        <label class="col-3 col-form-label">Nilai Aset</label>
        <div class="col-9 input-group">
            <span class="input-group-text">Rp</span>
            <input type="text" name="nilaiaset" class="form-control" placeholder="Nilai Aset" required>
                        
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="<?= base_url('admin/dataaset') ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
