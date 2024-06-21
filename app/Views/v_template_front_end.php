<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SILONGAS - Sistem Informasi Pengelolaan Limbah Logam Desa Ngingas</title>
  <meta content="Aplikasi IoT untuk pengelolaan dan penjualan limbah logam di Desa Ngingas, Sidoarjo"
    name="description">
  <meta content="limbah logam, pengelolaan limbah, Desa Ngingas, IoT" name="keywords">
  <link rel="icon" href="<?= base_url('back-end') ?>/assets/img/logo.png" type="image/x-icon" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= base_url('front-end') ?>/assets/css/style.css" rel="stylesheet">
  <link rel="icon" href="<?= base_url('back-end') ?>/assets/img/ruang.jpg" type="image/x-icon" />

</head>

<body>

  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a
            href="mailto:admin@silongas.com">admin@silongas.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62 859-7496-1499</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://x.com/upnvjt_official" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/upnveteranjawatimur" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/fk.shoot_projects/" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="www.linkedin.com/in/nikofauzakurniawan" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </section>

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="">SILONGAS<span></span></a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.html">Home</a></li>
          <?php if (session()->get('level')): ?>
            <!-- Tampilkan tombol "Logout" atau logika lainnya ketika pengguna sudah login -->
            <li><a class="nav-link scrollto" href="<?= base_url('auth/logout') ?>">Logout</a></li>
          <?php else: ?>
            <!-- Tampilkan tombol "Login" ketika pengguna belum login -->
            <li><a class="nav-link scrollto" href="<?= base_url('auth') ?>">Login</a></li>
          <?php endif; ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <?php if ($page) {
    echo view($page);
  } ?>

  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>SILONGAS<span></span></h3>
            <p>
              Jl. Ambeng-Ambeng Selatan, RT.11/RW.03, Ambengambeng<br>
              Ngingas, Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256<br>
              Indonesia <br><br>
              <strong>Phone:</strong> +62 859-7496-1499<br>
              <strong>Email:</strong> admin@silongas.com<br>
            </p>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Link Berguna</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Beranda</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Profil Desa Ngingas</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang Kami</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Layanan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Syarat Layanan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Kebijakan Privasi</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Layanan Kami</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Pencatatan Limbah</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Pelaporan Data</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Penjualan Limbah</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Manajemen Keuangan</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Jaringan Sosial Kami</h4>
            <p>Temukan kami di berbagai platform sosial:</p>
            <div class="social-links mt-3">
              <a href="https://x.com/upnvjt_official" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="https://www.facebook.com/upnveteranjawatimur" class="facebook"><i
                  class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com/fk.shoot_projects/" class="instagram"><i
                  class="bx bxl-instagram"></i></a>
              <a href="www.linkedin.com/in/nikofauzakurniawan" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container py-4">
      <div class="copyright">
        &copy; Hak Cipta <strong><span>SILONGAS</span></strong>. Seluruh Hak Dilindungi
      </div>
    </div>
  </footer>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <script src="<?= base_url('front-end') ?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('front-end') ?>/assets/js/main.js"></script>

</body>

</html>