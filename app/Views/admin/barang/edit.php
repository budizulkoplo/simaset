<div class="container">
    <h3>Edit Barang</h3>

    <?= form_open(base_url('admin/barang/update/' . $barang['idbarang'])); ?>
    <?= csrf_field(); ?>

    <!-- Input untuk Kategori Barang -->
    <div class="form-group row">
        <label for="idkategoribarang" class="col-3 col-form-label">Kategori Barang</label>
        <div class="col-9">
            <select name="idkategoribarang" id="idkategoribarang" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategori_barang as $kategori) : ?>
                    <option value="<?= $kategori['idkategoribarang'] ?>" <?= ($kategori['idkategoribarang'] == $barang['idkategoribarang']) ? 'selected' : '' ?>>
                        <?= $kategori['kodekategori'] . ' - ' . $kategori['namakategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Input untuk Nama Barang -->
    <div class="form-group row">
        <label for="namabarang" class="col-3 col-form-label">Nama Barang</label>
        <div class="col-9">
            <input type="text" id="namabarang" name="namabarang" class="form-control" placeholder="Nama Barang" value="<?= set_value('namabarang', $barang['namabarang']) ?>" required>
        </div>
    </div>

    <!-- Input untuk Tahun Perolehan -->
    <div class="form-group row">
        <label for="tahunperolehan" class="col-3 col-form-label">Tahun Perolehan</label>
        <div class="col-9">
            <input type="text" id="tahunperolehan" name="tahunperolehan" class="form-control" placeholder="Tahun Perolehan (contoh: 2023)" value="<?= set_value('tahunperolehan', $barang['tahunperolehan']) ?>" required>
        </div>
    </div>

    <!-- Input untuk Merk -->
    <div class="form-group row">
        <label for="merk" class="col-3 col-form-label">Merk</label>
        <div class="col-9">
            <input type="text" id="merk" name="merk" class="form-control" placeholder="Merk Barang" value="<?= set_value('merk', $barang['merk']) ?>" required>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/barang') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>