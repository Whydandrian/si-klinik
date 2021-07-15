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
      <div class="card border-0 mb-3 text-center">
        <div class="card-header fw-bold bg-warning">Laporan Data Pegawai</div>
        <div class="card-body text-primary">
            <p class="card-text">Klik tombol print untuk export ke PDF file.</p>
            <a href="laporan_pegawai.php" class="btn btn-warning">Cetak Data Pegawai</a>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card border-0 mb-3 text-center">
        <div class="card-header fw-bold bg-info">Laporan Data Obat</div>
        <div class="card-body text-primary">
        <p class="card-text">Klik tombol print untuk export ke PDF file.</p>
            <a href="laporan_obat.php" class="btn btn-info">Cetak Data Obat</a>
        </div>
      </div>
    </div>
    <!-- <div class="col-4">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold">Laporan Data </div>
        <div class="card-body text-primary">
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div> -->

  </div>
</div>

<?php include '../../layouts/backend/footer.php'; ?>