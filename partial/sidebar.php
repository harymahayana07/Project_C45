<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->

    <!-- <div class=" preloader flex-column justify-content-center align-items-center">
      <div class="loading-area">
        <span class="loader"><img src="<?= base_url('dist/img/logo.png') ?>" alt="AdminLTELogo" height="120" width="120">Loading...</span>
        <span class="load_anim1"></span>
        <span class="load_anim2"></span>
      </div>
    </div> -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('dashboard.php') ?>" class="brand-link">
        <img src="<?= base_url('dist/img/logo.png') ?>" alt="sman_2_mataram" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>SMAN 2 MATARAM</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('assets/man.png') ?>" class="img-circle elevation-2" alt="User_Img">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['nama'] ?></a>
            <button type="button" class="btn btn-block btn-success btn-xs"><?= $_SESSION['lvl'] ?></button>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group text-dark" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" id="menu">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="<?= base_url('dashboard.php') ?>" accesskey='1' class="nav-link <?php if ($thisPage == "Dashboard") echo "active"; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard </i></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('data_training.php') ?>" accesskey='2' class="nav-link <?php if ($thisPage == "DATA TRAINING") echo "active"; ?>">
                <i class="nav-icon fas fa-server"></i>
                <p> Data Training</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('mining.php') ?>" accesskey='3' class="nav-link <?php if ($thisPage == "MINING DATA") echo "active"; ?>">
                <i class="nav-icon fab fa-cloudscale"></i>
                <p> Mining </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('pohon_tree.php') ?>" accesskey='4' class="nav-link <?php if ($thisPage == "POHON KEPUTUSAN") echo "active"; ?>">
                <i class="nav-icon fas fa-tree"></i>
                <p> Pohon Keputusan </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('data_user.php') ?>" accesskey='5' class="nav-link <?php if ($thisPage == "DATA SISWA") echo "active"; ?>">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p> Data Siswa </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('hasil_prediksi.php') ?>" accesskey='6' class="nav-link <?php if ($thisPage == "HASIL PREDIKSI") echo "active"; ?>">
                <i class="nav-icon fas fa-calculator"></i>
                <p> Hasil Prediksi </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('uji_rule.php') ?>" accesskey='7' class="nav-link <?php if ($thisPage == "DATA UJI") echo "active"; ?>">
                <i class="nav-icon fas fa-user-cog"></i>
                <p> Data Uji </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>