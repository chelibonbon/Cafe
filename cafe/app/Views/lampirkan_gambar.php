<div class="container">
  <h2>Lampirkan Gambar</h2>
  <img src="<?= base_url('uploads/'.$child->foto_pembayaran) ?>" class="img-fluid mb-3" style="max-width: 400px;">


  <div class="d-flex gap-2">
    <a href="<?= base_url('home/accept_payment/'.$child->id_nota) ?>" class="btn btn-success">Terima</a>
    <a href="<?= base_url('home/reject_payment/'.$child->id_nota) ?>" class="btn btn-danger">Tolak</a>
    <a href="<?= base_url('home/tabel_nota') ?>" class="btn btn-secondary">Kembali</a>
  </div>
</div>

