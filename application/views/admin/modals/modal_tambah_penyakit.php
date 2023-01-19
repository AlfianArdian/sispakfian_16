<!-- Modal Tambah -->
<div class="modal fade" id="newPenyakitModal" tabindex="-1" role="dialog" aria-labelledby="forModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="apasih">Tambah Penyakit</h5>
      </div>
      <form action="<?= base_url('penyakit/tambahPenyakit'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="kode" name="kode" value="<?= $kode; ?>" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" placeholder="Nama Penyakit" required>
          </div>
          <div class="form-group">
            <textarea name="saran" id="saran" class="resizable_textarea form-control" placeholder="Saran" required></textarea>
          </div>
          <div class="form-group">
            <textarea name="informasi" id="informasi" class="resizable_textarea form-control" placeholder="Info Penyakit" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-round btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>