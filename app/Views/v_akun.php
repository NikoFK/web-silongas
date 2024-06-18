<div class="col-md-8">
    <div class="card card-with-nav">
        <div class="card-header">
            <div class="row row-nav-line">
                <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"
                            aria-selected="false">Profile</a> </li>
                    <?php if (!empty(session()->getFlashdata('errors'))): ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Periksa Entrian Form</h4>
                            </hr />
                            <?php echo session()->getFlashdata('errors'); ?>
                        </div>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group form-group-default">
                        <label>Nama</label>
                        <input readonly type="text" class="form-control" name="name" placeholder="Name"
                            value="<?= session()->get('nama') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-default">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username"
                            value="<?= session()->get('username') ?>" placeholder="Username" readonly>
                    </div>
                </div>
            </div>
            <form action="<?= base_url('akun/updateData') ?>" method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group form-group-default">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" id="datepicker" name="ttl"
                                value="<?= session()->get('ttl') ?>" placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-default">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="jenis_kelamin">
                                <option <?= (session()->get('jenis_kelamin') == 'Kosong') ? 'selected' : '' ?>>Kosong
                                </option>
                                <option <?= (session()->get('jenis_kelamin') == 'Pria') ? 'selected' : '' ?>>Pria</option>
                                <option <?= (session()->get('jenis_kelamin') == 'Wanita') ? 'selected' : '' ?>>Wanita
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-default">
                            <label>No Hp</label>
                            <input type="text" class="form-control" name="no_hp" value="<?= session()->get('no_hp') ?>"
                                placeholder="No HP">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="<?= session()->get('email') ?>"
                                placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Lokasi Rumah</label>
                            <input type="text" class="form-control" name="alamat"
                                value="<?= session()->get('alamat') ?>" placeholder="Alamat">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Visi Misi</label>
                            <input type="text" class="form-control" name="tentang_aku"
                                value="<?= session()->get('tentang_aku') ?>" placeholder="Visi Misi">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Ubah Foto Profil</label>
                            <input type="file" class="form-control" name="foto">
                            <?php if (session()->has('foto')): ?>
                                <input type="hidden" name="old_foto" value="<?= session()->get('foto') ?>">
                                <br>
                                <?php if (session()->get('foto') == "default-foto-profil.png") { ?>
                                    <img width="100" height="100"
                                        src="<?= base_url('default') ?>/<?= session()->get('foto') ?>" alt="Foto Profil">
                                <?php } else { ?>
                                    <img width="100" height="100" src="<?= base_url('foto') ?>/<?= session()->get('foto') ?>"
                                        alt="Foto Profil">
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3 mb-3">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="col-md-4">
    <div class="card card-profile card-secondary">
        <div class="card-header" style="background-image: url('<?= base_url('back-end') ?>/assets/img/blogpost.jpg')">
            <div class="profile-picture">
                <div class="avatar avatar-xl">
                    <?php if (session()->get('foto') == "default-foto-profil.png") { ?>
                        <img src="<?= base_url('default') ?>/<?= session()->get('foto') ?>" alt="..."
                            class="avatar-img rounded-circle">
                    <?php } else { ?>
                        <img src="<?= base_url('foto') ?>/<?= session()->get('foto') ?>" alt="..."
                            class="avatar-img rounded-circle">
                    <?php } ?>
                </div>
            </div>


        </div>
        <div class="card-body">
            <div class="user-profile text-center">
                <div class="nama"><?= session()->get('nama') ?></div>
                <div class="level"><?= session()->get('level') == 1 ? 'Admin' : 'Pengusaha' ?></div>
                <div class="desc">"<?= session()->get('email') ?>"</div>
            </div>
        </div>
    </div>
</div>