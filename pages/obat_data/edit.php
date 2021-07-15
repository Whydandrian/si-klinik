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
    <div class="col-5">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Form Edit Obat</div>
        <div class="card-body">
          <?php
          include '../../config/connection.php';
          $id = $_GET['id'];

          $result = mysqli_query($koneksi, "SELECT * FROM obat WHERE id=$id");

          while ($obat_data = mysqli_fetch_array($result)) {
            $id = $obat_data['id'];
            $nama_obat = $obat_data['nama_obat'];
            $jenis_obat = $obat_data['jenis_obat'];
            $harga = $obat_data['harga'];
          }
          ?>
          <form method="POST" action="proses_edit.php">
            <div class="mb-3">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <label for="nama_obat" class="form-label">Nama Obat</label>
              <input type="text" class="form-control form-control-sm" id="nama_obat" name="nama_obat" value="<?= $nama_obat; ?>">
            </div>
            <div class=" mb-3">
            <label for="jenis_obat" class="form-label">Jenis  Obat</label>
              <select class="form-select form-select-sm" name="jenis_obat" id="jenis_obat">
                <option >Pilih Jenis Obat</option>
                <option value="Analgesik" <?php if ($jenis_obat == "analgesik") { echo "selected"; } ?>>Analgesik</option>
                <option value="Antasida" <?php if ($jenis_obat == "antasida") { echo "selected"; } ?>>Antasida</option>
                <option value="Anticemas" <?php if ($jenis_obat == "anticemas") { echo "selected"; } ?>>Anticemas</option>
                <option value="Antiaritmia" <?php if ($jenis_obat == "antiaritmia") { echo "selected"; } ?>>Antiaritmia</option>
                <option value="Antibiotik" <?php if ($jenis_obat == "Antibiotik") { echo "selected"; } ?>>Antibiotik</option>
                <option value="Antikoagulan" <?php if ($jenis_obat == "Antikoagulan") { echo "selected"; } ?>>Antikoagulan</option>
                <option value="Antikonvulsan" <?php if ($jenis_obat == "Antikonvulsan") { echo "selected"; } ?>>Antikonvulsan</option>
                <option value="Antidepresan" <?php if ($jenis_obat == "Antidepresan") { echo "selected"; } ?>>Antidepresan</option>
                <option value="Antidiare" <?php if ($jenis_obat == "Antidiare") { echo "selected"; } ?>>Antidiare</option>
                <option value="Antiemetik" <?php if ($jenis_obat == "Antiemetik") { echo "selected"; } ?>>Antiemetik</option>
                <option value="Antijamur" <?php if ($jenis_obat == "Antijamur") { echo "selected"; } ?>>Antijamur</option>
                <option value="Antihistamin" <?php if ($jenis_obat == "Antihistamin") { echo "selected"; } ?>>Antihistamin</option>
                <option value="Antihipertensi" <?php if ($jenis_obat == "Antihipertensi") { echo "selected"; } ?>>Antihipertensi</option>
                <option value="Anti-inflamasi" <?php if ($jenis_obat == "Anti-inflamasi") { echo "selected"; } ?>>Anti-inflamasi</option>
                <option value="Antineoplastik" <?php if ($jenis_obat == "Antineoplastik") { echo "selected"; } ?>>Antineoplastik</option>
                <option value="Antipsikotik" <?php if ($jenis_obat == "Antipsikotik") { echo "selected"; } ?>>Antipsikotik</option>
                <option value="Antipiretik" <?php if ($jenis_obat == "Antipiretik") { echo "selected"; } ?>>Antipiretik</option>
                <option value="Antivirus" <?php if ($jenis_obat == "Antivirus") { echo "selected"; } ?>>Antivirus</option>
                <option value="Beta-blocker" <?php if ($jenis_obat == "Beta-blocker") { echo "selected"; } ?>>Beta-blocker</option>
                <option value="Bronkodilator" <?php if ($jenis_obat == "Bronkodilator") { echo "selected"; } ?>>Bronkodilator</option>
                <option value="Kortikosteroid" <?php if ($jenis_obat == "Kortikosteroid") { echo "selected"; } ?>>Kortikosteroid</option>
                <option value="Sitotoksik" <?php if ($jenis_obat == "Sitotoksik") { echo "selected"; } ?>>Sitotoksik</option>
                <option value="Dekongestan" <?php if ($jenis_obat == "Dekongestan") { echo "selected"; } ?>>Dekongestan</option>
                <option value="Ekspektoran" <?php if ($jenis_obat == "Ekspektoran") { echo "selected"; } ?>>Ekspektoran</option>
                <option value="Obat Tidur" <?php if ($jenis_obat == "Obat Tidur") { echo "selected"; } ?>>Obat Tidur</option>
              </select>
            </div>
            <!-- <div class="mb-3">
              <label for="harga" class="form-label">Harga Obat</label>
              <input type="number" class="form-control form-control-sm" id="harga" name="harga" value="<?// $harga; ?>">
            </div> -->
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a>
          </form>
          <?php
          // }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>