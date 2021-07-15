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
    <div class="col-6">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5">Form Tambah Pegawai</div>
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
              <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
              <input type="text" class="form-control form-control-sm" id="nama_pegawai" name="nama_pegawai" placeholder="Nama Pegawai">
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
              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
              <input type="text" class="form-control form-control-sm" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
            </div>
            <div class="mb-3">
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control form-control-sm" id="tanggal_lahir" name="tanggal_lahir">
            </div>
            <div class="mb-3">
              <label for="jabatan" class="form-label">Jabatan Pegawai</label>
              <select class="form-select form-select-sm" name="jabatan" id="jabatan">
                <option>Pilih Jabatan Pegawai</option>
                <option value="Admin pendaftaran">Admin Pendaftaran</option>
                <option value="Admin Obat">Admin Obat</option>
                <option value="Apoteker">Apoteker</option>
                <option value="Dokter">Dokter</option>
                <option value="Perawat">Perawat</option>
                <option value="CS">Cleaning Service</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="agama" class="form-label">Agama</label>
              <select class="form-select form-select-sm" name="agama" id="agama">
                <option>Pilih Agama</option>
                <option value="Islam">Islam</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Kristen">krister</option>
                <option value="Katholik">Katholik</option>
                <option value="Kong Huchu">Kong Huchu</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Pendidikan</label>
              <input type="text" class="form-control form-control-sm" id="pendidikan" name="pendidikan" placeholder="Sarjana">
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Pilih Foto</label>
              <input class="form-control form-control-sm" id="foto" name="foto" type="file">
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Alamat</label>
              <textarea class="form-control form-control-sm" name="alamat" id="alamat" cols="30" rows="4" placeholder="Alamat Lengkap"></textarea>
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