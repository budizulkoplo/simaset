
    <form action="<?= base_url('admin/penghapusan/store') ?>" method="post">
        <?= csrf_field() ?>
                <div class="form-group">
                    <label>Kode Aset</label>
                    <input type="text" name="kodeaset" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Aset</label>
                    <input type="text" name="namaaset" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Dihapuskan</label>
                    <input type="number" name="jumlahdihapuskan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Penyebab</label>
                    <textarea name="penyebab" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Tanggal Hapus</label>
                    <input type="date" name="tanggalhapus" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin/penghapusan') ?>" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
    </form>



