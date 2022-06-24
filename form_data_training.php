 <div class="modal fade" id="tambahDataTraining" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header bg-info">
         <h5 class="modal-title" id="tambahDataModal">Tambah Data Training</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <div class="card card-info">
           <div class="card-body">
             <form method="post" action="">
               <div class="form-group">
                 <label for="jk1">Jenis Kelamin :</label>
                 <select name="jk" id="jk1" class="form-control" required autofocus>
                   <option value="1">Laki-laki</option>
                   <option value="2">Perempuan</option>
                 </select>
               </div>
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
               <div class="form-group">
                 <label for="indo">Nilai Bahasa Indonesia :</label>
                 <input type="number" name="txtbhs_id" id="indo" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <div class="form-group">
                 <label for="math">Nilai Matematika :</label>
                 <input type="number" name="txtmtk" id="math" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <div class="form-group">
                 <label for="ing">Nilai Bahasa Inggris :</label>
                 <input type="number" name="txtbhs_ing" id="ing" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <div class="form-group">
                 <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                 <input type="number" name="txtipa" id="alam" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <div class="form-group">
                 <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                 <input type="number" name="txtips" id="sosial" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <div class="form-group">
                 <label for="hu">Nilai SKHU :</label>
                 <input type="number" name="txtskhu" id="hu" style="width: 100px;" class="form-control" placeholder="98" required autocomplete="off">
               </div>
               <div class="form-group">
                 <label for="jp">Jurusan :</label>
                 <br>
                 <input type='radio' name='peminatan' value='MIPA' required="required"> MIPA &nbsp;&nbsp;&nbsp;
                 <input type='radio' name='peminatan' value='IPS' required="required"> IPS &nbsp;&nbsp;&nbsp;
               </div>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <input type="button" class="btn btn-secondary" value="Batal" data-bs-dismiss="modal">
         <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
       </div>
       </form>
       <?php
        if (isset($_POST['submit'])):
          $jk = $_POST['jk'];
          $ppdb = $_POST['txtppdb'];
          $bhs_indo = $_POST['txtbhs_id'];
          $mtk = $_POST['txtmtk'];
          $bhs_ing = $_POST['txtbhs_ing'];
          $ipa = $_POST['txtipa'];
          $ips = $_POST['txtips'];
          $skhu = $_POST['txtskhu'];
          $jurusan = $_POST['peminatan'];

          if (!$jk) {
            $errors[] = 'Jk tidak boleh kosong';
          }
          if (!$ppdb) {
            $errors[] = 'PPDB tidak boleh kosong';
          }
          if (!$bhs_indo) {
            $errors[] = 'BAHASA INDONESIA tidak boleh kosong';
          }
          if (!$mtk) {
            $errors[] = 'MATEMATIKA tidak boleh kosong';
          }
          if (!$bhs_ing) {
            $errors[] = 'BAHASA INGGRIS tidak boleh kosong';
          }
          if (!$ipa) {
            $errors[] = 'IPA tidak boleh kosong';
          }
          if (!$ips) {
            $errors[] = 'IPS tidak boleh kosong';
          }
          if (!$skhu) {
            $errors[] = 'SKHU tidak boleh kosong';
          }
          if (!$jurusan) {
            $errors[] = 'JURUSAN tidak boleh kosong';
          }
           if (empty($errors)) :
          
              $simpan = mysql_query("INSERT INTO data_training (jk,ppdb,bhs_indonesia,matematika,bhs_inggris,ipa,ips,skhu,jurusan) 
              VALUES ('$jk', '$ppdb', '$bhs_indo','$mtk','$bhs_ing','$ipa','$ips','$skhu','$jurusan')");
            
            if ($simpan) {
              $sts[] = 'Data berhasil disimpan';
            } else {
              $sts[] = 'Data gagal disimpan';
            }
          endif;
        endif;
       ?>
     </div>
   </div>
 </div>