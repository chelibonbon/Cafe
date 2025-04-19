<main id="main" class="main">

	<div class="pagetitle">
		<h1>Edit Kategori</h1>
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
						<h5 class="card-title">Edit kategori</h5>
						<form action="<?= base_url('home/simpan_edit_kategori') ?>" method="POST">
							<table>
								<tr>
									<td>nama kategori</td>
									<td><input type="text" class="form-control" name="nama_kategori" value="<?= $child->nama_kategori ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="hidden" name="id" value="<?= $child->id_kategori ?>">
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