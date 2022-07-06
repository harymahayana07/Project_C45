 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
   </ul>
   <ul class="navbar-nav ml-auto">
     <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-user"></i></a>
     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
       <div class="card-footer">
         <div class="row">
           <div class="col">
             <a class="dropdown-item <?php if ($thisPage == "Password") echo "active";?> text-dark" href="<?= base_url('ubah_password.php') ?>">
               <i class="fas fa-sync-alt" style="margin-right: 4px;"></i> Password </a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item text-dark" href="<?= base_url('auth/logout.php') ?>">
               <i class="fas fa-sign-out-alt" style="margin-right: 4px;"></i> Sign Out </a>
           </div>
         </div>
       </div>
     </div>
   </ul>
 </nav>