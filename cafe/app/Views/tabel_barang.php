  
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
      <h5 class="card-header">Barang</h5>
      <form>
        <a href="<?= base_url('home/tambah_barang') ?>" class="btn btn-success">
          <i class="ri-add-circle-line"></i> Tambah
        </a>
        <?php if (session()->get('level') == 3): ?>
        <a href="<?= base_url('home/tabel_barang_deleted') ?>" class="btn btn-primary">
          <i class="ri-delete-bin-line"></i> Deleted barang
        </a>
      <?php endif; ?>
  
    </form>

    <div class="table-responsive text-nowrap">
      <table class="table datatable">
        <thead class="table-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">deskripsi</th>
            <th scope="col">kategori</th>
            <th scope="col">harga</th>
            <th scope="col">stok</th>
             <th scope="col">foto</th>
            <th scope="col">Buttons</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

         <?php
         $ms=1;
         foreach ($child as $key => $value) {
           ?>
           <tr>
            <th scope="row"><?= $ms++ ?></th>
            <td ><?= $value->nama_barang ?></td>
            <td ><?= $value->deskripsi ?></td>
            <td ><?= $value->nama_kategori ?></td>
            <td ><?= $value->harga_satuan ?></td>
            <td ><?= $value->stok ?></td>
              <td><img src="<?= base_url('foto/'.$value->foto);?>" width="50px"></td>
            <td > 
              <a href="<?= base_url('home/edit_barang/'.$value->id_barang) ?>" class="btn btn-warning">
                <i class="ri-edit-line"></i> 
              </a>
              <a href="<?= base_url('home/hapus_barang/'.$value->id_barang) ?>" class="btn btn-danger" class="btn btn-danger" 
                onclick="return confirm('Are you sure you want to delete this item?');">
                <i class="ri-delete-bin-line"></i> 
              </a>
               <a href="<?= base_url('home/detail_barang/' . $value->id_barang) ?>" class="btn btn-info">
                   <i class="ri-information-line"></i>
                  </a>
            </td>
          <?php } ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- Bootstrap Table with Header - Light -->
