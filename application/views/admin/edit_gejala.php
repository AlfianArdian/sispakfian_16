<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            </div>

            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="card shadow mb-4 col-lg-6 col-sm-12 bg-1">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-white">Edit gejala</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <?php
                        if ($gejala == null) {
                            $this->session->set_flashdata('flash', 'pilih data untuk diedit!');
                            redirect('admin/gejala');
                        }
                        foreach ($gejala as $g) :
                        ?>
                            <input type="hidden" name="id" id="id" class="form-control" value="<?= $g->id_gejala; ?>">

                            <div class="form-group">
                                <?php
                                $save = $this->input->post('update');
                                if (!isset($save)) {
                                    $is_error = '';
                                } else {
                                    if (!empty(form_error('kode'))) {
                                        $is_error = 'is-invalid';
                                    } else if (form_error('kode') == '') {
                                        $is_error = 'is-valid';
                                    }
                                }
                                ?>
                                <label for="kode">Kode Gejala</label>
                                <input type="text" class="form-control <?= $is_error; ?>" name="kode" id="kode" placeholder="kode gejala" autofocus autocomplete="off" required value="<?= set_value('kode', $g->kode); ?>" readonly>
                                <div class="invalid-feedback" id="invalid_kode">
                                    <?= form_error('kode'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php
                                $save = $this->input->post('update');
                                if (!isset($save)) {
                                    $is_error = '';
                                } else {
                                    if (!empty(form_error('gejala'))) {
                                        $is_error = 'is-invalid';
                                    } else if (form_error('gejala') == '') {
                                        $is_error = 'is-valid';
                                    }
                                }
                                ?>
                                <label for="gejala">Gejala</label>
                                <input type="text" class="form-control <?= $is_error; ?>" name="gejala" id="gejala" placeholder="describe your gejala..." autocomplete="off" required value="<?php echo set_value('gejala', $g->gejala); ?>">
                                <div class="invalid-feedback" id="invalid_gejala">
                                    <?= form_error('gejala'); ?>
                                </div>
                            </div>
                            <!-- 
                            <div class="form-group">
                                <?php
                                $save = $this->input->post('update');
                                if (!isset($save)) {
                                    $is_error = '';
                                } else {
                                    if (!empty(form_error('nama_penyakit'))) {
                                        $is_error = 'is-invalid';
                                    } else if (form_error('nama_penyakit') == '') {
                                        $is_error = 'is-valid';
                                    }
                                }
                                ?>
                                <label for="nama_penyakit">Nama penyakit</label>
                                <input type="text" class="form-control <?= $is_error; ?>" name="nama_penyakit" id="nama_penyakit" placeholder="Nama Penyakit" autocomplete="off" required value="<?php echo set_value('nama_penyakit', $g->nama_penyakit); ?>">
                                <div class="invalid-feedback" id="invalid_nama_penyakit">
                                    <?= form_error('nama_penyakit'); ?>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <?php
                                $save = $this->input->post('update');
                                if (!isset($save)) {
                                    $is_error = '';
                                } else {
                                    if (!empty(form_error('nama_penyakit'))) {
                                        $is_error = 'is-invalid';
                                    } else if (form_error('nama_penyakit') == '') {
                                        $is_error = 'is-valid';
                                    }
                                }
                                ?>
                                <label for="nama_penyakit">Nama Penyakit</label>
                                <select class="form-control <?= $is_error; ?>" name="nama_penyakit" id="nama_penyakit">
                                    <?php foreach ($penyakit as $p) : ?>
                                        <?php ($p['nama_penyakit'] == $g->nama_penyakit) ? $is_selected = 'selected' : $is_selected = ''; ?>
                                        <option value="<?= $p['nama_penyakit']; ?>" <?= $is_selected; ?> <?= set_select('nama_penyakit', $p['nama_penyakit']); ?>>
                                            <?= $p['nama_penyakit']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback" id="invalid_nama_penyakit">
                                    <?= form_error('nama_penyakit'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php
                                $save = $this->input->post('update');
                                if (!isset($save)) {
                                    $is_error = '';
                                } else {
                                    if (!empty(form_error('bobot'))) {
                                        $is_error = 'is-invalid';
                                    } else if (form_error('bobot') == '') {
                                        $is_error = 'is-valid';
                                    }
                                }
                                ?>
                                <label for="bobot">Bobot</label>
                                <input type="number" step="0.00000000001" min="0" max="1" class="form-control <?= $is_error; ?>" name="bobot" id="bobot" placeholder="bobot gejala" autocomplete="off" required value="<?php echo set_value('bobot', $g->bobot); ?>">
                                <div class="invalid-feedback" id="invalid_bobot">
                                    <?= form_error('bobot'); ?>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        <button class="btn btn-primary form-control" name="update" id="update" type="submit">Save changes</button>
                        <a class="btn btn-secondary form-control mt-2" href="<?= base_url('Admin/gejala'); ?>">batal</a>
                    </form>
                </div>
            </div>
        </div>