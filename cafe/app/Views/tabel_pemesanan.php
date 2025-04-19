  
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Pemesanan</h5>
      
      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
             <!--  <th scope="col">kode pemesanan</th> -->
              <th scope="col">nomor meja</th>
              <th scope="col">nama barang</th>
              <th scope="col">jumlah</th>
              <!--  <th scope="col">catatan</th> -->
               <th scope="col">customer</th>
              <th scope="col">tanggal</th>
              <th scope="col">nomor nota</th>
             <!--  <th scope="col">metode pembayaran</th> -->
              <th scope="col">keterangan</th>
              <th scope="col">status</th>
               <th scope="col">Buttons</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

          <?php
$ms=1;
foreach ($child as $key => $value):
?>
<tr>
    <td><?= $ms++ ?></td>
   <!--  <td><?= $value->kode_pemesanan ?? '-' ?></td> -->
    <td><?= $value->nomor_meja ?? '-' ?></td>
    <td><?= $value->nama_barang ?? '-' ?></td>
    <td><?= $value->jumlah ?? '-' ?></td>
    <!-- <td><?= $value->catatan ?? '-' ?></td> -->
    <td><?= $value->nama_user ?? '-' ?></td>
    <td><?= $value->tanggal ?? '-' ?></td>
    <td><?= $value->nomor_nota ?? '-' ?></td>
    <!-- <td><?= $value->metode_pembayaran ?? '-' ?></td> -->
    <td>
                    <!-- Status Badges -->
                    <?php if ($value->keterangan == 'lunas'): ?>
                        <span class="badge bg-success">Lunas</span>
                    <?php elseif ($value->keterangan == 'gagal'): ?>
                        <span class="badge bg-danger">Gagal</span>
                    <?php elseif ($value->keterangan == 'pending'): ?>
                        <span class="badge bg-warning">Pending</span>
                    <?php endif; ?>
                </td>
                 <td>
                    <!-- Status Badges -->
                    <?php if ($value->status_pemesanan == 'selesai'): ?>
                        <span class="badge bg-success">selesai</span>
                    <?php elseif ($value->status_pemesanan == 'gagal'): ?>
                        <span class="badge bg-danger">Gagal</span>
                    <?php elseif ($value->status_pemesanan == 'proses'): ?>
                        <span class="badge bg-info">proses</span>
                    <?php endif; ?>
                </td>
    <td>
        <form action="<?= base_url('home/cetak_pemesanan/'.$value->nomor_nota) ?>" method="POST" class="d-inline">
    <button type="submit" class="btn btn-primary">
        <i class="ri-receipt-line"></i>
    </button>
</form>

          <a href="<?= base_url('home/detail_pemesanan/'.$value->id_pemesanan) ?>" class="btn btn-info mb-1">
       <i class="ri-information-line"></i>
    </a>
    </td>
</tr>
<?php endforeach; ?>

     </tbody>
   </table>
 </div>
</div>
<!-- Bootstrap Table with Header - Light -->
