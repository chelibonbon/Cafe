<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <h5 class="card-header">Kasir</h5>
      <form>
      <a href="<?= base_url('home/tambah_kasir') ?>" class="btn btn-success">
        <i class="ri-add-circle-line"></i> Tambah
      </a>
       <?php if (session()->get('level') == 3): ?>
       <a href="<?= base_url('home/tabel_kasir_deleted') ?>" class="btn btn-primary">
        <i class="ri-delete-bin-line"></i> Deleted Kasir
      </a>
       <?php endif; ?>
    </form>

      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Nama</th>
              <!-- <th>Level</th> -->
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $ms = 1; ?>
            <?php foreach ($child as $value) : ?>
              <tr>
                <th><?= $ms++ ?></th>
                <td><?= esc($value->username) ?></td>
                <td><?= esc($value->nama_user) ?></td>
                <!-- <td><?= esc($value->level) ?></td> -->
                <td>
                  <a href="<?= base_url('home/edit_kasir/' . $value->id_user) ?>" class="btn btn-warning">
                    <i class="ri-edit-line"></i> 
                  </a>
                  <a href="<?= base_url('home/hapus_kasir/' . $value->id_user) ?>" class="btn btn-danger" class="btn btn-danger" 
                  onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="ri-delete-bin-line"></i> 
                  </a>
                   <a href="<?= base_url('home/detail_kasir/' . $value->id_user) ?>" class="btn btn-info">
                   <i class="ri-information-line"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
