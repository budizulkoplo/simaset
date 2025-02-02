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