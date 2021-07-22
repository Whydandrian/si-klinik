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
        <div class="card-header fw-bold fs-5">Form Edit User</div>
        <div class="card-body">
          <?php
          include '../../config/connection.php';
          $id = $_GET['id'];

          $result = mysqli_query($koneksi, "SELECT `user`.`id`, `user`.`username`, `user`.`password`, `user`.`level`, `pegawai`.`nama_pegawai` FROM `pegawai` INNER JOIN `user` ON `user`.`kode_pegawai` = `pegawai`.`kode_pegawai` WHERE `user`.`id`=$id");

          while ($user_data = mysqli_fetch_array($result)) {
            $id = $user_data['id'];
            $nama_pegawai = $user_data['nama_pegawai'];
            $password = $user_data['password'];
            $username = $user_data['username'];
            $level = $user_data['level'];
          }
          ?>
          <form method="POST" action="proses_edit.php">
            <div class="mb-3">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <label for="exampleInputEmail1" class="form-label">Nama User</label>
              <!-- <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Lengkap" value="<?php //echo $nama_pegawai; ?>"> -->
              <select class="form-select form-select-sm" name="kode_pegawai" id="kode_pegawai">
                <option>Pilih Nama User</option>
                <?php
                $qry = "SELECT kode_pegawai, nama_pegawai FROM pegawai ORDER BY nama_pegawai ASC";
                $data = mysqli_query($koneksi, $qry);
                if (!$data) {
                  die("Query Error: " . mysqli_errno($koneksi) .
                    " - " . mysqli_error($koneksi));
                }
                $no = 1;
                while ($pegawai = mysqli_fetch_assoc($data)) {
                ?>
                  <option value="<?= $pegawai['kode_pegawai'] ?>" <?php if($pegawai['nama_pegawai']===$nama_pegawai) { echo "selected"; } ?> ><?= $pegawai['kode_pegawai'] ?> - <?= $pegawai['nama_pegawai'] ?></option>
                <?php
                  $no++;
                }
                ?>

              </select>
            </div>
            <div class=" mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username Login" value="<?= $username; ?>">
            </div>
            <div class=" mb-3">
              <label for="level" class="form-label">Level</label>
              <select class="form-select form-select-sm" name="level" id="level">
                <option>Pilih Level User</option>
                <option value="admin_daftar" <?php if ($level == "admin_daftar") {
                                                echo "selected";
                                              } ?>>Admin Pendaftaran</option>
                <option value="admin_obat" <?php if ($level == "admin_obat") {
                                              echo "selected";
                                            } ?>>Admin Bag. Obat</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="********">
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="../admin/data_user.php" class="btn btn-warning">Kembali</a>
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