<main id="main" class="main">

	<div class="pagetitle">
		<h1>Tambah Barang</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item">Forms</li>
				<li class="breadcrumb-item active">Elements</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">

				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Tambah Barang</h5>
						<form action="<?= base_url('home/simpan_tambah_barang') ?>" method="POST" enctype="multipart/form-data" action="your_action_url">

							<table>
								<tr>
									<td>kode barang</td>
									<td><input type="text" class="form-control" name="kode_barang" value=""></td>
								</tr>
								<tr>
									<td>nama</td>
									<td><input type="text" class="form-control" name="nama_barang" value=""></td>
								</tr>
								<tr>
									<td>deskripsi</td>
									<td><input type="text" class="form-control" name="deskripsi" value=""></td>
								</tr>
								<tr>
									<td>kategori</td>
									 <td>
                    <select class="form-control" name="kategori">

                      <option> Pilih kategori</option>
                      <?php
                      foreach ($child as $key => $value) {
                        ?>
                        <option value="<?=$value->id_kategori?>"><?= $value->nama_kategori?></option>
                        <?php
                      }
                      ?>
                      
                    </select>
                  </td>
								</tr>
								<tr>
									<td>harga</td>
									<td>
										<input type="text" 
										class="form-control" 
										name="harga_satuan" 
										value="<?= number_format($child->harga_satuan, 0, ',', '.') ?>" 
										oninput="formatRupiah(this)">
									</td>

								</tr>
								<tr>
									<td>harga mentah</td>
										<td>
										<input type="text" 
										class="form-control" 
										name="harga_mentah" 
										value="<?= number_format($child->harga_mentah, 0, ',', '.') ?>" 
										oninput="formatRupiah(this)">
									</td>
								</tr>
								<tr>
									<td>stok</td>
									<td><select name="stok" class="form-control">
											<option>pilih stok</option>
											<option value="tersedia" <?= ($child->stok == 'tersedia') ? 'selected' : '' ?>>tersedia</option>
											<option value="tidak tersedia" <?= ($child->stok == 'tidak tersedia') ? 'selected' : '' ?>>tidak tersedia</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Foto</td>
									<td><input type="file" class="form-control" name="file" accept="foto/" required></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="hidden" value="<?= $child->id_barang ?>">
										<button type="submit" class="btn btn-primary">Submit</button>
										<input type="reset" value="reset" class="form-control">
										<input type="button" value="kembali" class="form-control">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
	<script>
function formatRupiah(element) {
    let value = element.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = new Intl.NumberFormat('id-ID').format(value);
    element.value = value;
}
</script>


  </main><!-- End #main -->