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
    <div class="col-10">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold">Data User</div>
        <div class="card-body">
          <h5 class="card-title"><a href="../user_data/tambah.php" class="btn btn-primary">Tambah Data</a></h5>
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil_hapus") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data user berhasil di hapus!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_tambah") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data user berhasil di tambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_update") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data user berhasil di update!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
          <table id="example" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Pilihan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT `user`.`id`, `user`.`user_id`, `pegawai`.`nama_pegawai`, `pegawai`.`jenis_kelamin`, `pegawai`.`jabatan` FROM `pegawai` INNER JOIN `user` ON `user`.`kode_pegawai` = `pegawai`.`kode_pegawai` ORDER BY `user`.`id` ASC";
              $result = mysqli_query($koneksi, $query);
              if (!$result) {
                die("Query Error: " . mysqli_errno($koneksi) .
                  " - " . mysqli_error($koneksi));
              }

              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nama_pegawai']; ?></td>
                  <td><?php
                  if ($row['jenis_kelamin'] == "L") {
                    echo "Laki-laki";
                  } else {
                    echo "Perempuan";
                  }
                  ?></td>
                  <td><?php echo $row['jabatan']; ?></td>
                  <td>
                    <a href="../user_data/edit.php?id=<?php echo $row['id']; ?>" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                    <a href="../user_data/hapus.php?id=<?php echo $row['user_id']; ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>

              <?php
                $no++; //untuk nomor urut terus bertambah 1
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>