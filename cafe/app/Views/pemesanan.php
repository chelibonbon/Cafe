<div class="container">
    <h2 class="mb-4">Daftar Pemesanan</h2>

    <!-- Filter -->
    <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
        <!-- Form filter -->
           <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
        <form action="<?= base_url('home/Pemesanan') ?>" method="GET" class="form-inline d-flex flex-wrap align-items-center gap-2 mb-3">
            <!-- Filter Tanggal -->
            <input type="date" name="tanggal_mulai" value="<?= esc($filter_date_start) ?>" class="form-control" style="width: 180px;">
            sampai
            <input type="date" name="tanggal_selesai" value="<?= esc($filter_date_end) ?>" class="form-control" style="width: 180px;">

            <!-- Filter Waktu -->
            <input type="time" name="waktu_mulai" value="<?= esc($filter_time_start) ?>" class="form-control" style="width: 180px;">
            sampai
            <input type="time" name="waktu_selesai" value="<?= esc($filter_time_end) ?>" class="form-control" style="width: 180px;">
            
            <select name="status_pemesanan" class="form-control" style="width: 180px;">
                <option value="">Status Pemesanan</option>
                <option value="proses" <?= isset($filter_status) && $filter_status == 'proses' ? 'selected' : '' ?>>Proses</option>
                <option value="selesai" <?= isset($filter_status) && $filter_status == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="gagal" <?= isset($filter_status) && $filter_status == 'gagal' ? 'selected' : '' ?>>Gagal</option>
            </select>

            <select name="keterangan" class="form-control" style="width: 180px;">
                <option value="">Status Pembayaran</option>
                <option value="pending" <?= isset($filter_keterangan) && $filter_keterangan == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="lunas" <?= isset($filter_keterangan) && $filter_keterangan == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                <option value="gagal" <?= isset($filter_keterangan) && $filter_keterangan == 'gagal' ? 'selected' : '' ?>>Gagal</option>
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= base_url('home/Pemesanan') ?>" class="btn btn-secondary">Reset</a>
        </form>

        <!-- Cetak semua -->
        <!-- Cetak semua -->
        <form action="<?= base_url('home/cetak_all_pemesanan') ?>" method="POST" class="mb-3">
            <button type="submit" class="btn btn-success">Cetak Semua</button>
        </form>
          <?php endif; ?>

    </div>

    <!-- Daftar Pemesanan -->
    <div class="row">
        <?php foreach ($child as $order): ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                        <div>
                            <h5 class="card-title mb-1"><?= $order['nomor_nota'] ?> - Meja <?= $order['nomor_meja'] ?></h5>
                            <small class=""><?= $order['nama_user'] ?> | <?= date('d-m-Y H:i', strtotime($order['tanggal'])) ?></small>
                        </div>
                        <div>
                            <?php if ($order['status_pemesanan'] == 'proses'): ?>
                                <span class="badge bg-info p-2 fs-6">Proses</span>
                                <?php elseif ($order['status_pemesanan'] == 'selesai'): ?>
                                    <span class="badge bg-success p-2 fs-6">Selesai</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger p-2 fs-6">Gagal</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-body">
                                <p><strong>Status Pembayaran:</strong> 
                                    <?php if ($order['keterangan'] == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        <?php elseif ($order['keterangan'] == 'lunas'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Gagal</span>
                                            <?php endif; ?>
                                        </p>

                                        <p><strong>Total Bayar:</strong> Rp <?= number_format($order['bayar'], 0, ',', '.') ?></p>
                                        <p><strong>Kembali:</strong> Rp <?= number_format($order['kembali'], 0, ',', '.') ?></p>
                                        <p><strong>Metode Pembayaran:</strong> <?= $order['metode_pembayaran'] ?></p>

                                        <h6>Rincian Pemesanan:</h6>
                                        <ul class="mb-0">
                                            <?php foreach ($order['items'] as $item): ?>
                                                <li><?= $item['nama_barang'] ?> x <?= $item['jumlah'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                    <div class="card-footer d-flex gap-2 justify-content-start">
                                        <!-- <a href="<?= base_url('home/cetak_nota/'.$order['nomor_nota']) ?>" class="btn btn-sm btn-primary">Cetak Nota</a> -->

   <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
                                        <form action="<?= base_url('home/cetak_pemesanan/'.$order['nomor_nota']) ?>" method="POST" class="d-inline">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                   <i class="ri-receipt-line"></i>
                                            </button>
                                        </form>

                                        <form action="<?= base_url('home/update_status') ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="nomor_nota" value="<?= $order['nomor_nota'] ?>">
                                            <input type="hidden" name="status_pemesanan" value="selesai">
                                            <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                        </form>

                                        <form action="<?= base_url('home/update_status') ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="nomor_nota" value="<?= $order['nomor_nota'] ?>">
                                            <input type="hidden" name="status_pemesanan" value="gagal">
                                            <button type="submit" class="btn btn-danger btn-sm">Gagal</button>
                                        </form>
                                          <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>