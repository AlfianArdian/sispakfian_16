<html>

<head>
  <title>Sistem pakar kulit wajah</title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>


  <div class="container">
    <div class="menu">
      <ul>
        <e><img src="<?php echo base_url('assets/img/Icon_stetoskop_putih.png'); ?>"></e>
        <div class="logo"><a>SELAMAT DATANG</a></div>
        <?php
        if ($this->session->userdata('email')) {
          $log = 'Logout';
          $url = 'logout';
          $link = base_url('admin');
          $menu = '<li>' . '<a href="' . $link . '">' . "Admin" . '</a>' . '</li>';
        } else {
          $log = 'Daftar';
          $url = 'registrasi';
          $menu = '';
        }
        ?>
        <?= $menu; ?>
        <a href="<?= base_url("auth/" . $url); ?>" class="signup-btn"><span><?= $log; ?></span></a>
      </ul>
    </div>
  </div>
  </div>
  <div class="banner">
    <div class="app-text">
      <img src="<?= base_url('assets/img/'); ?>Logo_Snowhite_Bundar.png" />
      <p>
        Sistem pakar untuk medeteksi
        <br>
        kelainan kulit wajah manusia
        <br>
        Menggunakan metode teorema bayes
      </p>
      <div class="play-btn">
        <div class="play-btn-inner">
          <a href="<?= base_url('home/diagnosa'); ?>"><i class="fa fa-play"></i></a>
        </div>
        <small><b><a style="text-decoration: none; color: #19dafa;" href="<?= base_url('home/diagnosa'); ?>">Mulai Diagnosa</a></b></small>
      </div>
    </div>
    <div class="app-picture">
      <img src="<?= base_url('assets/img/'); ?>homepage.png" />
    </div>
  </div>
  </div>
</body>

</html>