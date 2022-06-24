  <?php if (!empty($sts)) : ?>
      <?php foreach ($sts as $st) : ?>
          <div style="margin-left: 9px; margin-right: 9px;">
              <?php
                echo '<div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href=""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></a>&emsp;' . $st . '</div>';
                ?>
          </div>
      <?php endforeach; ?>
  <?php
    endif;
    ?>

  <?php
    $status = isset($_GET['status_hapus']) ? $_GET['status_hapus'] : '';
    $msg = '';
    switch ($status):
        case 'sukses-hapus':
            $msg = 'Data berhasil dihapus';
            break;
    endswitch;

    if ($msg) : ?>
      <div style="margin-left: 9px; margin-right: 9px;">
          <div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="data_training.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
      </div>
  <?php endif; ?>

  <?php
    $status_all = isset($_GET['status_import']) ? $_GET['status_import'] : '';
    $msg = '';
    switch ($status_all):
        case 'sukses-import':
            $msg = 'Data berhasil disimpan';
            break;
        case 'gagal-import':
            $msg = 'Data gagal disimpan periksa file excel anda';
            break;
    endswitch;

    if ($msg) : ?>
      <div style="margin-left: 9px; margin-right: 9px;">
          <div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="data_training.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
      </div>
  <?php endif; ?>

  <?php
    $status = isset($_GET['status_hapus_all']) ? $_GET['status_hapus_all'] : '';
    $msg = '';
    switch ($status):
        case 'sukses-hapus-all':
            $msg = 'Semua Data berhasil dihapus';
            break;
    endswitch;

    if ($msg) : ?>
      <div style="margin-left: 9px; margin-right: 9px;">
          <div class="col-md-6 col-md-3 alert alert-info"><i class="fas fa-check-circle"></i><a href="data_training.php"><button type="button" class="close"><span>&times;</span></button></a>&emsp;<?php echo $msg; ?></div>
      </div>
  <?php endif; ?>