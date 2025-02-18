<?php 
use App\Models\Konfigurasi_model;

$session = \Config\Services::session();
$konfigurasi  = new Konfigurasi_model;
$site         = $konfigurasi->listing();
$username = $session->get('nama');
$tanggalCetak = date('d-m-Y');
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

        /* Sembunyikan input filter saat cetak */
        @media print {
            .dataTables_filter,
            .dataTables_length,
            .filter-form,
            .btn-print,
            .btn,
            .main-footer,
            .card-header,
            .card-title,
            .filter-input {
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

            /* Tampilkan judul kolom biasa saat cetak */
            .print-column-title {
                display: block !important;
            }
        }

        /* Sembunyikan judul kolom biasa saat tidak mencetak */
        .print-column-title {
            display: none;
        }
    </style>

    <script>
        function printPage() {
            // Tangkap nilai filter dari setiap kolom
            var filters = [];
            $('#tabel-pengadaan thead th').each(function(index) {
                var filterValue = $(this).find('input').val();
                if (filterValue) {
                    var columnTitle = $('#tabel-pengadaan thead th').eq(index).text();
                    filters.push(columnTitle + ': ' + filterValue);
                }
            });

            // Tampilkan informasi filter di laporan cetak
            if (filters.length > 0) {
                var filterInfo = 'Filter yang digunakan: ' + filters.join(', ');
                $('#filter-info').text(filterInfo).show();
            }

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
            <p>Jalan Rm Hadi Sobeno no 5 Lemah Mendak Mijen Semarang. Jawa Tengah<br>
            Kode POS: 52329 E Mail: berkahmandirikeramis@gmail.com</p>
        </div>
    </div>
    <hr>
    <p style="display: flex; justify-content: space-between;">
        <span>Perihal: Laporan Data Pengadaan</span>
        <span>Semarang, <?= $tanggalCetak ?></span>
    </p>

    <!-- Informasi Filter -->
    <p id="filter-info" style="display: none;"></p>

    <!-- Tabel Data Pengadaan -->
    <div class="table-responsive">
        <table id="tabel-pengadaan" class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        <div class="print-column-title">No</div>
                        <input type="text" placeholder="Cari No" class="filter-input" style="width:100%;" />
                    </th>
                    <th>
                        <div class="print-column-title">Nama Aset</div>
                        <input type="text" placeholder="Cari Nama Aset" class="filter-input" style="width:100%;" />
                    </th>
                    <th>
                        <div class="print-column-title">Lokasi</div>
                        <input type="text" placeholder="Cari Lokasi" class="filter-input" style="width:100%;" />
                    </th>
                    <th>
                        <div class="print-column-title">Tahun Pengadaan</div>
                        <input type="text" placeholder="Cari Tahun Pengadaan" class="filter-input" style="width:100%;" />
                    </th>
                    <th>
                        <div class="print-column-title">Jumlah</div>
                        <input type="text" placeholder="Cari Jumlah" class="filter-input" style="width:100%;" />
                    </th>
                    <th>
                        <div class="print-column-title">Nilai Aset</div>
                        <input type="text" placeholder="Cari Nilai Aset" class="filter-input" style="width:100%;" />
                    </th>
                    <th>
                        <div class="print-column-title">User</div>
                        <input type="text" placeholder="Cari User" class="filter-input" style="width:100%;" />
                    </th>
                </tr>
            </thead>
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
        <hr>
        <p>Dicetak oleh: <?= $username ?> pada <?= $tanggalCetak ?></p>
    </div>

</body>
</html>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables tanpa paging
        var table = $('#tabel-pengadaan').DataTable({
            paging: false, // Nonaktifkan Paging
            ordering: true,
            info: false, // Nonaktifkan info footer
            
            responsive: true,
            lengthChange: false, // Nonaktifkan "Show Entries"
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