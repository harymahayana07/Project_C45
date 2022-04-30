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

             <!-- ppdb -->
             <form method="post" action="data_training.php">
               <div class="form-group">

                 <label for="ppdb">PPDB :</label>

                 <select name="txtppdb" id="ppdb" class="form-control" required autofocus>
                   <option value=""> <i>---Pilih--- <i class="bi bi-caret-down-fill"></i></i> </option>
                   <option value="Prestasi Akademik">Prestasi Akademik</option>
                   <option value="Prestasi Non-Akademik">Prestasi Non-Akademik</option>
                   <option value="Prestasi Tahfidz">Prestasi Tahfidz</option>
                   <option value="Afirmasi">Afirmasi</option>
                   <option value="PPLP">PPLP</option>
                   <option value="Zonasi">Zonasi</option>
                   <option value="Perpindahan Orang tua">Perpindahan Orang tua</option>
                 </select>
               </div>
               <!-- Nilai bahasa indonesia -->
               <div class="form-group">
                 <label for="indo">Nilai Bahasa Indonesia :</label>
                 <input type="number" name="txtbhs_id" id="indo" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
               </div>
               <!-- Nilai Matematika -->
               <div class="form-group">
                 <label for="math">Nilai Matematika :</label>
                 <input type="number" name="txtmtk" id="math" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
               </div>
               <!-- Nilai bahasa inggris -->
               <div class="form-group">
                 <label for="ing">Nilai Bahasa Inggris :</label>
                 <input type="number" name="txtbhs_ing" id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
               </div>
               <!-- Nilai ipa -->
               <div class="form-group">
                 <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                 <input type="number" name="txtipa" id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
               </div>
               <!-- Nilai ips -->
               <div class="form-group">
                 <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                 <input type="number" name="txtips" id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
               </div>
               <!-- Nilai skhu -->
               <div class="form-group">
                 <label for="hu">Nilai SKHU :</label>
                 <input type="number" name="txtskhu" id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
               </div>
               <!-- jurusan jurusan -->
               <div class="form-group">
                 <label for="jp">Jurusan Peminatan :</label>
                 <br>
                 <input type='radio' name='peminatan' value='MIPA' required="required"> IPA &nbsp;&nbsp;&nbsp;
                 <input type='radio' name='peminatan' value='IPS' required="required"> IPS &nbsp;&nbsp;&nbsp;
                 <input type='radio' name='peminatan' value='BHS' required="required"> BAHASA
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
			                      	(ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan)
                            VALUES(
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