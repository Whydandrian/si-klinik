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
if ($_SESSION['level'] != "admin_obat") {
  header("location:../error404.php?pesan=hak_akses_salah");
}


$qry = mysqli_query($koneksi, "SELECT max(id_transaksi) as kodeTransaksi FROM biaya_pasien");
$dataDaftar = mysqli_fetch_array($qry);
$kodeTransaksi = $dataDaftar['kodeTransaksi'];
$list = (int) substr($kodeTransaksi, 5, 3);
$list++;
$kd = "TRANS";
$kodeTransaksi = $kd . sprintf("%03s", $list);

?>
<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col-8">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Pengambilan Resep Pasien
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Registrasi pasien berhasil!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
        </div>
        <div class="card-body">
          <div class="row  align-items-center">
            <div class="col-auto">
              <label for="kode" class="col-form-label">Kode Transaksi</label>
            </div>
            <div class="col-auto">
              <span id="kode" class="form-text fs-6">
              <?= $kodeTransaksi ?>  
              </span>
            </div>
            <div class="col d-flex justify-content-end">
              <h5 class="text-secondary">Tanggal registrasi : <?= date("d M Y") ?></h5>
            </div>
          </div>
          <form method="POST" action="proses_tambah.php" class="row">
            <div class="col-5">
              <div class="card border-0">
                <div class="card-header fs-5 bg-info text-white  fw-bold">
                  Data Pasien
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <input type="hidden" readonly name="id_transaksi" value="<?= $kodeTransaksi ?>">
                    <label for="kode_pasien" class="form-label  fw-bold">Cari Nama Pasien</label>
                    <select class="form-select form-select-sm" name="kode_pasien" id="kode_pasien">
                      <option>Pilih Nama Pasien</option>
                      <?php
                      $query = "SELECT * FROM pasien ORDER BY nama_pasien ASC";
                      $result = mysqli_query($koneksi, $query);
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }

                      $no = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <option value="<?= $row['kode_pasien'] ?>">[ <?= $row['kode_pasien'] ?> ] - <?= $row['nama_pasien'] ?></option>
                      <?php
                        $no++;
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="id_obat" class="form-label fw-bold">Obat Pasien</label>
                    <select class="form-select form-select-sm" name="id_obat" id="id_obat">
                      <option>Pilih Obat Pasien</option>

                      <?php
                      $query = "SELECT * FROM obat ORDER BY nama_obat ASC";
                      $result = mysqli_query($koneksi, $query);
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }

                      $no = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        $harga = $row['harga'];
                      ?>

                        <option value="<?= $row['id'] ?>"><?= $row['nama_obat'] ?></option>
                      <?php
                        $no++;
                      }
                      ?>
                    </select>
                  </div>

                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0">
                <div class="card-header fs-5 bg-info text-white fw-bold">
                  Total Transaksi
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="jumlah" class="form-label fw-bold">Jumlah Obat</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control form-control-sm" min="0" max="20" onkeypress='return restrictAlphabets(event)'>
                  </div>
                  <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Harga Obat</label>
                    <input type="number" id="harga_obat" name="harga_obat" class="form-control form-control-sm" min="0" onkeypress='return restrictAlphabets(event)'>
                  </div>
                  <div class="mb-3">
                    <label for="keluhan" class="form-label fs-5 fw-bold">Total Harga</label>
                    <input type="text" name="harga_total" id="harga_total" class="form-control form-control-sm fs-3 fw-bold text-danger harga_total" readonly>
                  </div>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-primary">Total</button>
            <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>