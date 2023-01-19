<!-- Modal Tambah -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="apasih">Tambah Gejala</h5>
      </div>
      <form action="<?= base_url('gejala/tambahGejala'); ?>" id="tambah_gejala" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $kode; ?>" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="gejala" name="gejala" placeholder="Nama gejala" required>
          </div>
          <div class="form-group">
            <select class="form-control" name="nama_penyakit" id="nama_penyakit">
              <option value="">Pilih Nama Penyakit</option>
              <?php foreach ($penyakit as $p) : ?>
                <option value="<?= $p['nama_penyakit']; ?>" <?= set_select('nama_penyakit', $p['nama_penyakit']); ?>>
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
            <input type="number" step="0.00000000001" min="0" max="1" class="form-control <?= $is_error; ?>" id="bobot" name="bobot" placeholder="Bobot" required>
            <div class="invalid-feedback" id="invalid_bobot">
              <?= form_error('bobot'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-round btn-primary" id="save">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>