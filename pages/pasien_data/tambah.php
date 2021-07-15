<?php
include '../../layouts/backend/header.php';
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
    <div class="col-6">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Form Tambah Pasien</div>
        <?php
        if (isset($_GET['pesan'])) {
          if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Harap pilih ekstensi foto lainnya!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
          } elseif ($_GET['pesan'] == "ukuran_salah") {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Ukuran foto terlalu besar!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
          }
        }
        ?>
        <div class="card-body">
          <form method="POST" action="proses_tambah.php" enctype="multipart/form-data">
            <div class="mb-3">
              <input type="hidden" readonly class="form-control form-control-sm" id="kode_pasien" name="kode_pasien" value="<?= $kodePasien ?>">
              <label for="nama_pasien" class="form-label">Nama Pasien</label>
              <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" placeholder="Nama Pasien">
            </div>
            <div class="mb-3">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <div class="row ms-2">
                <div class="col form-check">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki">
                  <label class="form-check-label" for="laki-laki">
                    Laki-Laki
                  </label>
                </div>
                <div class="col form-check me-4">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                  <label class="form-check-label" for="perempuan">
                    Perempuan
                  </label>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="jenis_pasien" class="form-label">Jenis Pasien</label>
              <select class="form-select form-select-sm" name="jenis_pasien" id="jenis_pasien">
                <option>Pilih Jenis Pasien</option>
                <option value="baru">Pasien Baru</option>
                <option value="lama">Pasien Lama</option>
                <option value="umum">Pasien umum</option>
                <option value="bayi">Pasien Bayi baru Lahir</option>
                <option value="tidak dikenal">Pasien Tidak Dikenal</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="tempat_lahir" class="form-label">Golongan Darah</label>
              <input type="text" class="form-control form-control-sm" id="golongan_darah" name="golongan_darah" placeholder="A, B, O, AB">
            </div>
            <div class="mb-3">
              <label for="telepon" class="form-label">Nomor Telepon</label>
              <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="081234567891">
            </div>
            <div class="mb-3">
              <label for="alamat_pasien" class="form-label">Alamat</label>
              <textarea class="form-control form-control-sm" name="alamat_pasien" id="alamat_pasien" cols="30" rows="4" placeholder="Alamat Lengkap"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="javascript:history.go(-1)" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>