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


?>
<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-4 mx-5">
    <div class="col">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold">Data Pasien</div>
        <div class="card-body">
          <h5 class="card-title"><a href="../pasien_data/tambah.php" class="btn btn-primary">Tambah Data</a> | <a href="../laporan/laporan_pasien.php" class="btn btn-warning">Laporan Data Pasien</a></h5>
          
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil_hapus") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data pasien berhasil di hapus!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_tambah") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data pasien berhasil di tambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            } elseif ($_GET['pesan'] == "berhasil_update") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data pasien berhasil di update!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
          <table id="example" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Pasien</th>
                <th>Nama</th>
                <th>Jenis Kel.</th>
                <th>Jenis Pas.</th>
                <th>Telepon</th>
                <!-- <th>Alamat</th> -->
                <th>Pilihan</th>
              </tr>
            </thead>
            <tbody>
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
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['kode_pasien']; ?></td>
                  <td><?php echo $row['nama_pasien']; ?></td>
                  <td><?php if($row['jenis_kelamin']=="L") { echo "Laki-laki"; }else{ echo"Perempuan"; } ?></td>
                  <td><?php if($row['jenis_pasien']=="1") { echo "Pasien Baru"; }else{ echo"Pasien Lama"; } ?></td>
                  <td><?php echo $row['telepon']; ?></td>
                  <td>
                    <a href="#" class="text-info" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['kode_pasien'] ?>"><i class="fas fa-eye"></i></a>
                    <a href="../pasien_data/edit.php?id=<?php echo $row['id']; ?>" class="text-success"><i class="fas fa-pencil-alt"></i></a>
                    <a href="../pasien_data/hapus.php?id=<?php echo $row['id']; ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a>
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
$query = "SELECT `pendaftaran`.*, `layanan`.`nama_layanan`, `layanan`.`harga_layanan`, `pasien`.`nama_pasien`, `pasien`.`jenis_kelamin`, `pasien`.`golongan_darah`, `pasien`.`telepon`, `pasien`.`jenis_pasien`, `pasien`.`alamat` FROM `layanan` INNER JOIN `pendaftaran` ON `pendaftaran`.`kode_layanan` = `layanan`.`kode_layanan` INNER JOIN `pasien` ON `pendaftaran`.`kode_pasien` = `pasien`.`kode_pasien`";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query Error: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
}

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
  setlocale(LC_ALL, 'id-ID', 'id_ID');
  $tgl = strftime("%d %B %Y", strtotime($row['tgl_pendaftaran']));
?>
  <div class="modal fade" id="exampleModal<?= $row['kode_pasien'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Pasien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row d-flex justify-content-center fs-5 fw-bold">
            <?= $row['nama_pasien']; ?>
          </div>
          <div class="row">
            <label for="staticEmail" class="col-4 col-form-label">Jenis Kelamin</label>
            <div class="col">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php if($row['jenis_kelamin']=="L") { echo "Laki-laki"; }else{ echo"Perempuan"; } ?>">
            </div>
          </div>
          <div class="row">
            <label for="staticEmail" class="col-4 col-form-label">Golongan Darah</label>
            <div class="col">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= strtoupper($row['golongan_darah']); ?>">
            </div>
          </div>
          <div class="row">
            <label for="staticEmail" class="col-4 col-form-label">Jenis Pasien</label>
            <div class="col">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $row['jenis_pasien']; ?>">
            </div>
          </div>
          <div class="row">
          <label for="staticEmail" class="col-sm col-form-label">Tanggal Daftar</label>
              <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $tgl; ?>">
              </div>
          </div>
          <div class="row">
            <label for="staticEmail" class="col-4 col-form-label">Alamat</label>
            <div class="col">
              <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $row['jenis_kelamin']; ?>">
              <textarea name="" id="" readonly class="form-control-plaintext" cols="15" rows="3"><?= $row['alamat']; ?></textarea>
            </div>
          </div>
          <div class="mb-3 row d-flex justify-content-center fs-5 fw-bold">
            Data Berobat Pasien
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