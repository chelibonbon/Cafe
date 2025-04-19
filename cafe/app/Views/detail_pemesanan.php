<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h5 class="card-header">Detail Pemesanan</h5>
      <div class="card-body">

        <!-- Keterangan dan Status di atas -->
        <div class="mb-4 d-flex">
          <div class="me-3">
            <label class="form-label">Keterangan</label><br>
            <?php if (!empty($pemesanan->keterangan)): ?>
              <?php if ($pemesanan->keterangan == 'lunas'): ?>
                <span class="badge bg-success">Lunas</span>
              <?php elseif ($pemesanan->keterangan == 'gagal'): ?>
                <span class="badge bg-danger">Gagal</span>
              <?php elseif ($pemesanan->keterangan == 'pending'): ?>
                <span class="badge bg-warning text-dark">Pending</span>
              <?php else: ?>
                <span class="badge bg-secondary"><?= $pemesanan->keterangan ?></span>
              <?php endif; ?>
            <?php else: ?>
              <span class="badge bg-secondary">-</span>
            <?php endif; ?>
          </div>

          <div>
            <label class="form-label">Status Pemesanan</label><br>
            <?php if (!empty($pemesanan->status_pemesanan)): ?>
              <?php if ($pemesanan->status_pemesanan == 'selesai'): ?>
                <span class="badge bg-success">Selesai</span>
              <?php elseif ($pemesanan->status_pemesanan == 'gagal'): ?>
                <span class="badge bg-danger">Gagal</span>
              <?php elseif ($pemesanan->status_pemesanan == 'proses'): ?>
                <span class="badge bg-info text-dark">Proses</span>
              <?php else: ?>
                <span class="badge bg-secondary"><?= $pemesanan->status_pemesanan ?></span>
              <?php endif; ?>
            <?php else: ?>
              <span class="badge bg-secondary">-</span>
            <?php endif; ?>
          </div>
        </div>

        <!-- Data lainnya, satu kolom per baris -->
        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Kode Pemesanan</label>
            <input type="text" class="form-control" value="<?= $pemesanan->kode_pemesanan ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Nomor Meja</label>
            <input type="text" class="form-control" value="<?= $pemesanan->nomor_meja ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Nama Barang</label>
            <input type="text" class="form-control" value="<?= $pemesanan->nama_barang ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Jumlah</label>
            <input type="text" class="form-control" value="<?= $pemesanan->jumlah ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Catatan</label>
            <input type="text" class="form-control" value="<?= $pemesanan->catatan !== null && $pemesanan->catatan !== '' ? $pemesanan->catatan : '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Customer</label>
            <input type="text" class="form-control" value="<?= $pemesanan->nama_user ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Tanggal</label>
            <input type="text" class="form-control" value="<?= $pemesanan->tanggal ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Nomor Nota</label>
            <input type="text" class="form-control" value="<?= $pemesanan->nomor_nota ?? '-' ?>" readonly>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-12">
            <label class="form-label">Metode Pembayaran</label>
            <input type="text" class="form-control" value="<?= $pemesanan->metode_pembayaran ?? '-' ?>" readonly>
          </div>
        </div>

        <a href="<?= base_url('home/tabel_pemesanan') ?>" class="btn btn-secondary mt-3">Kembali</a>

      </div>
    </div>

  </div>
</div>
