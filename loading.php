<?php include "conn/koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Loader</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/loading.css') ?>" />
</head>

<body>
  <div class="loading-area">
    <span class="loader"><img src="dist/img/logo.png" style="width:90px;" alt="">
      <p><i>Loading...</i></p>
    </span>
    <span class="load_anim1"></span>
    <span class="load_anim2"></span>
  </div>
</body>

</html>