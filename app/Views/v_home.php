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

  <style>
    #profil-desa {
      position: relative;
      overflow: hidden;
    }

    #profil-desa::after {
      content: '';
      background-image: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiBt7hW1Ih41TY-AVaJJ8DBhphXQDHPVxJch4XQWwVchadZ1uIx5k3glnRFadld8ZjpaeHlJW1d2bCDGWZTll6o6U7hCTlBtQj5wOq0z3G-QfWk8IE6mNvaEEAmMKdCwBu_NQfvoxlmwJHG0E6Ms8P_q6CLgcJLxslw2W6oMtIPEWJYQVGPycjuFmbUlnFC/s3356/20230912_141449_11zon.jpg');
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.1;
      /* Atur opacity sesuai kebutuhan */
      z-index: -1;
      background-size: cover;
      background-position: center;
    }

    .container {
      position: relative;
      z-index: 1;
    }
  </style>

  <section id="profil-desa" class="profil-desa">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Profil Desa Ngingas</h2>
      </div>
      <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bx bx-bulb"></i></div>
            <h4 class="title"><a href="#">Visi</a></h4>
            <p class="description">Menjadi desa yang mandiri, sejahtera, dan berwawasan lingkungan melalui pengelolaan
              limbah logam yang efisien dan berkelanjutan.</p>
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-target-lock"></i></div>
            <h4 class="title"><a href="#">Misi</a></h4>
            <p class="description">
            <ul>
              <li>Mengembangkan sistem pengelolaan limbah logam yang efektif dan efisien.</li>
              <li>Meningkatkan kesejahteraan masyarakat melalui pemberdayaan ekonomi berbasis pengelolaan limbah.</li>
              <li>Melestarikan lingkungan dengan mengurangi dampak negatif limbah logam.</li>
              <li>Memperkuat kerjasama antara pemerintah desa, masyarakat, dan pihak swasta dalam pengelolaan limbah.
              </li>
            </ul>
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bx bx-map"></i></div>
            <h4 class="title"><a href="#">Tentang Desa Ngingas</a></h4>
            <p class="description">Desa Ngingas terletak di wilayah yang strategis dan dikenal dengan inovasinya dalam
              pengelolaan limbah logam. Dengan dukungan teknologi dan semangat gotong royong, desa ini telah berhasil
              menciptakan lingkungan yang bersih dan ekonomi yang berkembang pesat.</p>
          </div>
        </div>
      </div>
    </div>
  </section>