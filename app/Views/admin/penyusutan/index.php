<table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Kode Aset</th>
                            <th width="15%">Nama Aset</th>
                            <th width="10%">Tahun Perolehan</th>
                            <th width="10%">Nilai Aset</th>
                            <th width="10%">Masa Manfaat</th>
                            <th width="10%">Lama Pemakaian</th>
                            <th width="10%">% Penyusutan</th>
                            <th width="10%">Nilai Penyusutan</th>
                            <th width="10%">Nilai Aset Setelah Penyusutan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php $no = 1; foreach ($penyusutan as $item) { ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= esc($item['kodeaset']) ?></td>
                            <td><?= esc($item['namaaset']) ?></td>
                            <td><?= esc($item['tahunperolehan']) ?></td>
                            <td>Rp. <?= number_format($item['nilaiaset'], 2) ?></td>
                            <td><?= esc($item['masamanfaat']) ?> Tahun</td>
                            <td><?= esc($item['lama_pemakaian']) ?> Tahun</td>
                            <td><?= esc($item['penyusutan']) ?> %</td>
                            <td>Rp. <?= number_format($item['nilai_penyusutan'], 2) ?></td>
                            <td>Rp. <?= number_format($item['nilaiaset_setelah_penyusutan'], 2) ?></td>
                            <td>
                                <a href="<?= base_url('admin/penyusutan/detail/' . $item['idaset']) ?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                               
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>
