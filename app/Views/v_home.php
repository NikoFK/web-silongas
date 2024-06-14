<section id="hero" class="d-flex align-items-center">
  <div class="container" data-aos="zoom-out" data-aos-delay="100">
    <h1>Selamat Datang di<span> SILONGAS</span></h1>
    <h2>Aplikasi Pengelolaan dan Penjualan Limbah Logam Desa Ngingas</h2>
    <div class="d-flex">
      <a href="#" class="btn-get-started scrollto">Hubungi Kami</a>
    </div>
  </div>
</section>

<main id="main">
  <section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bx bx-note"></i></div>
            <h4 class="title"><a href="">Pencatatan Limbah</a></h4>
            <p class="description">Mencatat limbah logam secara real-time untuk pengelolaan yang lebih baik.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-bar-chart"></i></div>
            <h4 class="title"><a href="">Pelaporan dan Analisis</a></h4>
            <p class="description">Pelaporan dan analisis data limbah logam yang komprehensif.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bx bx-cart"></i></div>
            <h4 class="title"><a href="">Penjualan Efisien</a></h4>
            <p class="description">Proses penjualan limbah logam yang lebih efisien dan transparan.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="bx bx-wallet"></i></div>
            <h4 class="title"><a href="">Manajemen Keuangan</a></h4>
            <p class="description">Manajemen keuangan dan distribusi hasil penjualan yang transparan dan akuntabel.</p>
          </div>
        </div>

      </div>
    </div>
    <br>
    <div class="container" data-aos="fade-up">
      <div class="row">
        <?php foreach ($users as $user): ?>
          <div class="col-md-6 col-lg-6 d-flex align-items-stretch mb-5 mb-lg-4">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon">
                <?php if ($user['foto'] == "default-foto-profil-usaha.png") { ?>
                  <img width="500px" src="<?= base_url('default') ?>/<?= $user['foto_usaha'] ?>" alt="..."
                    class="avatar-img ">
                <?php } else { ?>
                  <img width="500px" src="<?= base_url('foto') ?>/<?= $user['foto_usaha'] ?>" alt="..." class="avatar-img ">
                <?php } ?>
              </div>
              <h4 class="title"><a href=""><?= $user['nama_usaha'] ?></a></h4>
              <p class="description"><?= $user['deskripsi_usaha'] ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>



</main>