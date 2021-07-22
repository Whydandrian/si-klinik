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
            $id_jenis_obat = $obat_data['id_jenis_obat'];
            $harga = $obat_data['harga_obat'];
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
              <option>Pilih Jenis Obat</option>
                <?php
                $qry = "SELECT * FROM jenis_obat ORDER BY nama_jenis_obat ASC";
                $data = mysqli_query($koneksi, $qry);
                if (!$data) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }
                $no = 1;
                while ($jenis_obat = mysqli_fetch_assoc($data)) {
                ?>
                  <option value="<?= $jenis_obat['id'] ?>" <?php if($id_jenis_obat === $jenis_obat['id']) { echo "selected"; }?> ><?= $jenis_obat['nama_jenis_obat'] ?></option>
                <?php
                  $no++;
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="harga_obat" class="form-label">Harga Obat</label>
              <input type="number" class="form-control form-control-sm" id="harga_obat" name="harga_obat" value="<?= $harga; ?>">
            </div>
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