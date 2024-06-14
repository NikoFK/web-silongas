<?php echo form_open('Auth/InsertData') ?>
    <div class="login-form">
        <?php if (!empty(session()->getFlashdata('errors'))) : ?>
            <div class="alert alert-danger" role="alert">
                <h4>Periksa Entrian Form</h4>
                </hr />
                <?php echo session()->getFlashdata('errors'); ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="nama" class="placeholder"><b>Nama</b></label>
            <input  id="nama" name="nama" type="text" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email" class="placeholder"><b>Email</b></label>
            <input  id="email" name="email" type="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="username" class="placeholder"><b>Username</b></label>
            <input  id="username" name="username" type="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="passwordsignin" class="placeholder"><b>Password</b></label>
            <div class="position-relative">
                <input  id="passwordsignin" name="passwordsignin" type="password" class="form-control" required>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmpassword" class="placeholder"><b>Konfirmasi Password</b></label>
            <div class="position-relative">
                <input  id="confirmpassword" name="confirmpassword" type="password" class="form-control" required>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
            </div>
        </div>
        <div class="row form-action">
            <div class="col-md-6">
                <a href="<?= base_url('auth') ?>" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Kembali</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary w-100 fw-bold">Registrasi</button>
            </div>
        </div>
    </div>
<?php echo form_close() ?>
