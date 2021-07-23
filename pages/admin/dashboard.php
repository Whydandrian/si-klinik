<?php
include '../../layouts/backend/header.php';
include '../../config/connection.php';
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

$count_obat = mysqli_query($koneksi, "SELECT count(id) as total_obat FROM obat");
while ($obat = mysqli_fetch_array($count_obat)) { $total_obat = strval($obat['total_obat']); }

$count_layanan = mysqli_query($koneksi, "SELECT count(id) as total_layanan FROM layanan");
while ($layanan = mysqli_fetch_array($count_layanan)) { $total_layanan = strval($layanan['total_layanan']); }

$count_pegawai = mysqli_query($koneksi, "SELECT count(id) as total_pegawai FROM pegawai");
while ($pegawai = mysqli_fetch_array($count_pegawai)) { $total_pegawai = strval($pegawai['total_pegawai']); }
?>

<div class="container-fluid">
	<div class="row col">
		<?php include_once('../../layouts/menu.php'); ?>
	</div>
	<div class="row d-flex justify-content-center mt-4 mx-5">
		<div class="col-3">
			<div class="card border-0 mb-3 bg-info text-white">
				<div class="card-header fw-bold">Data Obat</div>
				<div class="card-body">
					<h5 class="card-title">Total data obat : <?= $total_obat?> Macam Obat</h5>
					<p class="card-text">
						Cek data obat? Klik tombol.
						<a href="data_obat.php" class="btn btn-warning btn-sm">Cek Data</a>
					</p>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="card border-0 mb-3 bg-warning text-white">
				<div class="card-header fw-bold">Data Pegawai</div>
				<div class="card-body">
					<h5 class="card-title">Total data pegawai klinik : <?=$total_pegawai?> Orang</h5>
					<p class="card-text">
						Cek data obat? Klik tombol.
						<a href="data_pegawai.php" class="btn btn-success btn-sm">Cek Data</a>
					</p>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="card border-0 mb-3 bg-secondary text-white">
				<div class="card-header fw-bold">Data Layanan</div>
				<div class="card-body">
					<h5 class="card-title">Layanan klinik yang tersedia : <?=$total_layanan?> Orang</h5>
					<p class="card-text">
						Cek data obat? Klik tombol.
						<a href="data_layanan.php" class="btn btn-light btn-sm">Cek Data</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include '../../layouts/backend/footer.php'; ?>