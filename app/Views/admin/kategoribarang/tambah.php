<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Kategori Barang
	</button>
</p>
<?= form_open(base_url('admin/kategoribarang/add')); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Kategori Barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">Kode Kategori</label>
					<div class="col-9">
						<input type="text" name="kodekategori" class="form-control" placeholder="Kode Kategori" value="<?= set_value('kodekategori') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Kategori</label>
					<div class="col-9">
						<input type="text" name="namakategori" class="form-control" placeholder="Nama Kategori" value="<?= set_value('namakategori') ?>" required>
					</div>
				</div>

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= form_close(); ?>
