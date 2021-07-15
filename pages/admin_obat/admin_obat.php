<?php
  include '../../layouts/backend/header.php';
  session_start();
	if ($_SESSION['level'] == "") {
		header("location:index.php?pesan=gagal");
	}
	if ($_SESSION['status'] != "login") {
		header("location:index.php?pesan=belum_login");
	}
	if ($_SESSION['level'] != "admin_obat") {
		header("location:./pages/error404.php?pesan=hak_akses_salah");
	}
  

	?>
	<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col-10">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Biaya Resep Obat Pasien
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Registrasi pasien berhasil!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col d-flex justify-content-end">
              <h5 class="text-secondary">Tanggal registrasi : <?= date("d M Y") ?></h5>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
  <?php include '../../layouts/backend/footer.php'; ?>