<?php 
use App\Models\Konfigurasi_model;

$session = \Config\Services::session();
$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();
$username = $session->get('nama');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <style>
    body {
        font-family: Arial, sans-serif;
    }

    /* Header Laporan */
    .print-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        position: relative;
    }

    .print-header img {
        width: 80px;
        height: auto;
        position: absolute;
        left: 0;
    }

    .header-text {
        width: 100%;
        text-align: center;
    }

    .header-text h2 {
        margin: 5px 0;
        font-size: 22px;
    }

    .header-text h4 {
        margin: 5px 0;
        font-size: 16px;
        font-weight: normal;
    }

    /* Tabel */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #000;
    }

    th, td {
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f0f0f0;
    }

    /* Form Filter */
    .filter-form {
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 8px;
    }

    .form-control {
        padding: 8px;
        font-size: 14px;
        width: 250px;
        margin-right: 10px;
    }

    .btn {
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    /* Media Print: Hanya Cetak Laporan */
    @media print {
        .filter-form,
        .btn-print,
        .btn,
        footer {
            display: none;
        }

        .print-header img {
            width: 60px;
        }

        .print-header h2 {
            font-size: 20px;
        }

        body {
            font-size: 12px;
        }
    }
</style>

    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>

    <!-- Header Laporan -->
    <div class="print-header">
        <img src="<?php echo base_url('assets/upload/image/'.$site['icon']) ?>" alt="Logo">
        <div class="header-text">
            <h2><?php echo $site['singkatan'] ?></h2>
            <h4>Laporan Data Pengadaan</h4>
            <!-- <p>Periode Tahun: <?= htmlspecialchars($tahunpengadaan ?? 'Semua Tahun') ?></p> -->
        </div>
    </div>

    <!-- Tabel Data Pengadaan -->
    <div class="table-responsive">
        <table id="tabel-pengadaan" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Aset</th>
                    <th>Lokasi</th>
                    <th>Tahun Pengadaan</th>
                    <th>Jumlah</th>
                    <th>Nilai Aset</th>
                    <th>User</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Aset</td>
                    <td>Lokasi</td>
                    <td>Tahun Pengadaan</td>
                    <td>Jumlah</td>
                    <td>Nilai Aset</td>
                    <td>User</td>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>No</td>
                    <td>Nama Aset</td>
                    <td>Lokasi</td>
                    <td>Tahun Pengadaan</td>
                    <td>Jumlah</td>
                    <td>Nilai Aset</td>
                    <td>User</td>
                </tr>
            </tfoot>
            <tbody>
                <?php if (!empty($dataPengadaan)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dataPengadaan as $pengadaan): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($pengadaan['namaaset']) ?></td>
                            <td><?= htmlspecialchars($pengadaan['namalokasi']) ?></td>
                            <td><?= date('Y', strtotime($pengadaan['created_at'])) ?></td>
                            <td><?= htmlspecialchars($pengadaan['jumlah']) ?></td>
                            <td>Rp. <?= number_format($pengadaan['nilaiaset'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($pengadaan['user']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pengadaan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<script>
    $(document).ready(function() {
        // Tambahkan input filter di header setiap kolom
        $('#tabel-pengadaan thead th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" style="width:100%;" />');
        });

        // Inisialisasi DataTables tanpa paging
        var table = $('#tabel-pengadaan').DataTable({
            paging: false, // Nonaktifkan Paging
            ordering: true,
            info: true,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
            },
            initComplete: function () {
                // Terapkan filter per kolom
                this.api().columns().every(function() {
                    var that = this;
                    $('input', this.header()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            }
        });
    });
</script>
