<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?= $judul ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url('back-end') ?>/assets/img/ruang.jpg" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['<?= base_url('back-end') ?>/assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url('back-end') ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('back-end') ?>/assets/css/azzara.min.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center"><?= $judul ?></h3>
            <?php if($page) {
                echo view($page);
            } ?>
		</div>	
	</div>
	<script src="<?= base_url('back-end') ?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/core/popper.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/core/bootstrap.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/ready.js"></script>
    <!-- Sweet Alert -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script>
        // Pastikan dokumen sudah selesai dimuat sebelum menjalankan skrip
        $(document).ready(function() {
            // Periksa apakah gagal telah diset, jika iya, tampilkan sweet alert
            <?php if(session()->getFlashdata('gagal')): ?>
                swal("MAAF !!", "<?php echo session()->getFlashdata('gagal'); ?>", {
                    icon : "error",
                    buttons: {        			
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                });
            <?php endif; ?>
             // Periksa apakah flash data 'sukses' telah diset, jika iya, tampilkan sweet alert success
            <?php if(session()->getFlashdata('sukses')): ?>
                swal("SUKSES !!", "<?php echo session()->getFlashdata('sukses'); ?>", {
                    icon : "success",
                    buttons: {        			
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                });
            <?php endif; ?>
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var passwordField = document.getElementById("passwordsignin");
        var confirmPasswordField = document.getElementById("confirmpassword");

        function validatePassword() {
            if (passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.classList.add("is-invalid");
            } else {
                confirmPasswordField.classList.remove("is-invalid");
            }
        }

        passwordField.addEventListener("input", validatePassword);
        confirmPasswordField.addEventListener("input", validatePassword);
    });
</script>

<script>
	window.setTimeout(function(){
		$('.alert').fadeTo(500,0).slideUp(500,function(){
		$(this).remove();
		});
	},3000);
	</script>


</body>
</html>