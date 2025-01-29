<?php include 'tambah.php'; ?>

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="15%">Kode Kategori</th>
			<th width="35%">Nama Kategori</th>
			<th width="15%">Tanggal Dibuat</th>
			<th width="15%">Tanggal Diperbarui</th>
			<th width="15%">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; foreach ($kategoribarang as $kategori) { ?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $kategori['kodekategori'] ?></td>
			<td><?= $kategori['namakategori'] ?></td>
			<td><?= $kategori['created_at'] ?></td>
			<td><?= $kategori['updated_at'] ?></td>
			<td>
				<a href="<?= base_url('admin/kategoribarang/edit/' . $kategori['idkategoribarang']) ?>" class="btn btn-success btn-sm">
					<i class="fa fa-edit"></i>
				</a>
				<a href="<?= base_url('admin/kategoribarang/delete/' . $kategori['idkategoribarang']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
