        <!-- page content -->
        <div class="right_col" role="main">
          <img src="<?php echo base_url('assets/img/Background_Wanita_2.png'); ?>">
          <div class="row top_tiles">
            <div class="clearfix"></div>
            <div class="x_content">
              <div class="bs-example" data-example-id="simple-jumbotron">
                <div class="jumbotron col-lg-9">
                  <h1>Halo, <?= $user['name']; ?></h1>
                  <p>Selamat datang di dashboard admin. Kamu bisa mengelola <br> data-data aplikasi Sistem Pakar Penyakit kulit ini.</p>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                    <div class="icon"><a href="<?= base_url('admin/gejala'); ?>"><i class="fa fa-users"></i></a></div>
                    <div class="count"><a href="<?= base_url('admin/gejala'); ?>"><?= $jml_gejala; ?></a></div>
                    <h3><a href="<?= base_url('admin/member'); ?>">Gejala</a></h3>
                  </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                    <div class="icon"><a href="<?= base_url('admin/penyakit'); ?>"><i class="fa fa-medkit"></i></a></div>
                    <div class="count"><a href="<?= base_url('admin/penyakit'); ?>"><?= $jml_penyakit; ?></a></div>
                    <h3><a href="<?= base_url('admin/rule'); ?>">Penyakit</a></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- page content -->