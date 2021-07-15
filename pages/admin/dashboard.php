<?php
  include '../../layouts/backend/header.php';
  session_start();
	if ($_SESSION['level'] == "") {
		header("location:index.php?pesan=gagal");
	}
	if ($_SESSION['status'] != "login") {
		header("location:index.php?pesan=belum_login");
	}
	if ($_SESSION['level'] != "admin") {
		header("location:./pages/error404.php?pesan=hak_akses_salah");
	}
  

	?>
	<div class="container-fluid">
		<div class="row col">
			<?php include_once('../../layouts/menu.php'); ?>
		</div>
		<div class="row d-flex justify-content-center mt-4 mx-5">
			<div class="col-4">
			<div class="card border-primary mb-3">
					<div class="card-header fw-bold" >Data User</div>
					<div class="card-body text-primary">
						<h5 class="card-title">Primary card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card border-primary mb-3">
					<div class="card-header fw-bold" >Data Pegawai</div>
					<div class="card-body text-primary">
						<h5 class="card-title">Primary card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					</div>
				</div>
			</div>
			<div class="col-4">
			<div class="card border-primary mb-3">
					<div class="card-header fw-bold" >Transaksi</div>
					<div class="card-body text-primary">
					<canvas id="myChart" width="400" height="400"></canvas>
					</div>
				</div>
			</div>

		</div>
	</div>
	
  <?php include '../../layouts/backend/footer.php'; ?>