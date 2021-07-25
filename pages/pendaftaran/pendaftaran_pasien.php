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
    <div class="col-12">
      <div class="card border-primary mb-3">
        <div class="card-header fw-bold fs-5 d-flex justify-content-between">Pendaftaran Pasien Klinik
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil") {
              echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Registrasi pasien berhasil!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          }
          ?>
          <h5 class="text-secondary">Tanggal registrasi : <?= date("d M Y") ?></h5>
        </div>
        <div class="card-body">
          <form method="post" class="form-user">
            <div class="row">
              <div class="col row">
                <div class="card border-0">
                  <div class="card-header fs-5 bg-info text-white d-flex justify-content-between">
                    Data Pasien
                  </div>
                  <div class="card-body">
                    <!-- ambil pegawai lama atau baru -->
                    <div class="pilihan-pegawai">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="pegawai_pilihan" id="cek_pegawai_lama" value="1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Data Pegawai Lama Klik disini!
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="pegawai_pilihan" id="cek_pegawai_baru" value="2" checked="checked">
                        <label class="form-check-label" for="flexRadioDefault2">
                          Tambah Data Pegawai Baru Klik disini!
                        </label>
                      </div>
                    </div>
                    <!-- Show input pegawai lama -->
                    <div class="col" id="data-pasien-lama">
                      <div class="row">
                        <div class="col">
                          <div class="mb-2">
                            <label for="kode_poli" class="form-label">Pilih Nama Pasien</label>
                            <select name="kd_pasien" class="form-select form-select-sm" id="kd_pasien" onchange="changeValue(this.value)">
                              <option value=0>-Pilih-</option>
                              <?php
                              $query = "SELECT * FROM pasien ORDER BY nama_pasien ASC";
                              $result = mysqli_query($koneksi, $query);
                              $jsArray = "var dtMhs = new Array();\n";
                              while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['kode_pasien'] . '">' . $row['nama_pasien'] . '</option>';
                                $jsArray .= "dtMhs['" . $row['kode_pasien'] . "'] = {nama_pasien:'" . addslashes($row['nama_pasien']) . "',kode_pasien:'" . addslashes($row['kode_pasien']) . "',alamat:'" . addslashes($row['alamat']) . "',telepon:'" . addslashes($row['telepon']) . "',jenis_kelamin:'" . addslashes($row['jenis_kelamin']) . "'};\n";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="mb-2">
                            <label for="kode_pasien" class="form-label">Kode Pasien</label>
                            <input type="text" class="form-control form-control-sm" readonly name="kode_psn" id="psn_kode">
                          </div>
                          <div class="mb-2">
                            <label for="jns_kelamin" class="form-label">Jenis Kelamin</label>
                            <input type="text" readonly class="form-control form-control-sm" readonly name="jns_kelamin" id="jns_kelamin">
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-2">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control form-control-sm" readonly name="nm_pasien" id="psn_nama">
                          </div>
                          <div class="mb-2">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm" readonly id="tlp" name="tlp_pasien" placeholder="081234567891">
                          </div>
                          <div class="mb-2">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control form-control-sm" readonly name="alamat" id="almt" cols="20" rows="2"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="data-pasien-baru">
                      <div class="row">
                        <div class="col">
                          <div class="mb-2">
                            <label for="kode_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control form-control-sm" name="nama_pasien" placeholder="Nama Lengkap Pasien" id="nama_pasien">
                          </div>
                          <div class="mb-2">
                            <label for="nik_ktp" class="form-label">NIK/KTP</label>
                            <input type="text" class="form-control form-control-sm" name="nik_ktp" id="nik_ktp" placeholder="16 Digit Angka" maxlength="16">
                          </div>
                          <div class="mb-2">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <div class="row ms-2">
                              <div class="col form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L">
                                <label class="form-check-label" for="laki-laki">
                                  Laki-Laki
                                </label>
                              </div>
                              <div class="col form-check me-4">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P">
                                <label class="form-check-label" for="perempuan">
                                  Perempuan
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="mb-2">
                            <label for="tempat_lahir" class="form-label">Golongan Darah</label>
                            <input type="text" class="form-control form-control-sm" id="golongan_darah" name="golongan_darah" placeholder="A, B, O, AB">
                          </div>
                          <div class="mb-2">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="081234567891">
                          </div>
                          <div class="mb-2">
                            <label for="alamat_pasien" class="form-label">Alamat</label>
                            <textarea class="form-control form-control-sm" name="alamat" id="alamat" cols="30" rows="4" placeholder="Alamat Lengkap"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- </form> -->
                  </div>
                </div>
              </div>

              <!-- Data Keluhan -->
              <div class="col-5">
                <div class="card border-0">
                  <div class="card-header fs-5 bg-warning text-secondary">
                    Keluhan Pasien
                  </div>
                  <div class="card-body">
                    <div class="mb-2">
                      <label for="kode_poli" class="form-label">Poli Tujuan</label>
                      <select class="form-select form-select-sm" name="kode_poli" id="kode_poli">
                        <option>Pilih Tujuan Poli</option>
                        <?php
                        $query = "SELECT * FROM poli_tujuan ORDER BY nama_poli ASC";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                          die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                        }
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <option value="<?= $row['kode_poli'] ?>"><?= $row['nama_poli'] ?></option>
                        <?php
                          $no++;
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-2">
                      <label for="kode_layanan" class="form-label">Layanan Pasien</label>
                      <select class="form-select form-select-sm" name="kode_layanan" id="kode_layanan">
                        <option>Pilih Layanan Pasien</option>
                        <?php
                        $query = "SELECT * FROM layanan ORDER BY nama_layanan ASC";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                          die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                        }
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <option value="<?= $row['kode_layanan'] ?>"><?= $row['nama_layanan'] ?></option>
                        <?php
                          $no++;
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-2">
                      <label for="keluhan" class="form-label">Keluhan Pasien</label>
                      <textarea name="keluhan" id="keluhan" class="form-control form-control-sm" cols="15" rows="4" placeholder="Tulis keluhan pasien lengkap"></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <a class="tombol-simpan btn btn-primary btn-md fs-5 fw-bold">Register Pasien</a>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Register Pasien</button> -->
            <!-- <a href="../admin/data_obat.php" class="btn btn-warning">Kembali</a> -->

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>