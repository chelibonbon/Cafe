<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header">Detail Nota</h5>
      <div class="card-body">

      <!-- Keterangan and Status -->
<div class="mb-4 d-flex">
    <div class="me-3">
        <label class="form-label">Keterangan</label><br>
        <?php if (!empty($data->keterangan)): ?>
            <?php if ($data->keterangan == 'lunas'): ?>
                <span class="badge bg-success">Lunas</span>
            <?php elseif ($data->keterangan == 'gagal'): ?>
                <span class="badge bg-danger">Gagal</span>
            <?php elseif ($data->keterangan == 'pending'): ?>
                <span class="badge bg-warning text-dark">Pending</span>
            <?php else: ?>
                <span class="badge bg-secondary"><?= $data->keterangan ?></span>
            <?php endif; ?>
        <?php else: ?>
            <span class="badge bg-secondary">-</span>
        <?php endif; ?>
    </div>

    <div>
        <label class="form-label">Status Pemesanan</label><br>
        <?php if (!empty($data->status_pemesanan)): ?>
            <?php if ($data->status_pemesanan == 'selesai'): ?>
                <span class="badge bg-success">Selesai</span>
            <?php elseif ($data->status_pemesanan == 'gagal'): ?>
                <span class="badge bg-danger">Gagal</span>
            <?php elseif ($data->status_pemesanan == 'proses'): ?>
                <span class="badge bg-info text-dark">Proses</span>
            <?php else: ?>
                <span class="badge bg-secondary"><?= $data->status_pemesanan ?></span>
            <?php endif; ?>
        <?php else: ?>
            <span class="badge bg-secondary">-</span>
        <?php endif; ?>
    </div>
</div>

<!-- Other fields for detail -->
<div class="row mb-3">
    <div class="col-md-12">
        <label class="form-label">Nomor Nota</label>
        <input type="text" class="form-control" value="<?= $data->nomor_nota ?? '-' ?>" readonly>
    </div>
</div>
<!-- Repeat this structure for other fields like Grand Total, Bayar, Kembali, etc. -->


        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Grand Total</label>
            <input type="text" class="form-control" value="Rp <?= number_format($data->grand_total, 0, ',', '.') ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Bayar</label>
            <input type="text" class="form-control" value="Rp <?= number_format($data->bayar, 0, ',', '.') ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Kembali</label>
            <input type="text" class="form-control" value="Rp <?= number_format($data->kembali, 0, ',', '.') ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Metode Pembayaran</label>
            <input type="text" class="form-control" value="<?= $data->metode_pembayaran ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Foto Pembayaran</label>
            <div>
              <?php if ($data->foto_pembayaran): ?>
                <img src="<?= base_url('uploads/'.$data->foto_pembayaran) ?>" width="500px">
              <?php else: ?>
                <p>-</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Tanggal Transaksi</label>
            <input type="text" class="form-control" value="<?= $data->tanggal ?? '-' ?>" readonly>
          </div>
        </div>

       <div class="row mb-3">
  <div class="col-md-12">
    <label class="form-label">Nama Kasir</label>
    <input type="text" class="form-control" value="<?= $data->nama_kasir ?? '-' ?>" readonly>
  </div>
</div>


        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Customer</label>
            <input type="text" class="form-control" value="<?= $data->nama_customer ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Nomor Meja</label>
            <input type="text" class="form-control" value="<?= $data->nomor_meja ?? '-' ?>" readonly>
          </div>
        </div>

        <a href="<?= base_url('home/tabel_nota') ?>" class="btn btn-secondary mt-3">Kembali</a>

      </div>
    </div>

  </div>
</div>
