<main id="main" class="main">

	<div class="pagetitle">
		<h1>Detail User</h1>
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
						<h5 class="card-title">Detail user</h5>
						
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