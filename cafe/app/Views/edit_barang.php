<main id="main" class="main">

	<div class="pagetitle">
		<h1>Edit Barang</h1>
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
						<h5 class="card-title">Edit Barang</h5>
						<form action="<?= base_url('home/simpan_edit_barang') ?>" method="POST" enctype="multipart/form-data" action="your_action_url">
							<table>
								<tr>
									<td>kode barang</td>
									<td><input type="text" class="form-control" name="kode_barang" value="<?= $child->kode_barang ?>"></td>
								</tr>
								<tr>
									<td>nama</td>
									<td><input type="text" class="form-control" name="nama_barang" value="<?= $child->nama_barang ?>"></td>
								</tr>
								<tr>
									<td>deskripsi</td>
									<td><input type="text" class="form-control" name="deskripsi" value="<?= $child->deskripsi ?>"></td>
								</tr>
								<tr>
									<td>kategori</td>
									<td><input type="text" class="form-control" name="kategori" value="<?= $child->kategori ?>"></td>
								</tr>
								<tr>
									<td>harga</td>
									<td><input type="number" class="form-control" name="harga_satuan" value="<?= $child->harga_satuan ?>"></td>
								</tr>
								<tr>
									<td>harga mentah</td>
									<td><input type="number" class="form-control" name="harga_mentah" value="<?= $child->harga_mentah ?>"></td>
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
								<!-- <tr>
									<td>Foto</td>
									<td><input type="file" class="form-control" name="file" accept="foto/" required></td>
								</tr> -->
								<tr>
									<td></td>
									<td><input type="hidden" name="id" value="<?= $child->id_barang ?>">
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

  </main><!-- End #main -->