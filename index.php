<?php include 'layouts/auth/header.php'; ?>
<div class="container-fluid">
	<h3 class="d-flex justify-content-center my-4">Login Mini Klinik</h3>
	<div class="row d-flex justify-content-center my-4">
		<div class="col-4">
			<div class="card shadow p-3 mb-5 bg-body rounded">
				<?php
				if (isset($_GET['pesan'])) {
					if ($_GET['pesan'] == "gagal") {
						echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Username dan Password tidak sesuai!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
					} else if ($_GET['pesan'] == "logout") {
						echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Anda berhasil logout!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
					} else if ($_GET['pesan'] == "belum_login") {
						echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Harap login terlebih dahulu!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
					} else if ($_GET['pesan'] == "hak_akses_salah") {
						echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Anda tidak memiliki hak akses!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
					}
				}

				// if ($_SESSION['username']) {
				// 	if ($_SESSION['username'] = "admin") {
				// 		header("location:pages/admin/dashboard.php");
				// 	} elseif ($_SESSION['username'] = "pegawai") {
				// 		header("location:halaman_pegawai.php");
				// 	} elseif ($_SESSION['username'] = "pengurus") {
				// 		header("location:halaman_pengurus.php");
				// 	}
				// } 

				?>
				<div class="card-body">
					<form action="auth.php" method="POST">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username">
						</div>
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="********">
						</div>
						<button type="submit" class="btn btn-primary" name="btn_login">Login</button>
					</form>
				</div>
				<p class="fw-bold">Informasi Login</p>
				<p class="fw-normal">Untuk lebih jelasnya, mohon lihat file Readme.txt</p>
				<ol class="list-group list-group-numbered">
					<li class="list-group-item d-flex justify-content-between align-items-start">
						<div class="ms-2 me-auto">
							<div class="fw-bold">Login admin</div>
							Username : administrator<br>Password : admin123
						</div>
						<span class="badge bg-primary rounded-pill">14</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-start">
						<div class="ms-2 me-auto">
							<div class="fw-bold">Login Bag. Pendaftaran</div>
							Username : beni<br>Password : beni123
						</div>
						<span class="badge bg-primary rounded-pill">14</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-start">
						<div class="ms-2 me-auto">
							<div class="fw-bold">Login Bag. Penerimaan Obat</div>
							Username : neni<br>Password : neni123
						</div>
						<span class="badge bg-primary rounded-pill">14</span>
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php include 'layouts/auth/footer.php'; ?>