<div class="container">
    <h3>Edit Pengadaan</h3>

    <?= form_open(base_url('admin/pengadaan/update/' . $pengadaan['idpengadaan'])); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label class="col-3">Lokasi</label>
        <div class="col-9">
            <select name="idlokasi" class="form-control" required>
                <option value="">Pilih Lokasi</option>
                <?php foreach ($lokasi as $item) : ?>
                    <option value="<?= $item['idlokasi'] ?>" <?= ($item['idlokasi'] == $pengadaan['idlokasi']) ? 'selected' : '' ?>><?= $item['namalokasi'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Barang</label>
        <div class="col-9">
            <select name="idbarang" class="form-control" required>
                <option value="">Pilih Barang</option>
                <?php foreach ($barang as $item) : ?>
                    <option value="<?= $item['idbarang'] ?>" <?= ($item['idbarang'] == $pengadaan['idbarang']) ? 'selected' : '' ?>><?= $item['namabarang'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Jumlah</label>
        <div class="col-9">
            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" value="<?= set_value('jumlah', $pengadaan['jumlah']) ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3">Nilai Aset</label>
        <div class="col-9">
            <input type="text" name="nilaiaset" class="form-control" placeholder="Nilai Aset" value="<?= set_value('nilaiaset', $pengadaan['nilaiaset']) ?>" required>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-3">User</label>
        <div class="col-9">
            <input type="text" name="user" class="form-control" placeholder="User" value="<?= set_value('user', $pengadaan['user']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/pengadaan') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>