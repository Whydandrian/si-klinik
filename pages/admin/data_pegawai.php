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
        <div class="card-header fw-bold">Data Pegawai</div>
        <div class="card-body">
          <h5 class="card-title"><a href="../pegawai_data/tambah.php" class="btn btn-primary">Tambah Data</a> | <a href="../laporan/laporan_pegawai.php" class="btn btn-warning">Cetak Data Pegawai</a></h5>
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil_hapus") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data pegawai berhasil di hapus!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_tambah") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data pegawai berhasil di tambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_update") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data pegawai berhasil di update!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
          <table id="example" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jenis Kelamin</th>
                <th>TTL</th>
                <th>Jabatan</th>
                <th>Pilihan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM pegawai ORDER BY nama_pegawai ASC";
              $result = mysqli_query($koneksi, $query);
              if (!$result) {
                die("Query Error: " . mysqli_errno($koneksi) .
                  " - " . mysqli_error($koneksi));
              }

              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                $tgl_lahir = strftime("%d %b %Y", strtotime($row['tanggal_lahir']));
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nama_pegawai']; ?></td>
                  <td><?php echo strtolower($row['jenis_kelamin']); ?></td>
                  <td><?php echo $row['tempat_lahir'] . ', ' . $tgl_lahir; ?></td>
                  <td><?php echo $row['jabatan']; ?></td>
                  <td>
                    <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['id'] ?>"><i class="fas fa-eye"></i></a>
                    <a href="../pegawai_data/edit.php?id=<?php echo $row['id']; ?>" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                    <a href="../pegawai_data/hapus.php?id=<?php echo $row['id']; ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a>
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
<?php
$query = "SELECT * FROM pegawai ORDER BY nama_pegawai ASC";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query Error: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
}

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
  setlocale(LC_ALL, 'id-ID', 'id_ID');
  $tgl = strftime("%d %B %Y", strtotime($row['tanggal_lahir']));
?>
  <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-xl-down modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col text-center">
              <img src="../../images/<?= $row['foto']; ?>" class="img-fluid text-center" style="width: 135px;">
            </div>
          </div>
          <div class="row">
            <h5 class="card-title  text-center mb-2"><?php echo $row['nama_pegawai'];
                                                      if (strtolower($row['jenis_kelamin']) == "laki-laki") {
                                                        echo " <i class='fas fa-mars text-primary'></i>";
                                                      } else {
                                                        echo "<i class='fas fa-venus text-danger'></i>";
                                                      } ?></h5>
            <div class="row ms-2">
              <label for="staticEmail" class="col-sm col-form-label fs-5">Jenis Kelamin</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext fs-5" id="staticEmail" value="<?= ucfirst($row['jenis_kelamin']) ?>">
              </div>
            </div>
            <div class="row ms-2">
              <label for="staticEmail" class="col-sm col-form-label fs-5">TTL</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext fs-5" id="staticEmail" value="<?= $row['tempat_lahir'] . ', ' . $tgl; ?>">
              </div>
            </div>
            <div class="row ms-2">
              <label for="staticEmail" class="col-sm col-form-label fs-5">Jabatan</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext fs-5" id="staticEmail" value="<?= $row['jabatan']; ?>">
              </div>
            </div>
            <div class="row ms-2">
              <label for="staticEmail" class="col-sm col-form-label fs-5">Agama</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext fs-5" id="staticEmail" value="<?= $row['agama']; ?>">
              </div>
            </div>
            <div class="row ms-2">
              <label for="staticEmail" class="col-sm col-form-label fs-6">Alamat</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext fs-6" id="staticEmail" value="<?= $row['alamat']; ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<?php
  $no++; //untuk nomor urut terus bertambah 1
}
?>
<?php include '../../layouts/backend/footer.php'; ?>