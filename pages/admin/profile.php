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
  <?php
          include '../../config/connection.php';
          $username = $_SESSION['username'];
          $result = mysqli_query($koneksi, "SELECT `user`.`username`, `pegawai`.`nama_pegawai`, `user`.`level`, `pegawai`.`jenis_kelamin`, `pegawai`.`agama`, `pegawai`.`tempat_lahir`, `pegawai`.`tanggal_lahir`, `pegawai`.`jabatan`, `pegawai`.`foto`, `pegawai`.`alamat` FROM `pegawai` INNER JOIN `user` ON `user`.`kode_pegawai` = `pegawai`.`kode_pegawai` WHERE `user`.`username` = '$username'");

          while ($user_login = mysqli_fetch_array($result)) {
            $namauser = $user_login['username'];
            $nama_pegawai = $user_login['nama_pegawai'];
            $level = $user_login['level'];
            $jenis_kelamin = $user_login['jenis_kelamin'];
            $agama = $user_login['agama'];
            $tempat_lahir = $user_login['tempat_lahir'];
            $tgl_lahir = $user_login['tanggal_lahir'];
            $jabatan = $user_login['jabatan'];
            $foto = $user_login['foto'];
            $alamat = $user_login['alamat'];
          }
          ?>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col-6">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold text-center fs-5"><img src="../../images/<?=$foto?>"><br>Profile User</div>
        <div class="card-body">
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Nama User/Pegawai</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?= $nama_pegawai ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?= $namauser ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?php if($jenis_kelamin=="L"){echo "Laki-laki";}else {echo "Perempuan";} ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Agama</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?= $agama ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Jabatan</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?= $jabatan ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Tempat, Tanggal Lahir</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?= $tempat_lahir . ", " . $tgl_lahir ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="staticEmail" class="col-sm-4 col-form-label">Level</label>
            <div class="col-sm-6">
              <input type="text" class="form-control-sm form-control-plaintext" id="exampleInputEmail1" value="<?= $level ?>" readonly>
            </div>
          </div>
          <div class="mb-0 row">
            <label for="exampleInputPassword1" class="form-label">Alamat</label>
            <textarea  class="form-control-sm form-control-plaintext border-primary" readonly><?= $alamat ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>