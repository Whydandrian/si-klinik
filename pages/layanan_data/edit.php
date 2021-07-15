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
        <div class="card-header fw-bold fs-5">Form Edit Layanan</div>
        <div class="card-body">
        <?php
          include '../../config/connection.php';
          $kode = $_GET['id'];

          $result = mysqli_query($koneksi, "SELECT * FROM layanan WHERE id=$kode");

          while ($layanan_data = mysqli_fetch_array($result)) {
            $nama_layanan = $layanan_data['nama_layanan'];
            $harga_layanan = $layanan_data['harga_layanan'];
          }
          ?>
          <form method="POST" action="proses_edit.php">
            <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $kode; ?>">
              <label for="nama_layanan" class="form-label">Nama Layanan</label>
              <input type="text" class="form-control form-control-sm" id="nama_layanan" name="nama_layanan" placeholder="Nama Layanan" required value="<?=$nama_layanan?>">
            </div>
            <div class="mb-3">
              <label for="harga_layanan" class="form-label">Harga Layanan</label>
              <input type="number" class="form-control form-control-sm" id="harga_layanan" name="harga_layanan" placeholder="100000" required value="<?= $harga_layanan?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="../admin/data_layanan.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>