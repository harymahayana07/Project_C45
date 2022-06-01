 <!-- Modal tambah data -->
 <div class="modal fade" id="tambahDataTraining" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header bg-info">
         <h5 class="modal-title" id="tambahDataModal">Tambah Data Training</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">

         <!-- Input addon -->
         <!--  -->
         <div class="card card-info">
           <div class="card-body">

             <!-- jenis kelamin-->
             <form method="post" action="data_training.php">
               <div class="form-group">
                 <label for="jk1">Jenis Kelamin :</label>
                 <select name="jk" id="jk1" class="form-control" required autofocus>
                   <option value="1">Laki-laki</option>
                   <option value="2">Perempuan</option>
                 </select>
               </div>
               <!-- ppdb -->
               <div class="form-group">
                 <label for="ppdb">PPDB :</label>
                 <select name="txtppdb" id="ppdb" class="form-control" required autofocus>
                   <option value=""> <i> ---Pilih--- <i class="bi bi-caret-down-fill"></i></i> </option>
                   <option value="1">Perpindahan Orang tua</option>
                   <option value="2">Prestasi Akademik</option>
                   <option value="3">Prestasi Non-Akademik</option>
                   <option value="4">Prestasi Tahfidz</option>
                   <option value="5">Afirmasi</option>
                   <option value="6">Zonasi</option>
                   <option value="7">PPLP</option>
                 </select>
               </div>
               <!-- Nilai bahasa indonesia -->
               <div class="form-group">
                 <label for="indo">Nilai Bahasa Indonesia :</label>
                 <input type="text" name="txtbhs_id" id="indo" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <!-- Nilai Matematika -->
               <div class="form-group">
                 <label for="math">Nilai Matematika :</label>
                 <input type="text" name="txtmtk" id="math" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <!-- Nilai bahasa inggris -->
               <div class="form-group">
                 <label for="ing">Nilai Bahasa Inggris :</label>
                 <input type="text" name="txtbhs_ing" id="ing" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <!-- Nilai ipa -->
               <div class="form-group">
                 <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                 <input type="text" name="txtipa" id="alam" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <!-- Nilai ips -->
               <div class="form-group">
                 <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                 <input type="text" name="txtips" id="sosial" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <!-- Nilai skhu -->
               <div class="form-group">
                 <label for="hu">Nilai SKHU :</label>
                 <input type="text" name="txtskhu" id="hu" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <!-- jurusan jurusan -->
               <div class="form-group">
                 <label for="jp">Jurusan :</label>
                 <br>
                 <input type='radio' name='peminatan' value='MIPA' required="required"> MIPA &nbsp;&nbsp;&nbsp;
                 <input type='radio' name='peminatan' value='IPS' required="required"> IPS &nbsp;&nbsp;&nbsp;

               </div>
               <!--  -->
           </div>
           <!-- /.card-body -->
         </div>
       </div>
       <div class="modal-footer">
         <input type="button" class="btn btn-secondary" value="Batal" data-bs-dismiss="modal">
         <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
       </div>
       </form>
       <?php
        if (isset($_POST['submit'])) {
          mysql_query("INSERT INTO data_training 
			                      	(jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan)
                            VALUES(
                              '$_POST[jk]',
                              '$_POST[txtppdb]',
                              '$_POST[txtbhs_id]',
                              '$_POST[txtmtk]',
                              '$_POST[txtbhs_ing]',
                              '$_POST[txtipa]',
                              '$_POST[txtips]',
                              '$_POST[txtskhu]',
                              '$_POST[peminatan]'
                            )");
        }
        ?>
     </div>
   </div>
 </div>