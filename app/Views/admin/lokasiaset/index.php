<?php include 'tambah.php'; ?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="85%">Nama Lokasi</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($lokasiaset as $item) { ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['namalokasi'] ?></td>
            <td>
                <a href="<?= base_url('admin/lokasiaset/edit/' . $item['idlokasi']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/lokasiaset/delete/' . $item['idlokasi']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>

<script>
function confirmation(event) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        event.preventDefault();
    }
}
</script>