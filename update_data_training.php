<?php
require "partial/headers.php";
require "partial/sidebar.php";
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="m-0">&emsp;<i class="fas fa-edit"></i>&nbsp;EDIT DATA TRAINING</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Data Training</li>
            <li class="breadcrumb-item active">Update</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt-2">
    <div class="col-md-6">
      <div class="content-header">
        <div class="container-fluid">
          <?php
          $query = mysql_query("SELECT * FROM data_training WHERE id='$_GET[id]'");
          $row = mysql_fetch_array($query);
          $jk = $row[1];
          $ppdb = $row[2];
          $bhs_indonesia = $row[3];
          $matematika = $row[4];
          $bhs_inggris = $row[5];
          $ipa = $row[6];
          $ips = $row[7];
          $skhu = $row[8];
          $jurusan = $row[9];

          if (isset($_POST['submit_data_training'])) :
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

              $update = mysql_query("UPDATE data_training SET
                     jk = '$jk',
                     ppdb = '$ppdb',
                     bhs_indonesia = '$bhs_indo',
                     matematika = '$mtk',
                     bhs_inggris = '$bhs_ing',
                     ipa = '$ipa',
                     ips = '$ips',
                     skhu = '$skhu',
                     jurusan = '$jurusan'
                     WHERE id = '$_GET[id]'");

              if ($update) {
                $sts[] = 'Data berhasil disimpan';
              } else {
                $sts[] = 'Data gagal disimpan';
              }
            endif;
          endif;

          ?>
          <?php if (!empty($sts)) : ?>
            <?php foreach ($sts as $st) : ?>
              <?php print_msg($st) ?>
            <?php endforeach; ?>
          <?php
          endif;
          ?>
          <div class="card">
            <div class="card-body">
              <form method="post" action="">
                <div class="form-group">
                  <label for="jk1">Jenis Kelamin :</label>
                  <select id="jk1" name="jk" class="form-control" required autofocus>
                    <option value="1" <?php if ($jk == '1') {
                                        echo 'selected';
                                      } ?>>Laki-laki</option>
                    <option value="2" <?php if ($jk == '2') {
                                        echo 'selected';
                                      } ?>>Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ppdb">PPDB :</label>
                  <select name="txtppdb" id="ppdb" class="form-control" required>
                    <option value="1" <?php if ($ppdb == '1') {
                                        echo 'selected';
                                      } ?>>Perpindahan Orang tua</option>
                    <option value="2" <?php if ($ppdb == '2') {
                                        echo 'selected';
                                      } ?>>Prestasi Akademik</option>
                    <option value="3" <?php if ($ppdb == '3') {
                                        echo 'selected';
                                      } ?>>Prestasi Non-Akademik</option>
                    <option value="4" <?php if ($ppdb == '4') {
                                        echo 'selected';
                                      } ?>>Prestasi Thafidz</option>
                    <option value="5" <?php if ($ppdb == '5') {
                                        echo 'selected';
                                      } ?>>Afirmasi</option>
                    <option value="6" <?php if ($ppdb == '6') {
                                        echo 'selected';
                                      } ?>>Zonasi</option>
                    <option value="7" <?php if ($ppdb == '7') {
                                        echo 'selected';
                                      } ?>>PPLP</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="indo">Nilai Bahasa Indonesia :</label>
                  <input type="number" name="txtbhs_id" value=<?php echo $bhs_indonesia; ?> id="indo" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="math">Nilai Matematika :</label>
                  <input type="number" name="txtmtk" value=<?php echo $matematika; ?> id="math" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="ing">Nilai Bahasa Inggris :</label>
                  <input type="number" name="txtbhs_ing" value=<?php echo $bhs_inggris; ?> id="ing" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="alam">Nilai Ilmu Pengetahuan Alam :</label>
                  <input type="number" name="txtipa" value=<?php echo $ipa; ?> id="alam" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="sosial">Nilai Ilmu Pengetahuan Sosial :</label>
                  <input type="number" name="txtips" value=<?php echo $ips; ?> id="sosial" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="hu">Nilai SKHU :</label>
                  <input type="number" name="txtskhu" value=<?php echo $skhu; ?> id="hu" style="width: 100px;" class="form-control" placeholder="98.5" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="jp">Jurusan Peminatan :</label>
                  <br>
                  <input type='radio' name='peminatan' value='MIPA' <?php if ($jurusan == 'MIPA') {
                                                                      echo 'checked';
                                                                    } ?> required="required"> MIPA &nbsp;&nbsp;&nbsp;
                  <input type='radio' name='peminatan' value='IPS' <?php if ($jurusan == 'IPS') {
                                                                      echo 'checked';
                                                                    } ?> required="required"> IPS &nbsp;&nbsp;&nbsp;
                </div>
            </div>
          </div>
          <div>
            <a href="<?= base_url('data_training.php') ?>" class="btn btn-secondary" accesskey='5' title='Kembali'> Kembali </a>
            <input type="submit" name="submit_data_training" class="btn btn-primary" value="Simpan">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>