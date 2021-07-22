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
?>
<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col-5">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Form Tambah Layanan</div>
        <div class="card-body">
          <form method="POST" action="proses_tambah.php">
            <div class="mb-3">
              <!-- <input type="hidden" id="kode_layanan" name="kode_layanan" value="<?php //$kodeLayanan?>"> -->
              <label for="nama_layanan" class="form-label">Nama Layanan</label>
              <input type="text" class="form-control form-control-sm" id="nama_layanan" name="nama_layanan" placeholder="Nama Layanan" required>
            </div>
            <div class="mb-3">
              <label for="harga_layanan" class="form-label">Harga Layanan</label>
              <input type="number" class="form-control form-control-sm" id="harga_layanan" name="harga_layanan" placeholder="100000" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>