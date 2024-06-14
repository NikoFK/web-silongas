<?php echo form_open('Auth/Login') ?>
    <div class="login-form">
        <div class="form-group">
            <label><b>Username</b></label>
            <input id="username" name="username" type="text" class="form-control" required >
        </div>
    </div>
    <div class="form-group">
        <label><b>Level</b></label>
        <select name="level" class="form-control">
            <option value="">--Level--</option>
            <option value="1">Admin</option>
            <option value="2">Pengusaha</option>
        </select>
    </div>

    <div class="form-group">
        <label><b>Password</b></label>
        <div class="position-relative">
            <input id="password" name="password" type="password" class="form-control" required>
            <div class="show-password">
                <i class="flaticon-interface"></i>
            </div>
        </div>
    </div>
    <div class="form-group form-action-d-flex mb-3">
        <button class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</button>
    </div>
    <div class="login-account">
        <span class="msg">Belum Punya Akun ?</span>
        <a href="<?= base_url('auth/registrasi') ?>" id="show-signup" class="link">Registrasi</a>
    </div>
        <!-- 				<div class="form-action">
            <a href="#" class="btn btn-primary btn-rounded btn-login">Sign In</a>
        </div> -->
        
<?php echo form_close() ?>