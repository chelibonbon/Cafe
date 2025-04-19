<main id="main" class="main">

	<div class="pagetitle">
		<h1>Edit User</h1>
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
						<h5 class="card-title">Edit user</h5>
						<form action="<?= base_url('home/simpan_edit_user') ?>" method="POST">
							<table>
								<tr>
									<td>username</td>
									<td><input type="text" class="form-control" name="username" value="<?= $child->username ?>"></td>
								</tr>
								<tr>
									<td>password</td>
									<td><input type="password" class="form-control" name="password" value="<?= $child->password ?>"></td>
								</tr>
								<tr>
									<td>nama</td>
									<td><input type="text" class="form-control" name="nama" value="<?= $child->nama_user ?>"></td>
								</tr>
								<tr>
									<td>level</td>
									<td><input type="number" class="form-control" name="level" value="<?= $child->level ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="hidden" name="id" value="<?= $child->id_user ?>">
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