<?php require_once '../conn/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">

  <title>C45 | Home</title>

  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/assets/img/favicons/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/assets/img/favicons/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/assets/img/favicons/favicon-16x16.png') ?>">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('public/assets/img/favicons/favicon.ico') ?>">
  <link rel="manifest" href="<?= base_url('public/assets/img/favicons/manifest.json') ?>">
  <link href="<?= base_url('public/assets/css/theme.css') ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/carousel-style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand d-flex align-items-center fw-semi-bold fs-3" href="<?= base_url('public/index.php') ?>"> <img class="me-3" src="<?= base_url('public/assets/img/logo_sma2.png') ?>" alt="" /></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto pt-2 pt-lg-0 font-base">
            <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link fw-medium active" aria-current="page" href="#home">Beranda</a></li>
            <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#visiMisi">Visi & Misi</a></li>
            <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#photos">Foto</a></li>
            <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="#lokasi">Lokasi</a></li>
          </ul>
          <form class="ps-lg-5">
            <a class="btn btn-outline-primary order-0" type="submit" href="<?= base_url('auth/login-form.php') ?>"> Login </a>
          </form>
        </div>
      </div>
    </nav>

    <section class="py-3" id="home">
      <div class="bg-holder d-none d-md-block" style="background-image:url(../assets/bg-siswa-io2.png);
      background-position:right top;
      background-size:650px;
      margin-top:6em;">
      </div>
      <div class="container">
        <div class="row align-items-center min-vh-md-75 mt-7">
          <div class="col-md-7 col-lg-6 py-4 text-sm-start ">
            <h1 class="mt-3 mb-sm-4 display-4 fw-light lh-sm fs-4 fs-lg-6 fs-xxl-7"> SISTEM PENENTUAN JURUSAN <span class=""> SISWA BARU</span><br class="d-block d-lg-none d-xl-block" /> SMAN 2 MATARAM </h1>
            <p class="mb-2 lh-lg text-justify">
              SMA Negeri 2 Mataram adalah Sekolah Menengah Atas unggulan
              yang berada di Kota Mataram, Nusa Tenggara Barat.
              Aplikasi Web ini digunakan untuk menentukan jurusan dengan kriteria :
            </p>
            <ol type="1" class="mb-2">
              <li class="mt-1">Jalur PPDB</li>
              <li class="mt-1">Nilai rata-rata raport pada mata pelajaran :
                <ol type="a">
                  <li>Bahasa Indonesia</li>
                  <li>Matematika</li>
                  <li>Bahasa Inggris</li>
                  <li>Bahasa Indonesia</li>
                  <li>IPA</li>
                  <li>IPS</li>
                </ol>
              </li>
              <li class="mt-1">Nilai SKHU</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="py-6">
      </div>
    </section>

    <section id="visiMisi" class="py-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto text-center mb-4">
            <h5 class="fw-light fs-3 fs-lg-5 lh-sm mb-3"><b>VISI & MISI</b></h5>
          </div>
        </div>
        <div class="row flex-center h-100">
          <div class="col-xl-9">
            <div class="carousel slide" id="carouselEvents" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                  <div class="row h-100 justify-content-center">
                    <div class="col-md-6 mb-4">
                      <div class="card h-100 shadow px-2 px-lg-3 card-span pt-4">
                        <div class="text-center text-md-start card-hover">
                          <div class="card-body">
                            <div class="d-flex align-items-center"><span class="fw-medium fs-1 mb-2"></span><br></span>
                              <h6 class="fw-light fs-1 fs-lg-2 text-start ms-3">VISI</h6>
                            </div>
                            <p class="mt-4 mb-md-0 mb-lg-3 fw-light lh-base text-start">Berilmu Dan Berketerampilan Yang Dilandasi Iman Dan Taqwa Kepada Tuhan Yama Maha Esa </p>
                            <div class="d-flex flex-between-center">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="card h-100 shadow px-2 px-lg-3 card-span pt-4">
                        <div class="text-center text-md-start card-hover">
                          <div class="card-body">
                            <div class="d-flex align-items-center"><span class="fw-medium fs-1 mb-2"></span><br></span>
                              <h6 class="fw-light fs-1 fs-lg-2 text-start ms-3">MISI</h6>
                            </div>
                            <p class="mt-4 mb-md-0 mb-lg-3 fw-light lh-base text-start">1. Menyelenggarakan Kegiatan Belajar<br>
                              <br>2. Mengajar Yang Efektif<br>
                              <br>3. Efisien Dan Bermutu Menyediakan Sarana Dan Prasarana Serta Sumber Belajar Yang Sesuai<br>
                              <br>4. Menyediakan Fasilitas Dan Sarana Kegiatan Ekstrakurikuler Untuk Menunjang Bakat Non Akademik Dan Memberikan Vokasional Skill Kepada Siswa<br>
                              <br>5. Menciptakan Kondisi Sekolah Yang Tertib Dan Disiplin<br>
                              <br>6. Membina Dan Meningkatkan Profesional Guru<br>
                              <br>7. Menyelenggarakan Kegiatan Imtaq Dan Kegiatan Keagamaan Lainnya Untuk Membina Keimanan, Ketaqwaan Dan Akhlaq Terpuji Bagi Siswa<br>
                              <br>8. Membangun Hubungan Yang Lebih Komunikatif Antara Sekolah Dengan Masyarakat Dalam Menyusun Program Sekolah Dan Juga Pihak Lain Yang Berkiprah Dan Memiliki Katian Dengan Masalah Pendidikan
                            </p>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-100" id="photos" class="py-0">
      <? $section = "photos"; ?>
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto text-center my-3">
            <h5 class="fw-light fs-3 fs-lg-5 lh-sm mb-3"><b>Foto</b></h5>
            <p>Sekilas Foto Tentang Sma Negeri 2 Mataram</p>
          </div>
        </div>
        <div class="row">
          <div class="slider">
            <div class="owl-carousel">
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide10.jpg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide2.jpeg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide3.jpeg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide4.jpg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide5.jpeg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide6.jpg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide7.jpg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide8.jpg') ?>" alt="">
                  </div>
                </div>
              </div>
              <div class="slider-card">
                <div class="d-flex justify-content-center align-items-center mb-4">
                  <div>
                    <img src="<?= base_url('public/assets/img/slide9.jpg') ?>" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="py-7"></div>
    </section>

    <section class="py-4 bg-100" id="lokasi">
      <div class="container">
        <h5 class="fw-light fs-3 fs-lg-5 lh-sm mb-3 text-center"><b>Lokasi</b></h5>
        <div id="iframe_container" class="iframe-container">
          <iframe id="1" name="map_frame" title="smanda_map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15780.388959315234!2d116.086003!3d-8.586649!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf0e079a69a4adf4a!2sState%20Senior%20High%20School%202%20Mataram!5e0!3m2!1sen!2sus!4v1649077191710!5m2!1sen!2sus" align="center" scrolling="yes" class="iframe-responsive"></iframe>
        </div>
      </div>
    </section>

    <section class="py-0 bg-primary">
      <div class="container">
        <div class="row justify-content-between pb-2 pt-5">
          <div class="col-12 col-lg-auto mb-5 mb-lg-0"><a class="d-flex align-items-center fw-semi-bold fs-3" href="#"> <img class="me-3" src="<?= base_url('public/assets/img/logo_sma2.png') ?>" alt="..." /></a>
            <p class="my-1 text-100 fw-light">Jl. Panji Tilar Negara No.25, Kekalik Jaya</p>
            <p class="my-1 text-100 fw-light">Kec. Sekarbela, Kota Mataram, Nusa Tenggara Barat </p>
          </div>
          <div class="col-auto mb-3">
            <ul class="list-unstyled mb-md-4 mb-lg-0">
              <li class="mb-3"><a class="text-100 fw-light text-decoration-none" href="#!">Email : sman2mtr@gmail.com </a></li>
              <li class="mb-3"><a class="text-100 fw-light text-decoration-none" href="#!">Telepon : 0370-632079 </a></li>
              <li class="mb-3"><a class="text-100 fw-light text-decoration-none" href="#!">Whatsapp : +62 877 47707513 </a></li>
              <li class="mb-3"><a class="text-100 fw-light text-decoration-none" href="#!">Facebook : SMAN 2 Mataram </a></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-auto mb-2">
            <p class="mb-0 fs--1 my-2 text-100"> Copyright &copy; 2021-2022 Ni Luh Putu Sri Astiti &nbsp; </p>
          </div>
        </div>
      </div>
    </section>

  </main>
  <script src="<?= base_url('public/vendors/@popperjs/popper.min.js') ?>"></script>
  <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/vendors/bootstrap/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('public/vendors/is/is.min.js') ?>"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="<?= base_url('public/assets/js/theme.js') ?>"></script>
  <script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
  <script>
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        center: true,
        nav: true,
        navText: [
          "<i class='fa fa-angle-left'></i>",
          "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
          0: {
            items: 1,

          },
          600: {
            items: 2,

          },
          1000: {
            items: 2,

          }
        }
      })
    });
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
</body>
</html>