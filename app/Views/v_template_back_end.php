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
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?= base_url('back-end') ?>/assets/css/demo.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
	  <!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin="">
	</script>
</head>
<body>
	<div class="wrapper">
		<!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="light-blue">
			<!-- Logo Header -->
			<div class="logo-header">
				<a href="<?= base_url('dashboard') ?>" class="logo">
					<img width="150px" src="<?= base_url('back-end') ?>/assets/img/ruang.png" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<?php if (session()->get('foto') == "default-foto-profil.png" ) { ?>
										<img src="<?= base_url('default') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
									<?php } else { ?>
										<img src="<?= base_url('foto') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
									<?php } ?>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg">
											<?php if (session()->get('foto') == "default-foto-profil.png" ) { ?>
												<img src="<?= base_url('default') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
											<?php } else { ?>
												<img src="<?= base_url('foto') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
											<?php } ?>
										</div>
										<div class="u-text">
											<h4><?= session()->get('nama') ?></h4>
											<p class="text-muted"><?= session()->get('level') == 1 ? 'Admin' : 'Pengusaha'  ?></p>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?= base_url('Akun') ?>">Account Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?= base_url('Auth/LogOut')?>">Logout</a>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<?php if (session()->get('foto') == "default-foto-profil.png" ) { ?>
								<img src="<?= base_url('default') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
							<?php } else { ?>
								<img src="<?= base_url('foto') ?>/<?= session()->get('foto')  ?>" alt="..." class="avatar-img rounded-circle">
							<?php } ?>
							
						</div>
						<div class="info">
							<a  href="" aria-expanded="">
								<span>
									<?= session()->get('nama')  ?>
									<span class="user-level"><?= session()->get('level') == 1 ? 'Admin' : 'Pengusaha'  ?></span>
								</span>
							</a>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item <?= $menu == 'dashboard' ? 'active' : ''?>">
							<a href="<?= base_url('dashboard') ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<?php if ( session()->get('level') == 1 ) : ?>
							<li class="nav-item <?= $menu == 'k_pengajuan' || $menu == 'k_diterima' || $menu == 'k_selesai' ? 'active' : ''?>">
								<a data-toggle="collapse" href="#config2">
									<i class="fas fa-money-check"></i>
									<p>Konfirmasi Pengajuan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $menu == 'k_pengajuan' || $menu == 'k_diterima' || $menu == 'k_selesai' ? 'show' : ''?>" id="config2">
									<ul class="nav nav-collapse">
										<li class="<?= $menu == 'k_pengajuan' ? 'active' : ''?>">
											<a href="<?= base_url('KonfirmasiPengajuan') ?>">
												<span class="sub-item">Konfirmasi Proses Pengajuan</span>
											</a>
										</li>
										<li class="<?= $menu == 'k_diterima' ? 'active' : ''?>">
											<a href="<?= base_url('KonfirmasiPengajuan/Diterima') ?>">
												<span class="sub-item">Konfirmasi Pengajuan Diterima</span>
											</a>
										</li>
										<li class="<?= $menu == 'k_selesai' ? 'active' : ''?>">
											<a href="<?= base_url('KonfirmasiPengajuan/Selesai') ?>">
												<span class="sub-item">Pengajuan Selesai</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item <?= $menu == 'data_usaha' ? 'active' : ''?>">
								<a href="<?= base_url('DataUsaha') ?>">
									<i class="fas fa-store-alt"></i>
									<p>Data Usaha</p>
								</a>
							</li>
							<li class="nav-item <?= $menu == 'pengusaha' ? 'active' : ''?>">
								<a href="<?= base_url('pengusaha') ?>">
									<i class="fas fa-user"></i>
									<p>Akun Pengusaha</p>
								</a>
							</li>
						<?php elseif (session()->get('level') == 2) : ?>
							<li class="nav-item <?= $menu == 'pengajuan' || $menu == 'diterima' || $menu == 'selesai' ? 'active' : ''?>">
								<a data-toggle="collapse" href="#config">
									<i class="fas fa-money-check-alt"></i>
									<p>Pengajuan</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $menu == 'pengajuan' || $menu == 'diterima' || $menu == 'selesai' ? 'show' : ''?>" id="config">
									<ul class="nav nav-collapse">
										<li class="<?= $menu == 'pengajuan' ? 'active' : ''?>">
											<a href="<?= base_url('Pengajuan') ?>">
												<span class="sub-item">Proses Pengajuan</span>
											</a>
										</li>
										<li class="<?= $menu == 'diterima' ? 'active' : ''?>">
											<a href="<?= base_url('Pengajuan/Diterima') ?>">
												<span class="sub-item">Pengajuan Diterima</span>
											</a>
										</li>
										<li class="<?= $menu == 'selesai' ? 'active' : ''?>">
											<a href="<?= base_url('Pengajuan/Selesai') ?>">
												<span class="sub-item">Pengajuan Selesai</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item <?= $menu == 'profil_usaha' ? 'active' : ''?>">
								<a href="<?= base_url('ProfilUsaha') ?>">
									<i class="fas fa-store"></i>
									<p>Profil Usaha</p>
									<?php if ($atributKosongProfilUsaha != 0) : ?>
										<span class="badge badge-count badge-danger">LENGKAPI  <?= $atributKosongProfilUsaha ?></span>
									<?php endif; ?>
								</a>
							</li>
						<?php endif; ?>

						<li class="nav-item <?= $menu == 'akun' ? 'active' : ''?>">
							<a href="<?= base_url('akun') ?>">
								<i class="fas fa-user-cog"></i>
								<p>Profil Akun</p>
								<?php if ($atributKosong != 0) : ?>
									<span class="badge badge-count badge-danger">LENGKAPI  <?= $atributKosong ?></span>
								<?php endif; ?>
							</a>
						</li>
					</ul>

				</div>
			</div>
		</div>

		<!-- End Sidebar -->
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<h4 class="page-title"><?= $judul ?></h4>
					<div class="row">
					<?php if($page) {
							echo view($page);
						} ?>
					</div>
				</div>
			</div>
			
		</div>
		
		
	</div>
	<!--   Core JS Files   -->
	<script src="<?= base_url('back-end') ?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/core/popper.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- Moment JS -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/moment/moment.min.js"></script><!-- DateTimePicker -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Azzara JS -->
	<script src="<?= base_url('back-end') ?>/assets/js/ready.min.js"></script>
	<!-- Chart JS -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/chart.js/chart.min.js"></script>
	<!-- Azzara DEMO methods, don't include it in your project! -->
	<script src="<?= base_url('back-end') ?>/assets/js/setting-demo.js"></script>
	<!-- Datatables -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Azzara JS -->
	<script>
		$('#datepicker').datetimepicker({
			format: 'MM/DD/YYYY',
		});
	</script>
	
	<!-- Sweet Alert -->
	<script src="<?= base_url('back-end') ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Transaksi -->
	<script>
		$(document).on('click', '.alert_demo_hapus_transaksi', function(e) {
			var id_transaksi = $(this).data('id');
			swal({
				icon : "warning",
				title: 'Apakah Kamu Yakin?',
				text: "Menghapus Data Transaksi",
				type: 'warning',
				buttons: {
					confirm: {
						text: 'Iya',
						className: 'btn btn-success'
					},
					cancel: {
						text: 'Tutup',
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						url: '<?= base_url('Pengajuan/DeleteData') ?>',
						type: 'POST',
						data: {id_transaksi: id_transaksi},
						success: function(response) {
							swal({
								icon : "success",
								title: 'Terhapus!',
								text: 'Transaksi Berhasil Dihapus',
								type: 'success',
								buttons: {
									confirm: {
										className: 'btn btn-success'
									}
								}
							}).then(() => {
								location.reload();
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							swal('Error deleting!', 'Please try again', 'error');
						}
					});
				} else {
					swal.close();
				}
			});
		});
	</script>
	<!-- Transaksi -->

	<!-- User -->
	<script>
		$(document).on('click', '.alert_demo_hapus_pengusaha', function(e) {
			var id_user = $(this).data('id');
			swal({
				icon : "warning",
				title: 'Apakah Kamu Yakin?',
				text: "Menghapus Data User",
				type: 'warning',
				buttons: {
					confirm: {
						text: 'Iya',
						className: 'btn btn-success'
					},
					cancel: {
						text: 'Tutup',
						visible: true,
						className: 'btn btn-danger'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$.ajax({
						url: '<?= base_url('Akun/DeleteData') ?>',
						type: 'POST',
						data: {id_user: id_user},
						success: function(response) {
							swal({
								icon : "success",
								title: 'Terhapus!',
								text: 'User Berhasil Dihapus',
								type: 'success',
								buttons: {
									confirm: {
										className: 'btn btn-success'
									}
								}
							}).then(() => {
								location.reload();
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							swal('Error deleting!', 'Please try again', 'error');
						}
					});
				} else {
					swal.close();
				}
			});
		});
	</script>
	<!-- User -->
	

	
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

	<script >
		$(document).ready(function() {
		// Add Row
		$('#add-row').DataTable({
					"pageLength": 5,
				});


		});
	</script>

	<script>
	window.setTimeout(function(){
		$('.alert').fadeTo(500,0).slideUp(500,function(){
		$(this).remove();
		});
	},3000);
	</script>

	<script>
		$(document).on('click', '.alert_demo_transaksi', function(e) {
		var id_transaksi = $(this).data('id_transaksi');
		swal({
			icon: "warning",
			title: 'Apakah Kamu Yakin?',
			text: "Menerima Konfirmasi Pengajuan",
			type: 'warning',
			buttons: {
				confirm: {
					text: 'Iya, Konfirmasi',
					className: 'btn btn-success'
				},
				cancel: {
					text: 'Tutup',
					visible: true,
					className: 'btn btn-danger'
				}
			}
			}).then((confirm) => {
				if (confirm) {
					$.ajax({
						url: '<?= base_url('KonfirmasiPengajuan/KonfirmasiProsesPengajuan') ?>',
						type: 'POST',
						data: { id_transaksi: id_transaksi },
						success: function(response) {
							swal({
								icon: "success",
								title: 'Konfirmasi Diterima!',
								text: 'Data Pengajuan Berhasil Diterima',
								type: 'success',
								buttons: {
									confirm: {
										className: 'btn btn-success'
									}
								}
							}).then(() => {
								location.reload();
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							swal('Gagal Diterima!', 'Coba Lagi', 'error');
						}
					});
				} else {
					swal.close();
				}
			});
		});

	</script>

	<script>
		const limbahHarga = {
			'Besi/Baja': { min: 5000, max: 10000 },
			'Tembaga': { min: 60000, max: 80000 },
			'Aluminium': { min: 20000, max: 30000 },
			'Timah': { min: 100000, max: 150000 },
			'Kuningan': { min: 40000, max: 60000 }
		};

		document.getElementById('jenisLimbah').addEventListener('change', function() {
			const jenis = this.value;
			if (jenis) {
				const hargaKiloan = (limbahHarga[jenis].min + limbahHarga[jenis].max) / 2;
				document.getElementById('hargaKiloan').value = hargaKiloan;
				calculateTotalHarga();
			}
		});

		document.getElementById('beratBenda').addEventListener('input', calculateTotalHarga);

		function calculateTotalHarga() {
			const berat = document.getElementById('beratBenda').value;
			const hargaKiloan = document.getElementById('hargaKiloan').value;
			if (berat && hargaKiloan) {
				document.getElementById('totalHarga').value = berat * hargaKiloan;
			}
		}

	</script>

	<script>
		function showDetail(id_transaksi) {
			$.ajax({
				url: '<?= base_url("pengajuan/detail") ?>/' + id_transaksi,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					const detail = response.detail[0]; // Assuming only one detail per transaction for simplicity
					document.getElementById('detailJenisLimbah').value = detail.jenis_limbah;
					document.getElementById('detailBeratBenda').value = detail.berat_benda;
					document.getElementById('detailHargaKiloan').value = detail.harga_kiloan;
					document.getElementById('detailTotalHarga').value = detail.total_harga;
					
					// Set the src attribute of the image element to the URL of the bukti pembayaran
					const fotoUrl = '<?= base_url("foto/") ?>' + detail.bukti_pembayaran;
					$('#detailBuktiPembayaran').attr('src', fotoUrl);

					$('#detailModal').modal('show');
				}
			});
		}
	</script>

	<script>
		var selectedTransaksiId;

		function setTransaksiId(id) {
			selectedTransaksiId = id;
		}

		$(document).ready(function() {
			$('#uploadBuktiForm').submit(function(e) {
				e.preventDefault();

				// Lakukan validasi di sisi klien (JavaScript)
				var bukti_pembayaran = $('#bukti_pembayaran').prop('files')[0];
				if (!bukti_pembayaran) {
					alert('Mohon pilih file bukti pembayaran.');
					return;
				}

				var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
				if (!allowedExtensions.exec(bukti_pembayaran.name)) {
					swal('Gagal Diterima!', 'File Harus Berupa .jpg .jpeg .png', 'error');					
					return;
				}

				// Kirim data ke server jika validasi berhasil
				var formData = new FormData(this);
				formData.append('id_transaksi', selectedTransaksiId);
					$.ajax({
						url: '<?= base_url("KonfirmasiPengajuan/KonfirmasiSelesaiPengajuan") ?>',
						type: 'POST',
						data: formData,
						contentType: false,
						processData: false,
						success: function(response) {
							swal({
								icon: "success",
								title: 'Konfirmasi Diterima!',
								text: 'Data Pengajuan Berhasil Diterima',
								type: 'success',
								buttons: {
									confirm: {
										className: 'btn btn-success'
									}
								}
							}).then(() => {
								location.reload();
							});
						}
					});
			});
		});


	</script>







		


	






</body>
</html>