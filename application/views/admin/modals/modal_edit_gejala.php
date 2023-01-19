<!-- Modal Edit -->
<?php foreach ($gejala as $g) : ?>

  <div class="modal fade" id="editGejalaModal<?= $g['id_gejala']; ?>" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="apasih">Edit Gejala</h5>
          <form action="<?= base_url('gejala/editGejala'); ?>" id="edit_gejala" method="post">
        </div>
        <input type="hidden" name="id" id="id_gejala" value="<?= $g['id_gejala']; ?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $g['kode']; ?>" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="gejala" name="gejala" value="<?= $g['gejala']; ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" value="<?= $g['nama_penyakit']; ?>">
          </div>
          <div class="form-group">
            <?php
            $save = $this->input->post('save');
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
            <input type="number" step="0.00000000001" min="0" max="1" class="form-control <?= $is_error; ?> " id="bobot" name="bobot" value="<?= $g['bobot']; ?>">
            <div class="invalid-feedback" id="invalid_bobot">
              <?= form_error('bobot'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-round btn-primary" name="save">Edit</button>
          <script src="<?= base_url('assets/js/ajax_gejala.js') ?>"></script>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>