<?php
require 'sidebar.php';
require 'navbar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Training</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Data Training</li>
          </ol>

        </div><!-- /.col -->
        <div class="mt-3">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus-circle"> Tambah Data Training</i>
          </button>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus-circle"> Hapus Data Training </i>
          </button>
          <button type="button" class="btn btn-light btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus-circle"> Import Data Training </i>
          </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Input addon -->
                <div class="card card-info">
                  <div class="card-body">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                      </div>
                      <input type="text" class="form-control" placeholder="Username">
                    </div>

                    <div class="input-group mb-3">
                      <input type="text" class="form-control">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="text" class="form-control">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>

                    <h4>With icons</h4>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="input-group mb-3">
                      <input type="text" class="form-control">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                      </div>
                    </div>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-dollar-sign"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control">
                      <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-ambulance"></i></div>
                      </div>
                    </div>

                    <h5 class="mt-4 mb-2">With checkbox and radio inputs</h5>

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="checkbox">
                            </span>
                          </div>
                          <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                      </div>
                      <!-- /.col-lg-6 -->
                      <div class="col-lg-6">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><input type="radio"></span>
                          </div>
                          <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                      </div>
                      <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->

                    <h5 class="mt-4 mb-2">With buttons</h5>

                    <p>Large: <code>.input-group.input-group-lg</code></p>

                    <div class="input-group input-group-lg mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                          Action
                        </button>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a href="#">Action</a></li>
                          <li class="dropdown-item"><a href="#">Another action</a></li>
                          <li class="dropdown-item"><a href="#">Something else here</a></li>
                          <li class="dropdown-divider"></li>
                          <li class="dropdown-item"><a href="#">Separated link</a></li>
                        </ul>
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control">
                    </div>
                    <!-- /input-group -->

                    <p>Normal</p>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger">Action</button>
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control">
                    </div>
                    <!-- /input-group -->

                    <p>Small <code>.input-group.input-group-sm</code></p>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat">Go!</button>
                      </span>
                    </div>
                    <!-- /input-group -->
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</div>
<!-- /.content-header -->

<!-- Button trigger modal -->

<script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
<?php
require 'footer.php';
?>