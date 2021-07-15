<?php
include '../../layouts/backend/header.php';
session_start();
if ($_SESSION['level'] == "") {
  header("location:index.php?pesan=gagal");
}
if ($_SESSION['status'] != "login") {
  header("location:index.php?pesan=belum_login");
}
if ($_SESSION['level'] != "admin_obat") {
  header("location:./pages/error404.php?pesan=hak_akses_salah");
}


?>
<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold">Data Tagihan Pasien</div>
        <div class="card-body">
          <!-- <h5 class="card-title"><a href="../obat_data/tambah.php" class="btn btn-primary">Tambah Data</a></h5> -->
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil_hapus") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data obat berhasil di hapus!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_tambah") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data obat berhasil di tambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_update") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data obat berhasil di update!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
          <table id="example" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama Pasien</th>
                <th>Nama Obat</th>
                <th>Jumlah Obat</th>
                <th>Total Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT `biaya_pasien`.*, `pasien`.`nama_pasien`, `pasien`.`jenis_kelamin`, `pasien`.`jenis_pasien`, `pasien`.`telepon`, `obat`.`nama_obat`, `obat`.`jenis_obat` FROM `obat` INNER JOIN `biaya_pasien` ON `biaya_pasien`.`id_obat` = `obat`.`id` INNER JOIN `pasien` ON `biaya_pasien`.`kode_pasien` = `pasien`.`kode_pasien` ORDER BY `pasien`.`nama_pasien` ASC";
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
                  <td><?php echo $row['id_transaksi']; ?></td>
                  <td><?php echo $row['nama_pasien']; ?></td>
                  <td><?php echo $row['nama_obat']; ?></td>
                  <td><?php echo $row['jumlah']; ?></td>
                  <td><?php echo "Rp " . number_format($row['harga_total'], 0, ",", "."); ?></td>

                  <td>
                    <a href="../obat_data/edit.php?id=<?php echo $row['id']; ?>" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                    <a href="../obat_data/hapus.php?id=<?php echo $row['id']; ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>

              <?php
                $no++;
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