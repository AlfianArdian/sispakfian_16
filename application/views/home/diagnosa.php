<html>

<head>
  <title>Halaman diagnosa</title>
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>style_diagnosa.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="menu">
      <ul>
        <i class="fa fa-user-md"></i>
        <li class="active"><a class="active" href="<?= base_url('home'); ?>">Home</a></li>
        <li>
          <a href="<?= base_url('auth/logout'); ?>" class="signup-btn"><span>Logout</span></a>
        </li>
      </ul>
    </div>

    <form class="form" action="<?= base_url('diagnosa/kalkulasi'); ?>" method="POST">
      <h2 style="color: #b2b1b1; text-align: center;">Daftar Gejala</h2>
      <?php
      $i = 1 ?>
      <?php foreach ($gejala as $g) : ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="gejala_<?= $i++; ?>" value="<?= $g->id_gejala; ?>" id="gejala">
          <label class="form-check-label" for="flexCheckDefault">
            <?= $g->gejala; ?>
          </label>
        </div>
      <?php endforeach; ?>
      <input type="hidden" name="total_gejala" value="<?= $i; ?>">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button class="btn third" type="reset">Reset</button>
    </form>
  </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>