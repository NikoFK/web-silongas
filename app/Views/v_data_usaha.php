<?php foreach ($users as $user): ?>
<div class="col-md-6">
    <div class="card card-post card-round">
            <?php if ($user['foto_usaha'] == "default-foto-profil-usaha.jpg"): ?>
                <img class="card-img-top" src="<?= base_url('default') ?>/<?= $user['foto_usaha'] ?>" alt="Card image cap">
            <?php else: ?>
                <img class="card-img-top" src="<?= base_url('foto') ?>/<?= $user['foto_usaha'] ?>" alt="Card image cap">
            <?php endif; ?>
        <div class="card-body">
            <div class="d-flex">
                <div class="avatar">
                    <?php if ($user['foto'] == "default-foto-profil.png"): ?>
                        <img src="<?= base_url('default') ?>/<?= $user['foto'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="<?= base_url('foto') ?>/<?= $user['foto'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php endif; ?>
                </div>
                <div class="info-post ml-2">
                    <p class="username"><?= $user['nama'] ?></p>
                    <p class="date text-muted"><?= $user['ttl'] ?></p>
                </div>
            </div>
            <div class="separator-solid"></div>
            <p class="card-category text-info mb-1"><?= $user['lokasi_usaha'] ?> | <?= $user['no_hp'] ?></p>
            <p class="card-text"><?= $user['deskripsi_usaha'] ?></p>
        </div>
    </div>
</div>
<?php endforeach; ?>
