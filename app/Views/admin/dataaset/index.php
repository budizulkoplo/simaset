
<p>
    <a href="<?= base_url('admin/dataaset/create') ?>" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Tambah Aset Baru
    </a>
</p>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Kode Aset</th>
            <th width="20%">Nama Aset</th>
            <th width="10%">Jumlah</th>
            <th width="10%">Kondisi</th>
            <th width="10%">Lokasi</th>
            <th width="10%">Kelompok</th>
            <th width="10%">Nilai Aset</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($dataaset as $item) { ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['kodeaset'] ?></td>
            <td><?= $item['namaaset'] ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td><?= $item['kondisi'] ?></td>
            <td><?= $item['namalokasi'] ?></td>
            <td><?= $item['kelompok'] ?></td>
            <td>Rp. <?= number_format($item['nilaiaset'], 2) ?></td>
            <td>
                <a href="<?= base_url('admin/dataaset/edit/' . $item['idaset']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/dataaset/delete/' . $item['idaset']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
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