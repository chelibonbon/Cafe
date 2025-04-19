  
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Nota</h5>
      
      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">no. nota</th>
              <th scope="col">grand total</th>
            <!--   <th scope="col">bayar</th>
              <th scope="col">kembali</th> -->
              <th scope="col">metode pembayaran</th>
              <th scope="col">foto pembayaran</th>
              <th scope="col">keterangan</th>
              <th scope="col">kasir</th>
              <th scope="col">tanggal</th>
              <th scope="col">Buttons</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">

            <?php foreach ($child as $value): ?>
              <?php if (
                ($value->keterangan == 'pending' && empty($value->foto_pembayaran)) || 
                ($value->keterangan == 'gagal')
              ): ?>

              <div class="modal fade" id="bayarModal<?= $value->id_nota ?>" tabindex="-1" aria-labelledby="bayarModalLabel<?= $value->id_nota ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <form method="post" action="<?= base_url('home/proses_bayar/'.$value->id_nota) ?>">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="bayarModalLabel<?= $value->id_nota ?>">Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="grand_total" class="form-label">Grand Total</label>
                          <input type="text" class="form-control grand-total" id="grand_total<?= $value->id_nota ?>" name="grand_total" value="<?= number_format($value->grand_total, 0, ',', '.') ?>" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="bayar" class="form-label">Bayar</label>
                          <input type="text" class="form-control bayar" id="bayar<?= $value->id_nota ?>" name="bayar" required>
                        </div>
                        <div class="mb-3">
                          <label for="kembali" class="form-label">Kembali</label>
                          <input type="text" class="form-control kembali" id="kembali<?= $value->id_nota ?>" name="kembali" readonly>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>


          <?php
          $ms=1;
          foreach ($child as $key => $value) {
           ?>
           <tr>
            <th scope="row"><?= $ms++ ?></th>
            <td ><?= $value->nomor_nota ?></td>
            <td><?= number_format($value->grand_total, 0, ',', '.') ?></td>
             <!--  <td><?= number_format($value->bayar, 0, ',', '.') ?></td>
              <td><?= number_format($value->kembali, 0, ',', '.') ?></td> -->

              <td ><?= $value->metode_pembayaran ?></td>
              <td>
                <?php if (!empty($value->foto_pembayaran)): ?>
                  <img src="<?= base_url('uploads/'.$value->foto_pembayaran) ?>" width="50">
                  <?php else: ?>
                    Tidak Ada
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($value->keterangan == 'pending'): ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                    <?php elseif ($value->keterangan == 'lunas'): ?>
                      <span class="badge bg-success">Lunas</span>
                      <?php elseif ($value->keterangan == 'gagal'): ?>
                        <span class="badge bg-danger">Gagal</span>
                        <?php else: ?>
                          <?= $value->keterangan ?>
                        <?php endif; ?>
                      </td>

                      <td ><?= $value->nama_user ?></td>
                      <td ><?= $value->tanggal ?></td>
                      <td > 
                <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('fontawesome/css/fontawesome.min.css');?>">
                  <link rel="stylesheet" type="text/css" href="<?=base_url('fontawesome/css/all.css');?>"> -->
                  <?php if ($value->keterangan == 'lunas'): ?>
                    <a href="<?= base_url('home/printNota/'.$value->id_nota) ?>" class="btn btn-primary mb-1" target="_blank">
                    <i class="ri-receipt-line"></i>
                  </a>

                <?php endif; ?>

                   <?php if (session()->get('level') == 1 || session()->get('level') == 3): ?>
                <?php if (!empty($value->foto_pembayaran) && $value->keterangan == 'pending'): ?>
                  <a href="<?= base_url('home/lampirkan_gambar/'.$value->id_nota) ?>" class="btn btn-warning mb-1">
                   <i class="ri-image-line"></i>
                 </a>
               <?php endif; ?>
               <?php endif; ?>

               <?php if (empty($value->foto_pembayaran) && $value->keterangan == 'pending'): ?>
                <button class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#bayarModal<?= $value->id_nota ?>">
                 <i class="ri-money-dollar-circle-line"></i>
               </button>
             <?php endif; ?>
             <?php if ($value->keterangan == 'gagal'): ?>
              <button class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#bayarModal<?= $value->id_nota ?>">
                <i class="ri-money-dollar-circle-line"></i>
              </button>
            <?php endif; ?>

            <a href="<?= base_url('home/detail_nota/'.$value->id_nota) ?>" class="btn btn-info mb-1"> <i class="ri-information-line"></i>
            </a>


          </td>
        <?php } ?>
      </tr>

    </tbody>
  </table>
  <script>
    function formatRupiah(angka) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return rupiah;
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.bayar').forEach(function(bayarInput) {
       bayarInput.addEventListener('input', function() {
        let id = this.id.replace('bayar', '');
        let grandTotalInput = document.getElementById('grand_total' + id);
        let kembaliInput = document.getElementById('kembali' + id);
        let submitButton = document.querySelector('#bayarModal' + id + ' button[type="submit"]');

        let bayarValue = parseInt(this.value.replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
        let grandTotalValue = parseInt(grandTotalInput.value.replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;

    // 🛠️ Direct subtraction, allow minus
    let kembaliValue = bayarValue - grandTotalValue;

    // Show minus formatting correctly
    kembaliInput.value = (kembaliValue < 0 ? '-' : '') + formatRupiah(Math.abs(kembaliValue).toString());

    // Enable/disable submit
    if (bayarValue >= grandTotalValue) {
      submitButton.disabled = false;
    } else {
      submitButton.disabled = true;
    }

    // Format bayar input
    this.value = formatRupiah(this.value.replace(/\./g, '').replace(/[^0-9]/g, ''));
  });

     });
    });

    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
      modal.addEventListener('shown.bs.modal', function (event) {
        let submitButton = modal.querySelector('button[type="submit"]');
        if (submitButton) {
          submitButton.disabled = true;
        }
            // Clear bayar & kembali when opening modal
            let bayarInput = modal.querySelector('.bayar');
            let kembaliInput = modal.querySelector('.kembali');
            if (bayarInput && kembaliInput) {
              bayarInput.value = '';
              kembaliInput.value = '';
            }
          });
    });
  </script>

</div>
</div>
<!-- Bootstrap Table with Header - Light -->
