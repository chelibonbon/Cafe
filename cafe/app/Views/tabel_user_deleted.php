<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <!-- Deleted Items Table (Admin Only) -->
      <div class="card mt-4">
        <h5 class="card-header">Deleted User</h5>
        <form>
         <a href="<?= base_url('home/tabel_user') ?>" class="btn btn-primary">
          user
        </a>
        <a href="<?= base_url('home/restore_all_user') ?>" class="btn btn-outline-info waves-effect" 
          onclick="return confirm('Are you sure you want to restore all the user?');">
          <i class="ri-arrow-go-back-line"></i> Restore All
        </a>
      </form>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th>Username</th>
              <th>Nama</th>
              <!--  <th>Level</th> -->
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($deleted_items as $item) : ?>
              <tr>
                <td><?= esc($item->username) ?></td>
                <td><?= esc($item->nama_user) ?></td>
                <!-- <td><?= esc($item->level) ?></td> -->
                <td>
                  <a href="<?= base_url('home/restore_user/' . $item->id_user) ?>" class="btn btn-outline-primary">
                    <i class="ri-arrow-go-back-line"></i> Restore
                  </a>
                  <a href="<?= base_url('home/delete_permanently_user/' . $item->id_user) ?>" class="btn btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this item? it will reduce to atoms, disintegrate.');">
                    <i class="ri-delete-bin-line"></i> Delete Permanently
                  </a>
                    <a href="<?= base_url('home/detail_user/' . $item->id_user) ?>" class="btn btn-info">
                    </i> Detail
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
