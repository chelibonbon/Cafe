<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">User</h5>
      <form>
         <?php if (session()->get('level') == 3): ?>
         <a href="<?= base_url('home/tabel_user_deleted') ?>" class="btn btn-primary">
        <i class="ri-delete-bin-line"></i> Deleted User
      </a>
       <?php endif; ?>
      </form>

      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Username</th>
              <th scope="col">Nama</th>
              <!-- <th scope="col">Level</th> -->
              <th scope="col">Buttons</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $ms = 1; ?>
            <?php foreach ($child as $value) : ?>
              <tr>
                <th scope="row"><?= $ms++ ?></th>
                <td><?= esc($value->username) ?></td>
                <td><?= esc($value->nama_user) ?></td>
                <!-- <td><?= esc($value->level) ?></td> -->
                <td>
                  <a href="<?= base_url('home/edit_user/' . $value->id_user) ?>" class="btn btn-warning">
                    <i class="ri-edit-line"></i> 
                  </a>
                  <a href="<?= base_url('home/hapus_user/' . $value->id_user) ?>" class="btn btn-danger" class="btn btn-danger" 
                  onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="ri-delete-bin-line"></i> 
                  </a>
                  <a href="<?= base_url('home/detail_user/' . $value->id_user) ?>" class="btn btn-info">
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