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
if ($_SESSION['level'] != "admin_obat") {
  header("location:../error404.php?pesan=hak_akses_salah");
}


$qry = mysqli_query($koneksi, "SELECT max(kode_transaksi) as kodeTransaksi FROM biaya_pasien  ");
$dataDaftar = mysqli_fetch_array($qry);
$kodeTransaksi = $dataDaftar['kodeTransaksi'];
$list = (int) substr($kodeTransaksi, 5, 3);
$list++;
$kd = "TRANS";
$kodeTransaksi = $kd . sprintf("%03s", $list);

?>
<div class="container-fluid">
  <div class="row col">
    <?php include_once('../../layouts/menu.php'); ?>
  </div>
  <div class="row d-flex justify-content-center mt-2 mx-3">
    <div class="col-12">
      <div class="card border-primary mb-1">
        <div class="card-header fw-bold fs-5">Pengambilan Resep Pasien
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "transaksi_berhasil") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Tansaksi biaya obat pasien berhasil!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
        </div>
        <div class="card-body">
          <div class="row  align-items-center">
            <div class="col-auto">
              <label for="kode" class="col-form-label">Kode Transaksi</label>
            </div>
            <div class="col-auto">
              <span id="kode" class="form-text fs-6">
                <?= $kodeTransaksi ?>
              </span>
            </div>
            <div class="col d-flex justify-content-end">
              <h5 class="text-secondary">Tanggal registrasi : <?= date("d M Y") ?></h5>
            </div>
          </div>
          <form method="POST" action="proses_tambah.php" class="row" id="biaya-form">
            <div class="col-7">
              <div class="card border-0">
                <div class="card-header fs-6 bg-info text-white  fw-bold">
                  Data Pasien
                </div>
                <div class="card-body">
                  <div class="mb-2">
                    <input type="hidden" readonly name="id_transaksi" value="<?= $kodeTransaksi ?>">
                    <label for="kode_pasien" class="form-label  fw-bold">Cari Nama Pasien</label>
                    <select name="kd_pasien" class="form-select form-select-sm" id="kd_pasien" onchange="changeValue(this.value)">
                      <option value=0>-Pilih Nama Pasien-</option>
                      <?php
                      $query = "SELECT `pendaftaran`.`kode_pendaftaran`, `pendaftaran`.`kode_pasien`, `pasien`.`nama_pasien`,`pasien`.`alamat`, `pendaftaran`.`kode_layanan`, `layanan`.`nama_layanan`, SUM(`layanan`.`harga_layanan`) as tagihan_layanan FROM `layanan` INNER JOIN `pendaftaran` ON `pendaftaran`.`kode_layanan` = `layanan`.`kode_layanan` INNER JOIN `pasien` ON `pendaftaran`.`kode_pasien` = `pasien`.`kode_pasien` GROUP BY `pendaftaran`.`kode_pasien` ORDER BY `pasien`.`nama_pasien` ASC";
                      $result = mysqli_query($koneksi, $query);
                      $jsArray = "var dtMhs = new Array();\n";
                      while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['kode_pasien'] . '">' . $row['nama_pasien'] . '</option>';
                        $jsArray .= "dtMhs['" . $row['kode_pasien'] . "'] = {nama_pasien:'" . addslashes($row['nama_pasien']) . "', tagihan_layanan:'" . addslashes($row['tagihan_layanan']) . "', kode_pasien:'" . addslashes($row['kode_pasien']) . "', nama_layanan:'" . addslashes($row['nama_layanan']) . "', alamat:'" . addslashes($row['alamat']) . "'};\n";
                      }
                      ?>
                    </select>
                  </div>
                  <!-- Dua kolom detail data pasien -->
                  <div class="row">
                    <div class="col">
                      <div class="mb-2">
                        <label for="tagihan" class="form-label fw-bold">Nama Pasien</label>
                        <input type="text" id="tagihan_layanan" name="tagihan_layanan" class="ms-2 fw-bold fs-5 form-control-plaintext form-control-sm bg-light">
                      </div>
                      <div class="mb-3">
                        <label for="alamat_pasien" class="form-label fw-bold">Alamat</label>

                        <textarea id="alamat_pasien" name="alamat_pasien" class="bg-light form-control-plaintext ms-2 fw-bold" cols="15" rows="3"></textarea>
                      </div>

                    </div>
                    <div class="col">
                      <div class="mb-2">
                        <label for="nm_layanan" class="form-label fw-bold">Nama Layanan</label>
                        <input type="text" id="nama_layanan" name="nama_layanan" class="ms-2 fw-bold fs-5 form-control-plaintext form-control-sm bg-light">
                      </div>
                      <div class="mb-3">
                        <label for="tagihan" class="form-label fw-bold">Tagihan Layanan</label>
                        <input type="text" id="total_tagihan_layanan" name="total_tagihan_layanan" class="bg-light form-control-plaintext ms-2 fw-bold fs-4 text-danger ">
                      </div>

                    </div>
                  </div>
                  <!-- end dua kolom -->

                </div>
              </div>
            </div>
            <div class="col">
              <div class="card border-0">
                <div class="card-header fs-6 bg-info text-white fw-bold">
                  Total Transaksi
                </div>

                <div class="card-body">
                  <div class="mb-2">
                    <label for="id_obat" class="form-label fw-bold">Obat Pasien</label>
                    <select name="kode_obat" class="form-select form-select-sm" id="kode_obat" onchange="obatValue(this.value)">
                      <option value=0>-Pilih Nama Obat-</option>
                      <?php
                      $qry = "SELECT * FROM obat";
                      $res = mysqli_query($koneksi, $qry);
                      $jsArrayObat = "var dtMhsObat = new Array();\n";
                      while ($rowObat = mysqli_fetch_array($res)) {
                        echo '<option value="' . $rowObat['kode_obat'] . '">' . $rowObat['nama_obat'] . '</option>';
                        $jsArrayObat .= "dtMhs['" . $rowObat['kode_obat'] . "'] = {nama_obat:'" . addslashes($rowObat['nama_obat']) . "', harga_obat:'" . addslashes($rowObat['harga_obat']) . "'};\n";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-2">
                    <label for="jumlah" class="form-label fw-bold">Jumlah Obat</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control form-control-sm" min="0" max="10" onkeypress='return restrictAlphabets(event)'>
                  </div>
                  <div class="mb-2">
                    <label for="harga" class="form-label fw-bold">Harga Obat</label>
                    <input type="text" id="harga_obat" name="harga_obat" class="bg-light form-control-plaintext fw-bold fs-4 text-danger">
                  </div>
                  <div class="mb-2">
                    <label for="keluhan" class="form-label fs-5 fw-bold">Total Harga</label>
                    <input type="text" name="harga_total" id="harga_total" class="form-control form-control-sm fs-3 fw-bold text-danger harga_total" readonly>
                  </div>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-warning fs-4 fw-bold">Total</button>
            <!-- <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a> -->
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>