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


$qry = mysqli_query($koneksi, "SELECT max(kode_daftar) as kodeDaftar FROM pendaftaran");
$dataDaftar = mysqli_fetch_array($qry);
$kodeDaftar = $dataDaftar['kodeDaftar'];
$list = (int) substr($kodeDaftar, 3, 3);
$list++;
$kd = "REG";
$kodeDaftar = $kd . sprintf("%03s", $list);

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
              <h5 class="text-secondary">Tanggal registrasi : <?= date("d M Y") ?></h5>
            </div>
          </div>
          <form method="POST" action="proses_tambah.php" class="row">
            <div class="col-5">
              <div class="card border-0">
                <div class="card-header fs-5 bg-info text-white">
                  Data Pasien
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <input type="hidden" readonly name="kode_daftar" value="<?= $kodeDaftar ?>">
                    <label for="kode_pasien" class="form-label">Nama Pasien</label>
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
                        <option value="<?= $row['kode_pasien'] ?>"><?= $row['kode_pasien'] ?> - <?= $row['nama_pasien'] ?></option>
                      <?php
                        $no++;
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="btn_pasien" class="form-label">pasien baru?</label>
                    <a href="../pasien_data/tambah.php" id="btn_pasien" class="btn btn-sm btn-warning">Tambah Data Pasien</a>
                  </div>
                  <div class="mb-3">
                    <label for="poli_tujuan" class="form-label">Poli Tujuan</label>
                    <select class="form-select form-select-sm" name="poli_tujuan" id="poli_tujuan">
                      <option>Pilih Poli Tujuan</option>
                      <option value="">Poli Anak</option>
                      <option value="">Poli Umum</option>
                      <option value="">Poli Gigi</option>
                      <option value="">Poli Kulit & Kelamin</option>
                      <option value="">Poli Orthopedi</option>
                      <option value="">Poli Mata</option>
                      <option value="">Poli Gizi</option>
                      <option value="">Poli Interna</option>
                      <option value="">Poli Kandungan</option>
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
                    <label for="keluhan" class="form-label">Keluhan Pasien</label>
                    <textarea name="keluhan" id="keluhan" class="form-control form-control-sm" cols="30" rows="3" placeholder="Tulis keluhan pasien lengkap"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" cols="30" rows="3" placeholder="Isikan keterangan spesifik"></textarea>
                  </div>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-primary">Register Pasien</button>
            <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>