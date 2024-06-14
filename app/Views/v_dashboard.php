<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body ">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="col col-stats ml-3 ml-sm-0">
                    <div class="numbers">
                        <p class="card-category">Pengusaha</p>
                        <h4 class="card-title"><?= $jumlahPengusahaLevel2 ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body ">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                        <i class="far fa-caret-square-right"></i>
                    </div>
                </div>
                <div class="col col-stats ml-3 ml-sm-0">
                    <div class="numbers">
                        <p class="card-category">Proses Pengajuan</p>
                        <h4 class="card-title"><?= $jumlahTransaksiProses ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body ">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                        <i class="far fa-caret-square-down"></i>
                    </div>
                </div>
                <div class="col col-stats ml-3 ml-sm-0">
                    <div class="numbers">
                        <p class="card-category">Pengajuan Diterima</p>
                        <h4 class="card-title"><?= $jumlahTransaksiDiterima ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body ">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="far fa-check-square"></i>
                    </div>
                </div>
                <div class="col col-stats ml-3 ml-sm-0">
                    <div class="numbers">
                        <p class="card-category">Pengajuan Selesai</p>
                        <h4 class="card-title"><?= $jumlahTransaksiSelesai ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-card-no-pd col-md-12">
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Pencairan Dana Hari Ini</p>
                            <h4 class="card-title"><?= formatRupiah($jumlahTotalHargaHariIni) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Pencairan Dana Bulan Ini</p>
                            <h4 class="card-title"><?= formatRupiah($jumlahTotalHargaBulanIni) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Pencairan Dana Tahun Ini</p>
                            <h4 class="card-title"><?= formatRupiah($jumlahTotalHargaTahunIni) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="card-title fw-mediumbold">Rincian Pencarian Dana</div>
            <div class="card-list">
                <?php foreach ($users as $user): ?>
                    <div class="item-list">
                        <div class="avatar">
                            <?php if ($user['foto'] == "default-foto-profil.png") { ?>
                                <img src="<?= base_url('default') ?>/<?= $user['foto'] ?>" alt="..."
                                    class="avatar-img rounded-circle">
                            <?php } else { ?>
                                <img src="<?= base_url('foto') ?>/<?= $user['foto'] ?>" alt="..."
                                    class="avatar-img rounded-circle">
                            <?php } ?>
                        </div>
                        <div class="info-user ml-3">
                            <div class="username"><?= $user['nama'] ?></div>
                            <div class="status"><?= $user['level'] == 1 ? 'Admin' : 'Pengusaha' ?></div>
                        </div>
                        <div class="d-flex ml-auto align-items-center">
                            <h3 class="text-<?= session()->get('level') == 1 ? 'danger' : 'info' ?> fw-bold">
                                <?= session()->get('level') == 1 ? '-' : '+' ?>    <?= formatRupiah($user['total_harga']) ?>
                            </h3>
                        
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card  card-success">
        <div class="card-header">
            <div class="card-title">
                <h2 class="text-center">Total Pencairan Dana : <?= formatRupiah($jumlahTotalHargaKeseluruhan) ?></h2>
            </div>
        </div>
    </div>
</div>