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
        <div class="card-header fw-bold fs-5">Form Edit Pegawai</div>
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
        <?php
          include '../../config/connection.php';
          $id = $_GET['id'];

          $result = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id=$id");

          while ($pegawai_data = mysqli_fetch_array($result)) {
            $id = $pegawai_data['id'];
            $nama_pegawai = $pegawai_data['nama_pegawai'];
            $jenis_kelamin = $pegawai_data['jenis_kelamin'];
            $tanggal_lahir = $pegawai_data['tanggal_lahir'];
            $tempat_lahir = $pegawai_data['tempat_lahir'];
            $jabatan = $pegawai_data['jabatan'];
            $agama = $pegawai_data['agama'];
            $alamat = $pegawai_data['alamat'];
            $pendidikan = $pegawai_data['pendidikan'];
            $foto = $pegawai_data['foto'];
          }
          $tgl = date("Y-m-d", strtotime($tanggal_lahir));
          ?>
          <form method="POST" action="proses_edit.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
              <input type="hidden" name="foto_lama" value="<?= $foto?>">
              <input type="hidden" name="id" value="<?= $id?>">
              <input type="text" class="form-control form-control-sm" id="nama_pegawai" name="nama_pegawai" value="<?= $nama_pegawai;?>">
            </div>
            <div class="mb-3">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <div class="row ms-2">
                <div class="col form-check">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki" <?php if( strtolower($jenis_kelamin) === 'laki-laki' ) { echo "checked"; } ?> >
                  <label class="form-check-label" for="laki-laki"> 
                    Laki-Laki
                  </label>
                </div>
                <div class="col form-check me-4">
                  <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" <?php if( strtolower($jenis_kelamin) == "perempuan" ) { echo "checked"; } ?> >
                  <label class="form-check-label" for="perempuan">
                    Perempuan
                  </label>
                </div>
              </div>

            </div>
            <div class="mb-3">
              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
              <input type="text" class="form-control form-control-sm" id="tempat_lahir" name="tempat_lahir" value="<?= $tempat_lahir; ?>">
            </div>
            <div class="mb-3">
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control form-control-sm" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tgl;?>">
            </div>
            <div class="mb-3">
              <label for="jabatan" class="form-label">Jabatan Pegawai</label>
              <select class="form-select form-select-sm" name="jabatan" id="jabatan">
                <option>Pilih Jabatan Pegawai</option>
                <option value="Admin pendaftaran" <?php if (strtolower($jabatan) == "admin pendaftaran") { echo "selected"; } ?>>Admin Pendaftaran</option>
                <option value="Admin Obat" <?php if (strtolower($jabatan) == "admin obat") { echo "selected"; } ?>>Admin Obat</option>
                <option value="Apoteker" <?php if (strtolower($jabatan) == "apoteker") { echo "selected"; } ?>>Apoteker</option>
                <option value="Dokter" <?php if (strtolower($jabatan) == "dokter") { echo "selected"; } ?>>Dokter</option>
                <option value="Perawat" <?php if (strtolower($jabatan) == "perawat") { echo "selected"; } ?>>Perawat</option>
                <option value="CS" <?php if (strtolower($jabatan) == "cs") { echo "selected"; } ?>>Cleaning Service</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="agama" class="form-label">Agama</label>
              <select class="form-select form-select-sm" name="agama" id="agama">
                <option>Pilih Agama</option>
                <option value="Islam" <?php if (strtolower($agama) == "islam") { echo "selected"; } ?>>Islam</option>
                <option value="Hindu" <?php if (strtolower($agama) == "hindu") { echo "selected"; } ?>>Hindu</option>
                <option value="Budha" <?php if (strtolower($agama) == "budha") { echo "selected"; } ?>>Budha</option>
                <option value="Kristen" <?php if (strtolower($agama) == "kristen") { echo "selected"; } ?>>krister</option>
                <option value="Katholik" <?php if (strtolower($agama) == "katholik") { echo "selected"; } ?>>Katholik</option>
                <option value="Kong Huchu" <?php if (strtolower($agama) == "kong huchu") { echo "selected"; } ?>>Kong Huchu</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Pendidikan</label>
              <input type="text" class="form-control form-control-sm" id="pendidikan" name="pendidikan" value="<?= $pendidikan;?>">
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Pilih Foto</label>
              <input class="form-control form-control-sm" id="foto" name="foto" type="file">
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Alamat</label>
              <textarea class="form-control form-control-sm" name="alamat" id="alamat" cols="30" rows="4" placeholder="Alamat Lengkap"><?= $alamat;?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="../admin/data_pegawai.php" class="btn btn-warning">Kembali</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../../layouts/backend/footer.php'; ?>