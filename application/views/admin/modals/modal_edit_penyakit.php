<!-- Modal Edit -->
<?php foreach ($penyakit as $p) : ?>
  <div class="modal fade" id="editPenyakitModal<?= $p['nama_penyakit']; ?>" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="apasih">Edit Penyakit</h5>
        </div>
        <form action="<?= base_url('penyakit/editPenyakit'); ?>" method="post">
          <input type="hidden" name="id" value="<?= $p['nama_penyakit']; ?>">
          <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" id="kode" name="kode" value="<?= $p['kode']; ?>" readonly>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" value="<?= $p['nama_penyakit']; ?>">
            </div>
            <div class="form-group">
              <textarea name="saran" id="saran" class="resizable_textarea form-control"><?= $p['saran']; ?></textarea>
            </div>
            <div class="form-group">
              <textarea name="informasi" id="informasi" class="resizable_textarea form-control"><?= $p['informasi']; ?></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-round btn-primary">Edit</button>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
<?php endforeach; ?>