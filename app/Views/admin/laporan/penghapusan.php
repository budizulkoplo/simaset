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
            // Inisialisasi Yearpicker (Pastikan jQuery UI sudah dimuat di template)
            $("#tahunhapus").datepicker({
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
            $("#tahunhapus").focus(function() {
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
    <!-- Form Filter -->
    <form action="<?= base_url('admin/laporan/penghapusan') ?>" method="get" class="mb-3">
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
                <label for="tahunhapus" class="fw-bold">Tahun Penghapusan:</label>
                <input type="text" name="tahunhapus" id="tahunhapus" class="form-control" value="<?= $tahunhapus ?? '' ?>" placeholder="Pilih Tahun">
            </div>

            <div class="col-md-3 mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?= base_url('admin/laporan/penghapusan') ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data Penghapusan -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Lokasi</th>
                    <th>Tahun Penghapusan</th>
                    <th>Jumlah Dihapus</th>
                    <th>Penyebab</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataPenghapusan)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dataPenghapusan as $hapus): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($hapus['kodeaset']) ?></td>
                            <td><?= htmlspecialchars($hapus['namaaset']) ?></td>
                            <td><?= htmlspecialchars($hapus['namalokasi']) ?></td>
                            <td><?= date('Y', strtotime($hapus['tanggalhapus'])) ?></td>
                            <td><?= htmlspecialchars($hapus['jumlahdihapuskan']) ?></td>
                            <td><?= htmlspecialchars($hapus['penyebab']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data penghapusan aset.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
