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
        <div class="card-header fw-bold fs-5">Form Tambah Obat</div>
        <div class="card-body">
          <form method="POST" action="proses_tambah.php">
            <div class="mb-3">
              <label for="nama_obat" class="form-label">Nama Obat</label>
              <input type="text" class="form-control form-control-sm" id="nama_obat" name="nama_obat" placeholder="Nama Obat">
            </div>
            <div class="mb-3">
              <label for="jenis_obat" class="form-label">Jenis  Obat</label>
              <select class="form-select form-select-sm" name="jenis_obat" id="jenis_obat">
              <option >Pilih Jenis Obat</option>
                <option value="Analgesik" >Analgesik</option>
                <option value="Antasida" >Antasida</option>
                <option value="Anticemas" >Anticemas</option>
                <option value="Antiaritmia" >Antiaritmia</option>
                <option value="Antibiotik" >Antibiotik</option>
                <option value="Antikoagulan" >Antikoagulan</option>
                <option value="Antikonvulsan" >Antikonvulsan</option>
                <option value="Antidepresan" >Antidepresan</option>
                <option value="Antidiare" >Antidiare</option>
                <option value="Antiemetik" >Antiemetik</option>
                <option value="Antijamur">Antijamur</option>
                <option value="Antihistamin" >Antihistamin</option>
                <option value="Antihipertensi" >Antihipertensi</option>
                <option value="Anti-inflamasi" >Anti-inflamasi</option>
                <option value="Antineoplastik">Antineoplastik</option>
                <option value="Antipsikotik">Antipsikotik</option>
                <option value="Antipiretik">Antipiretik</option>
                <option value="Antivirus" >Antivirus</option>
                <option value="Beta-blocker">Beta-blocker</option>
                <option value="Bronkodilator" >Bronkodilator</option>
                <option value="Kortikosteroid" >Kortikosteroid</option>
                <option value="Sitotoksik" >Sitotoksik</option>
                <option value="Dekongestan" >Dekongestan</option>
                <option value="Ekspektoran" >Ekspektoran</option>
                <option value="Obat Tidur">Obat Tidur</option>
              </select>
            </div>
            <!-- <div class="mb-3">
              <label for="harga" class="form-label">Harga Obat</label>
              <input type="number" class="form-control form-control-sm" id="harga" name="harga" placeholder="100000">
            </div> -->
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>