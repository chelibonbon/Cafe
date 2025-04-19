<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Kategori</h5>
      <form>
         <a href="<?= base_url('home/tambah_kategori') ?>" class="btn btn-success">
        <i class="ri-add-circle-line"></i> Tambah
      </a>
         <?php if (session()->get('level') == 3): ?>
         <a href="<?= base_url('home/tabel_kategori_deleted') ?>" class="btn btn-primary">
        <i class="ri-delete-bin-line"></i> Deleted Kategori
      </a>
       <?php endif; ?>
      </form>

      <div class="table-responsive text-nowrap">
        <table class="table datatable">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col">Buttons</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php $ms = 1; ?>
            <?php foreach ($child as $value) : ?>
              <tr>
                <th scope="row"><?= $ms++ ?></th>
                <td><?= esc($value->nama_kategori) ?></td>
                <!-- <td><?= esc($value->level) ?></td> -->
                <td>
                  <a href="<?= base_url('home/edit_kategori/' . $value->id_kategori) ?>" class="btn btn-warning">
                    <i class="ri-edit-line"></i> 
                  </a>
                  <a href="<?= base_url('home/hapus_kategori/' . $value->id_kategori) ?>" class="btn btn-danger" class="btn btn-danger" 
                  onclick="return confirm('Are you sure you want to delete this item?');">
                    <i class="ri-delete-bin-line"></i> 
                  </a>
                  <a href="<?= base_url('home/detail_kategori/' . $value->id_kategori) ?>" class="btn btn-info">
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