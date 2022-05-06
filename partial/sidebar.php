<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="200" width="200">
    </div>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMAN 2 MATARAM</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['nama'] ?></a>
            <button type="button" class="btn btn-block btn-success btn-xs"><?= $_SESSION['lvl'] ?></button>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
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
              <a href="dashboard.php" accesskey='1' class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Dashboard </i></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="data_training.php" accesskey='2' class="nav-link">
                <i class="nav-icon fas fa-server"></i>
                <p> Data Training</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="mining.php" accesskey='3' class="nav-link">
                <i class="nav-icon fab fa-cloudscale"></i>
                <p> Mining </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pohon_tree.php" accesskey='4' class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p> Pohon Keputusan </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="hasil_prediksi.php" accesskey='5' class="nav-link">
                <i class="nav-icon fas fa-calculator"></i>
                <p> Hasil Prediksi </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="data_user.php" accesskey='6' class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p> Data Siswa </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" accesskey='7' class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p style="color: red;"> LogOut </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>