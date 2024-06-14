<div class="col-md-6">
    <div class="card card-post card-round">
        <?php if (session()->get('foto_usaha') == "default-foto-profil-usaha.jpg" ) { ?>
            <img class="card-img-top" src="<?= base_url('default') ?>/<?= session()->get('foto_usaha')  ?>" alt="Card image cap">
        <?php } else { ?>
            <img class="card-img-top" src="<?= base_url('foto') ?>/<?= session()->get('foto_usaha')  ?>" alt="Card image cap">
        <?php } ?>  
        <div class="card-body">
            <div class="d-flex">
                <div class="avatar">
                    <?php if (session()->get('foto') == "default-foto-profil.png" ) { ?>
                        <img src="<?= base_url('default') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
                    <?php } else { ?>
                        <img src="<?= base_url('foto') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
                    <?php } ?>                
                </div>
                <div class="info-post ml-2">
                    <p class="username"><?= session()->get('nama')  ?></p>
                    <p class="date text-muted"><?= session()->get('ttl')  ?></p>
                </div>
            </div>
            <div class="separator-solid"></div>
            <p class="card-category text-info mb-1"><?= session()->get('lokasi_usaha')  ?></p>
            <p class="card-text"><?= session()->get('deskripsi_usaha')  ?></p>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-with-nav">
        <div class="card-header">
            <div class="row row-nav-line">
                <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile Usaha</a> </li>
                    <?php if (!empty(session()->getFlashdata('errors'))) : ?>
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
            <form action="<?= base_url('ProfilUsaha/UpdateData') ?>" method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Nama Usaha</label>
                            <input   type="text" class="form-control" name="nama_usaha" value="<?= session()->get('nama_usaha') ?>" placeholder="Nama Usaha">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Deksripsi Usaha</label>
                            <input   type="text" class="form-control" name="deskripsi_usaha" value="<?= session()->get('deskripsi_usaha') ?>" placeholder="Deskripsi Usaha">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Ubah Foto Usaha</label>
                            <input   type="file" class="form-control" name="foto_usaha">
                            <?php if (session()->has('foto_usaha')): ?>
                                <input type="hidden" name="old_foto" value="<?= session()->get('foto_usaha')  ?>">
                                <br>
                                <?php if (session()->get('foto_usaha') == "default-foto-profil-usaha.jpg" ) { ?>
                                    <img width="100" height="100" src="<?= base_url('default') ?>/<?= session()->get('foto_usaha')  ?>" alt="Foto Profil">
                                <?php } else { ?>
                                    <img width="100" height="100" src="<?= base_url('foto') ?>/<?= session()->get('foto_usaha')  ?>" alt="Foto Profil">
                                <?php } ?>                                
                            <?php endif; ?>
                        </div> 
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Lokasi Usaha</label>
                            <input  type="text" class="form-control" name="lokasi_usaha" value="<?= session()->get('lokasi_usaha') ?>" placeholder="Lokasi Usaha">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Nomor Rekening</label>
                            <input  type="text" class="form-control" name="nomor_rekening" value="<?= session()->get('nomor_rekening') ?>" placeholder="Nomor Rekening">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group form-group-default">
                            <label>Bank</label>
                            <input  type="text" class="form-control" name="bank" value="<?= session()->get('bank') ?>" placeholder="Bank">
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