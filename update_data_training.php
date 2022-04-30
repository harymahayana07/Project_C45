<!-- Modal update data -->
<?php
$sql = mysql_query("SELECT * FROM data_training WHERE id='$_GET[id]'");
$row = mysql_fetch_array($sql);
$ppdb = $row[1];
$bhs_indonesia = $row[2];
$matematika = $row[3];
$bhs_inggris = $row[4];
$ipa = $row[5];
$ips = $row[6];
$skhu = $row[7];
$jurusan = $row[8];
if (isset($_POST['submit'])) {
  mysql_query("UPDATE data_training SET
                     ppdb = '$_POST[txtppdb]',
                     bhs_indonesia = '$_POST[txtbhs_id]',
                     matematika = '$_POST[txtmtk]',
                     bhs_inggris = '$_POST[txtbhs_ing]',
                     ipa = '$_POST[txtipa]',
                     ips = '$_POST[txtips]',
                     skhu = '$_POST[txtskhu]',
                     jurusan = '$_POST[peminatan]'
                     WHERE id = '$_GET[id]'");
  echo "<center><h3>Berhasil update</h3></center>";
} else {
?>
  <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="tambahDataModal">Update Data Training</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- Input addon -->
          <!--  -->
          <div class="card card-info">
            <div class="card-body">

              <!-- ppdb -->
              <form method="post" action="">
                <div class="form-group">

                  <label for="ppdb">PPDB :</label>
                  <select name="txtppdb" id="ppdb" class="form-control" required autofocus>
                    <option value="Prestasi Akademik" <?php if ($ppdb == 'Prestasi Akademik') {
                                                        echo 'selected';
                                                      } ?>>Prestasi Akademik</option>
                    <option value="Prestasi Non-Akademik" <?php if ($ppdb == 'Prestasi Non-Akademik') {
                                                            echo 'selected';
                                                          } ?>>Prestasi Non-Akademik</option>
                    <option value="Prestasi Tahfidz" <?php if ($ppdb == 'Prestasi Tahfidz') {
                                                        echo 'selected';
                                                      } ?>>Prestasi Tahfidz</option>
                    <option value="Afirmasi" <?php if ($ppdb == 'Afirmasi') {
                                                echo 'selected';
                                              } ?>>Afirmasi</option>
                    <option value="PPLP" <?php if ($ppdb == 'PPLP') {
                                            echo 'selected';
                                          } ?>>PPLP</option>
                    <option value="Zonasi" <?php if ($ppdb == 'Zonasi') {
                                              echo 'selected';
                                            } ?>>Zonasi</option>
                    <option value="Perpindahan Orang tua" <?php if ($ppdb == 'Perpindahan Orang tua') {
                                                            echo 'selected';
                                                          } ?>>Perpindahan Orang tua</option>
                  </select>
                </div>
                <!-- Nilai bahasa indonesia -->
                <div class="form-group">
                  <label for="indo">Nilai Bahasa Indonesia :</label>
                  <input type="text" name="txtbhs_id" value=<?php echo $bhs_indonesia; ?> id="indo" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <!-- Nilai Matematika -->
                <div class="form-group">
                  <label for="math">Nilai Matematika :</label>
                  <input type="text" name="txtmtk" value=<?php echo $matematika; ?> id="math" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <!-- Nilai bahasa inggris -->
                <div class="form-group">
                  <label for="ing">Nilai Bahasa Inggris :</label>
                  <input type="text" name="txtbhs_ing" value=<?php echo $bhs_inggris; ?> id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <!-- Nilai ipa -->
                <div class="form-group">
                  <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                  <input type="text" name="txtipa" value=<?php echo $ipa; ?> id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <!-- Nilai ips -->
                <div class="form-group">
                  <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                  <input type="text" name="txtips" value=<?php echo $ips; ?> id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <!-- Nilai skhu -->
                <div class="form-group">
                  <label for="hu">Nilai SKHU :</label>
                  <input type="text" name="txtskhu" value=<?php echo $skhu; ?> id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <!-- jurusan jurusan -->
                <div class="form-group">
                  <label for="jp">Jurusan Peminatan :</label>
                  <br>
                  <input type='radio' name='peminatan' value='IPA' <?php if ($jurusan == 'IPA') {
                                                                      echo 'checked';
                                                                    } ?> required="required"> IPA &nbsp;&nbsp;&nbsp;
                  <input type='radio' name='peminatan' value='IPS' <?php if ($jurusan == 'IPS') {
                                                                      echo 'checked';
                                                                    } ?> required="required"> IPS &nbsp;&nbsp;&nbsp;
                  <input type='radio' name='peminatan' value='BAHASA' <?php if ($jurusan == 'BAHASA') {
                                                                        echo 'checked';
                                                                      } ?> required="required"> BAHASA
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

      </div>
    </div>
  </div>
<?php
}
?>
<a href='index.php?menu=data' accesskey='5' title='Kembali'>
  << kembali</a>