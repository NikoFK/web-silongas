<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Pengajuan Diterima</h4>
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
                            <td><?= $row['nomor_rekening'] ?> | <?= $row['bank'] ?></td>                            <td><?= $row['invoice'] ?></td>
                            <td><?= formatRupiah($row['total_harga']) ?></td>
                            <td> <span class="badge-warning"><?= $row['status'] ?></span></td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" onclick="showDetail(<?= $row['id_transaksi'] ?>)">
                                    Detail
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

