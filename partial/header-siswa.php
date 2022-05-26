  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="#" class="logo d-flex align-items-center">
              <img src="<?= base_url('dist/img/logo_sma2.png') ?>" alt="">
              <span class="d-none d-lg-block"></span>
          </a>

      </div><!-- End Logo -->



      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">

              <li class="nav-item dropdown">

                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                      <img src="<?= base_url('dist/img/user-bg-dark.png') ?>" alt="Profile" class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['nama'] ?></span>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="border: 10px;">
                      <li class="dropdown-header">
                          <h6><?= $_SESSION['nama'] ?></h6>
                          <span><?= $_SESSION['lvl'] ?></span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile-siswa.php') ?>">
                              <i class="bi bi-person"></i>
                              <span>My Profile</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                              <i class="bi bi-question-circle"></i>
                              <span>Need Help?</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/logout.php') ?>">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>LogOut</span>
                          </a>
                      </li>

                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->
          </ul>
      </nav><!-- End Icons Navigation -->
      <div class="px-3">
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
  </header><!-- End Header -->