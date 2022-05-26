 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
   </ul>
   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
     <!-- Notifications Dropdown Menu -->
     <li class="nav-item dropdown">
       <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-user"></i> </a>
       <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <div class="card-group">
           <div class="card-body bg-primary " style="text-align: center;">
             <h5 class="card-title">Login Sebagai :</h5>
             <p class="card-text mt-4"> <b><?= $_SESSION['nama'] ?></b> </p>
           </div>
           <div class="card-footer">
             <div class="row">
               <div class="col">
                 <a href="<?= base_url('auth/ubah_password.php') ?>" class="btn btn-secondary" role="button" data-bs-toggle="button"><i class="fas fa-key"></i> Ubah Sandi</a>
                 <a href="<?= base_url('auth/logout.php') ?>" class="btn btn-danger" role="button" data-bs-toggle="button"><i class="fas fa-sign-out-alt"></i> LogOut</a>
               </div>
             </div>
           </div>
         </div>
       </div>
     </li>
   </ul>
 </nav>
 <!-- /.navbar -->