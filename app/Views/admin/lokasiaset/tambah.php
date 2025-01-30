<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Lokasi Aset
    </button>
</p>

<?= form_open(base_url('admin/lokasiaset/add')); ?>
<?= csrf_field(); ?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Lokasi Aset Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="namalokasi">Nama Lokasi</label>
                    <input type="text" id="namalokasi" name="namalokasi" class="form-control" placeholder="Nama Lokasi" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?= form_close(); ?>