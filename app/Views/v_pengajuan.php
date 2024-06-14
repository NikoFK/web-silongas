<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Pengajuan</h4>
                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                    <i class="fa fa-plus"></i>
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover" >
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Invoice</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $key => $row) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['nomor_rekening'] ?> | <?= $row['bank'] ?></td>
                            <td><?= $row['invoice'] ?></td>
                            <td><?= formatRupiah($row['total_harga']) ?></td>
                            <td> <span class="badge-danger"><?= $row['status'] ?></span></td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" onclick="showDetail(<?= $row['id_transaksi'] ?>)">
                                    Detail
                                </button>
                                <button class="btn btn-danger btn-sm alert_demo_hapus_transaksi" data-toggle="modal" data-target="#hapusModal" data-id="<?= $row['id_transaksi'] ?>">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                    Tambah</span> 
                    <span class="fw-light">
                        Data Pengajuan
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('pengajuan/pengajuan') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                            <label>Jenis Limbah</label>
                            <select id="jenisLimbah" name="jenis_limbah" class="form-control" required>
                                <option value="">Pilih Jenis Limbah</option>
                                <option value="Besi/Baja">Besi/Baja</option>
                                <option value="Tembaga">Tembaga</option>
                                <option value="Aluminium">Aluminium</option>
                                <option value="Timah">Timah</option>
                                <option value="Kuningan">Kuningan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                            <label>Berat Benda (kg)</label>
                            <input type="number" id="beratBenda" name="berat_benda" class="form-control" placeholder="Berat Benda" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                            <label>Harga Perkilo (Rp)</label>
                            <input type="number" id="hargaKiloan" name="harga_kiloan" class="form-control" placeholder="Harga Perkilo" readonly required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                            <label>Total Harga (Rp)</label>
                            <input type="number" id="totalHarga" name="total_harga" class="form-control" placeholder="Total Harga" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<!-- Modal for Viewing Transaction Details -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Detail</span> 
                    <span class="fw-light">Transaksi</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detailContent">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Jenis Limbah</label>
                                <input type="text" id="detailJenisLimbah" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Berat Benda (kg)</label>
                                <input type="text" id="detailBeratBenda" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Harga Perkilo (Rp)</label>
                                <input type="text" id="detailHargaKiloan" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Total Harga (Rp)</label>
                                <input type="text" id="detailTotalHarga" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

