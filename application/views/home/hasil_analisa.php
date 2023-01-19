<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Gejala</title>
  <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_hasil_diagnosis.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>

  <div class="container3">
    <div class="menu">
      <ul>
        <li class="active"><a class="active" href="<?= base_url('home'); ?>">Home</a></li>
        <li>
          <?php
          if ($this->session->userdata('email')) {
            $log = 'Logout';
            $url = 'logout';
          } else {
            $log = 'Sign Up';
            $url = 'registrasi';
          }
          ?>
          <a href="<?= base_url("auth/" . $url); ?>" class="signup-btn"><span><?= $log; ?></span></a>
        </li>
      </ul>
    </div>
  </div>
  <div class="about-section">
    <div class="inner-width">
      <h1>Hasil Diagnosa</h1>
      <div class="border mb-3"></div>
      <div class="row mb-3">
        <div class="col d-flex justify-content-center">
          <button type="button" class="btn btn-primary btn-sm"><?= $probabilitas_penyakit[0]->nama_penyakit; ?></button>
        </div>
      </div>
      <div class="about-section-row">
        <div class="about-section-col">
          <div class="about">
            <p>
              <b>Info Penyakit</b><br>
              <?= $probabilitas_penyakit[0]->informasi; ?>
            </p>
            <p>
              <b>Saran</b><br>
              <?= $probabilitas_penyakit[0]->saran; ?>
            </p>
          </div>
        </div>
        <!-- partial -->
        <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body bg-light">
              <!-- <h4 class="card-title">Bar chart</h4> -->
              <canvas id="barChart" style="height:230px"></canvas>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

      </div>
    </div>
  </div>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Gejala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


  </head>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<!-- Custom js for this page -->
<script src="<?= base_url('/assets/js/templates/chart/chart.js'); ?>"></script>
<!-- Plugin js for this page -->
<script src="<?= base_url('/assets/vendors/Chart.js/Chart.min.js'); ?>"></script>
<!-- End plugin js for this page -->

</body>

</html>
</body>

</html>