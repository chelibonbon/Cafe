<main id="main" class="main">

	<div class="pagetitle">
		<h1>Detail Barang</h1>
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
						<h5 class="card-title">Detail Barang</h5>
		
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
									<td><input type="text" class="form-control" name="stok" value="<?= $child->stok ?>"></td>
								</tr>
								<tr>
									<th scope="row">Foto</th>
									<td><img src="<?= base_url('foto/'.$child->foto);?>" width="500px"></td>
								</tr>
								 <?php if (session()->get('level') == 3): ?>
								<tr>
									<td>created at</td>
									<td><input type="text" class="form-control" name="created_at" placeholder="-" value="<?= $child->created_at ?>"></td>
								</tr>
								<tr>
									<td>updated at</td>
									<td><input type="text" class="form-control" name="updated_at" placeholder="-"  value="<?= $child->updated_at ?>"></td>
								</tr>
								<tr>
									<td>deleted at</td>
									<td><input type="text" class="form-control" name="deleted_at" placeholder="-" value="<?= $child->deleted_at ?>"></td>
								</tr>
								<tr>
									<td>created by</td>
									<td><input type="text" class="form-control" name="created_by" placeholder="-" value="<?= $child->created_by ?>"></td>
								</tr>
								<tr>
									<td>updated by</td>
									<td><input type="text" class="form-control" name="updated_by" placeholder="-" value="<?= $child->updated_by ?>"></td>
								</tr>
								<tr>
									<td>deleted by</td>
									<td><input type="text" class="form-control" name="deleted_by" placeholder="-" value="<?= $child->deleted_by ?>"></td>
								</tr>
								 <?php endif; ?>
								<tr>
									<td></td>
									
								</tr>
							</table>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>

  </main><!-- End #main -->