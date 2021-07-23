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
if ($_SESSION['level'] != "admin_daftar") {
  header("location:./pages/error404.php?pesan=hak_akses_salah");
}

$qry = mysqli_query($koneksi, "SELECT max(kode_pasien) as kodePasien FROM pasien");
$pasien = mysqli_fetch_array($qry);
$kodePasien = $pasien['kodePasien'];
$list = (int) substr($kodePasien, 3, 3);
$list++;
$kd = "PSN";
$kodePasien = $kd . sprintf("%03s", $list);
?>
<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col-10">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Pendaftaran Pasien Klinik
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
              <input type="text" readonly value="<?= $kodePasien ?>" name="kode_pasien" id="kode_pasien" class="kode-pasien">
              <h5 class="text-secondary">Tanggal registrasi : <?= date("d M Y") ?></h5>
            </div>
          </div>
          <form method="POST" action="proses_tambah.php" class="row">
            <div class="col-5">
              <div class="card border-0">
                <div class="card-header fs-5 bg-info text-white d-flex justify-content-between">
                  Data Pasien
                </div>
                <div class="card-body">
                  <div class="pilihan-pegawai">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pegawai_pilihan" id="flexRadioDefault1" value="1">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Data Pegawai Lama Klik disini!
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="pegawai_pilihan" id="flexRadioDefault2" value="2" checked="checked">
                      <label class="form-check-label" for="flexRadioDefault2">
                        Tambah Data Pegawai Baru Klik disini!
                      </label>
                    </div>
                  </div>
                  <div class="mb-3" id="data-pasien-lama">
                    <label for="kode_poli" class="form-label">Nama Pasien Lama</label>
                    <select class="form-select form-select-sm" name="kode_poli" id="kode_poli">
                      <option>Pilih Nama Pasien Terdaftar</option>
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
                        <option value="<?= $row['kode_pasien'] ?>"><?= $row['nama_pasien'] ?></option>
                      <?php
                        $no++;
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3" id="data-pasien-baru">
                    <label for="kode_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control form-control-sm" name="nama_pegawai" id="nama_pegawai">
                  </div>

                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0">
                <div class="card-header fs-5 bg-info text-white">
                  Keluhan Pasien
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="kode_poli" class="form-label">Poli Tujuan</label>
                    <select class="form-select form-select-sm" name="kode_poli" id="kode_poli">
                      <option>Pilih Tujuan Poli</option>
                      <?php
                      $query = "SELECT * FROM poli_tujuan ORDER BY nama_poli ASC";
                      $result = mysqli_query($koneksi, $query);
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }
                      $no = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <option value="<?= $row['kode_poli'] ?>"><?= $row['nama_poli'] ?></option>
                      <?php
                        $no++;
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="kode_layanan" class="form-label">Layanan Pasien</label>
                    <select class="form-select form-select-sm" name="kode_layanan" id="kode_layanan">
                      <option>Pilih Layanan Pasien</option>
                      <?php
                      $query = "SELECT * FROM layanan ORDER BY nama_layanan ASC";
                      $result = mysqli_query($koneksi, $query);
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                          " - " . mysqli_error($koneksi));
                      }
                      $no = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <option value="<?= $row['kode_layanan'] ?>"><?= $row['nama_layanan'] ?></option>
                      <?php
                        $no++;
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan Pasien</label>
                    <textarea name="keluhan" id="keluhan" class="form-control form-control-sm" cols="15" rows="2" placeholder="Tulis keluhan pasien lengkap"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" cols="15" rows="2" placeholder="Isikan keterangan spesifik"></textarea>
                  </div>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-primary">Register Pasien</button>
            <!-- <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a> -->
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>