<p>
    <a href="<?= base_url('admin/pengadaan/create') ?>" class="btn btn-success mb-3">
        <i class="fa fa-plus"></i> Pengajuan Pengadaan
    </a>
</p>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Lokasi</th>
            <th width="15%">Barang</th>
            <th width="10%">Jumlah</th>
            <th width="10%">Nilai Aset</th>
            <th width="10%">User</th>
            <th width="10%">Status</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($pengadaan as $item) { ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['namalokasi'] ?></td>
            <td><?= $item['namaaset'] ?></td>
            <td><?= $item['jumlah'] ?></td>
            <td>Rp. <?= number_format($item['nilaiaset'], 2) ?></td>
            <td><?= $item['user'] ?></td>
            <td>
                <select class="form-control status-dropdown" data-id="<?= $item['idpengadaan'] ?>">
                    <option value="Pending" <?= $item['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Ditolak" <?= $item['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    <option value="Disetujui" <?= $item['status'] == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                </select>
            </td>
            <td>
                <a href="<?= base_url('admin/pengadaan/edit/' . $item['idpengadaan']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="<?= base_url('admin/pengadaan/delete/' . $item['idpengadaan']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
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

// AJAX untuk Update Status
document.querySelectorAll('.status-dropdown').forEach(select => {
    select.addEventListener('change', function () {
        let idpengadaan = this.getAttribute('data-id');
        let status = this.value;

        fetch("<?= base_url('admin/pengadaan/update_status') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ idpengadaan, status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Status berhasil diperbarui!");
                location.reload();
            } else {
                alert("Gagal memperbarui status!");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
</script>
