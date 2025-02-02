<<<<<<< HEAD
<div class="container">
    <h3>Tambah Penghapusan</h3>

    <?= form_open(base_url('admin/penghapusan/store')); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label class="col-3 col-form-label">Kode Aset</label>
        <div class="col-9">
            <select name="kodeaset" id="kodeaset" class="form-control-sm select2" required>
                <option value="">Pilih Kode Aset</option>
                <?php foreach ($dataaset as $item) : ?>
                    <option value="<?= $item['kodeaset'] ?>" data-idaset="<?= $item['idaset'] ?>" data-namaaset="<?= $item['namaaset'] ?>" data-jumlah="<?= $item['jumlah'] ?>"><?= $item['kodeaset'] ?> | <?= $item['namaaset'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">ID Aset</label>
        <div class="col-9">
            <input type="text" name="idaset" id="idaset" class="form-control" readonly>
        </div>
    </div>
=======
<?= $this->extend('admin/layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Penghapusan Aset</h1>

    <!-- Form Input -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Penghapusan Aset</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/penghapusan/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>Kode Aset</label>
                    <select name="kodeaset" id="kodeaset" class="form-control select2" required>
                        <option value="">Pilih Kode Aset</option>
                        <?php foreach ($dataaset as $aset) : ?>
                            <option value="<?= esc($aset['kodeaset']) ?>" data-namaaset="<?= esc($aset['namaaset']) ?>" data-jumlah="<?= esc($aset['jumlah']) ?>">
                                <?= esc($aset['kodeaset']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Aset</label>
                    <input type="text" name="namaaset" id="namaaset" class="form-control" readonly required>
                </div>

                <div class="form-group">
                    <label>Jumlah di Data Aset</label>
                    <input type="number" id="jumlah_aset" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Jumlah Dihapuskan</label>
                    <input type="number" name="jumlahdihapuskan" id="jumlahdihapuskan" class="form-control" required>
                    <small class="text-danger" id="jumlah_error" style="display: none;">Jumlah penghapusan tidak boleh melebihi jumlah aset.</small>
                </div>
>>>>>>> e0efae70898d06bb31a888fbe8771f6af83a3a30

    <div class="form-group row">
        <label class="col-3 col-form-label">Nama Aset</label>
        <div class="col-9">
            <input type="text" name="namaaset" id="namaaset" class="form-control" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Jumlah Dihapuskan</label>
        <div class="col-9">
            <input type="number" name="jumlahdihapuskan" id="jumlahdihapuskan" class="form-control" required>
            <small class="text-muted">Jumlah yang tersedia: <span id="jumlahTersedia">0</span></small>
        </div>
    </div>

<<<<<<< HEAD
    <div class="form-group row">
        <label class="col-3 col-form-label">Penyebab</label>
        <div class="col-9">
            <input type="text" name="penyebab" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3 col-form-label">Tanggal Penghapusan</label>
        <div class="col-9">
            <input type="date" name="tanggalhapus" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="<?= base_url('admin/penghapusan') ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?= form_close(); ?>
</div>

<!-- Load Select2 CSS dan JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi Select2
    $('#kodeaset').select2();

    // Event ketika kode aset dipilih
    $('#kodeaset').on('change', function () {
        const selectedOption = $(this).find(':selected');
        const idaset = selectedOption.data('idaset');
        const namaaset = selectedOption.data('namaaset');
        const jumlahTersedia = selectedOption.data('jumlah');

        // Isi field idaset dan namaaset
        $('#idaset').val(idaset);
        $('#namaaset').val(namaaset);
        $('#jumlahTersedia').text(jumlahTersedia);

        // Set max value untuk jumlah dihapuskan
        $('#jumlahdihapuskan').attr('max', jumlahTersedia);
    });

    // Validasi jumlah dihapuskan
    $('#jumlahdihapuskan').on('input', function () {
        const jumlahTersedia = parseInt($('#jumlahTersedia').text());
        const jumlahDihapuskan = parseInt($(this).val());

        if (jumlahDihapuskan > jumlahTersedia) {
            alert('Jumlah dihapuskan melebihi jumlah yang tersedia.');
            $(this).val(jumlahTersedia);
        }
    });
});
</script>
=======
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
                <a href="<?= base_url('admin/penghapusan') ?>" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>

<!-- Load Select2 CSS dan JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2();

        // Ketika kode aset dipilih
        $('#kodeaset').change(function() {
            var selectedOption = $(this).find('option:selected');
            var namaaset = selectedOption.data('namaaset');
            var jumlah = selectedOption.data('jumlah');

            // Isi nama aset dan jumlah aset
            $('#namaaset').val(namaaset);
            $('#jumlah_aset').val(jumlah);
        });

        // Validasi jumlah penghapusan
        $('#jumlahdihapuskan').on('input', function() {
            var jumlahAset = parseInt($('#jumlah_aset').val());
            var jumlahDihapuskan = parseInt($(this).val());

            if (jumlahDihapuskan > jumlahAset) {
                $('#jumlah_error').show();
                $(this).addClass('is-invalid');
            } else {
                $('#jumlah_error').hide();
                $(this).removeClass('is-invalid');
            }
        });
    });
</script>

<?= $this->endSection(); ?>
>>>>>>> e0efae70898d06bb31a888fbe8771f6af83a3a30
