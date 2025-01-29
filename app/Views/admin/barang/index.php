<?php include 'tambah.php'; ?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Kode Kategori</th>
            <th width="25%">Nama Barang</th>
            <th width="10%">Tahun Perolehan</th>
            <th width="15%">Merk</th>
            <th width="15%">Tanggal Dibuat</th>
            <th width="15%">Tanggal Diperbarui</th>
            <th width="15%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($barang as $item) { ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['kodekategori'] ?></td> <!-- Menampilkan kode kategori -->
            <td><?= $item['namabarang'] ?></td>
            <td><?= $item['tahunperolehan'] ?></td>
            <td><?= $item['merk'] ?></td>
            <td><?= $item['created_at'] ?></td>
            <td><?= $item['updated_at'] ?></td>
            <td>
                <a href="<?= base_url('admin/barang/edit/' . $item['idbarang']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/barang/delete/' . $item['idbarang']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>
