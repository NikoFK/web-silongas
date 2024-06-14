<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Pengusaha</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengusaha</th>
                            <th>Username</th>
                            <th>Foto</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No Hp</th>
                            <th>Tentang Aku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no =1;
                    foreach ($pengusaha as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['username'] ?></td>
                            <td>
                                <?php if ($value['foto'] == "default-foto-profil.png"): ?>
                                    <img src="<?= base_url('default') ?>/<?= $value['foto'] ?>" alt="Foto" width="100" height="100">
                                <?php else: ?>
                                    <img src="<?= base_url('foto') ?>/<?= $value['foto'] ?>" alt="Foto" width="100" height="100">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($value['ttl'])): ?>
                                    Kosong
                                <?php else: ?>
                                    <?= $value['ttl'] ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($value['jenis_kelamin'])): ?>
                                    Kosong
                                <?php else: ?>
                                    <?= $value['jenis_kelamin'] ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($value['no_hp'])): ?>
                                    Kosong
                                <?php else: ?>
                                    <?= $value['no_hp'] ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($value['tentang_aku'])): ?>
                                    Kosong
                                <?php else: ?>
                                    <?= $value['tentang_aku'] ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="form-button-action">
                                    <button class="btn btn-danger btn-sm alert_demo_hapus_pengusaha" data-toggle="modal" data-target="#hapusModal" data-id="<?= $value['id_user'] ?>">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



