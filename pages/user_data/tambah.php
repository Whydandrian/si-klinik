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
        <div class="card-header fw-bold fs-5">Form Tambah User</div>
        <div class="card-body">
          <form method="POST" action="proses_tambah.php">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama User</label>
              <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Lengkap">
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username Login">
            </div>
            <div class="mb-3">
              <label for="level" class="form-label">Level</label>
              <select class="form-select form-select-sm" name="level" id="level">
                <option >Pilih Level User</option>
                <option value="pegawai">Pegawai</option>
                <option value="pengurus">Pengurus</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="********">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="../admin/data_user.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>