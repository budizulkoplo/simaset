<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <style>
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form .form-control {
            max-width: 250px;
            display: inline-block;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Inisialisasi Yearpicker
            $("#tahunpengadaan").datepicker({
                dateFormat: "yy",
                changeYear: true,
                showButtonPanel: true,
                yearRange: "2000:<?= date('Y') ?>",
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).val(year);
                },
                beforeShow: function(input, inst) {
                    if ((datestr = $(this).val()).length > 4) {
                        year = datestr.substring(datestr.length - 4, datestr.length);
                        $(this).datepicker('option', 'defaultDate', new Date(year, 1, 1));
                        $(this).datepicker('setDate', new Date(year, 1, 1));
                    }
                }
            });

            // Hanya menampilkan tahun di input field
            $("#tahunpengadaan").focus(function() {
                $(".ui-datepicker-month").hide();
                $(".ui-datepicker-calendar").hide();
            });
        });

        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-3">Laporan Data Pengadaan</h3>

    <!-- Form Filter -->
    <form action="<?= base_url('admin/laporan/pengadaan') ?>" method="get" class="mb-3">
        <div class="row align-items-center">
            <div class="col-md-4">
                <label for="idlokasi" class="fw-bold">Lokasi:</label>
                <select name="idlokasi" id="idlokasi" class="form-control">
                    <option value="">Pilih Lokasi</option>
                    <?php foreach ($dataLokasi as $lokasi): ?>
                        <option value="<?= $lokasi['idlokasi'] ?>" <?= ($lokasi['idlokasi'] == $idlokasi) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($lokasi['namalokasi']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="tahunpengadaan" class="fw-bold">Tahun Pengadaan:</label>
                <input type="text" name="tahunpengadaan" id="tahunpengadaan" class="form-control" value="<?= $tahunpengadaan ?? '' ?>" placeholder="Pilih Tahun">
            </div>

            <div class="col-md-3 mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?= base_url('admin/laporan/pengadaan') ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data Pengadaan -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
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
</div>
</body>
</html>
