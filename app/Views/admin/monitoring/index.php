<p>
    <a href="<?= base_url('admin/monitoring/create') ?>" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Input Monitoring
    </a>
</p>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Kode Aset</th>
            <th width="15%">Kerusakan</th>
            <th width="10%">Akibat Kerusakan</th>
            <th width="10%">Faktor Pengaruh</th>
            <th width="10%">Monitoring</th>
            <th width="10%">Langkah Perbaikan</th>
            <th width="10%">Jumlah Kerusakan</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($monitoring as $item) { ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['kodeaset'] ?></td>
            <td><?= $item['kerusakan'] ?></td>
            <td><?= $item['akibatkerusakan'] ?></td>
            <td><?= $item['faktorpengaruh'] ?></td>
            <td><?= $item['monitoring'] ?></td>
            <td><?= $item['langkahperbaikan'] ?></td>
            <td><?= $item['jumlahkerusakan'] ?></td>
            <td>
                <a href="<?= base_url('admin/monitoring/edit/' . $item['idmonitoring']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/monitoring/delete/' . $item['idmonitoring']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
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