<!-- Menu -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-fluid mx-5">
    <a class="navbar-brand" href="<?php if ($_SESSION['level'] === "admin") { echo "../admin/dashboard.php"; } elseif ($_SESSION['level'] === "admin_daftar") { echo "../pendaftaran/pendaftaran_pasien.php"; } elseif ($_SESSION['level'] === "admin_obat") { echo "../tindakan/resep_pasien.php"; } ?>">KLINIK |
      <?php
      if ($_SESSION['level'] === "admin") {
        echo "<span class='badge bg-primary fs-6'>Administrator</span>";
      } elseif ($_SESSION['level'] === "admin_daftar") {
        echo "<span class='badge bg-success fs-6'>Pendaftaran</span>";
      } elseif ($_SESSION['level'] === "admin_obat") {
        echo "<span class='badge bg-info fs-6'>Pengambilan Obat</span>";
      }
      ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if ($_SESSION['level'] === "admin_daftar") {
        ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../admin/data_pasien.php">Data Pasien</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../pendaftaran/pendaftaran_pasien.php">Pendaftaran Pasien</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../tindakan/resep_pasien.php">Pembuatan Resep</a>
          </li> -->
        <?php } elseif ($_SESSION['level'] === "admin") { ?>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Data Master
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../admin/data_user.php">Data User</a></li>
              <li><a class="dropdown-item" href="../admin/data_obat.php">Data Obat</a></li>
              <li><a class="dropdown-item" href="../admin/data_layanan.php">Data Layanan</a></li>
              <li><a class="dropdown-item" href="../admin/data_pegawai.php">Data Pegawai</a></li>
              <li><a class="dropdown-item" href="../admin/data_dokter.php">Data Dokter</a></li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a class="dropdown-item" href="../admin/data_user.php">Data User <i class="fas fa-user-friends text-info"></i></a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="../admin/data_obat.php">Data Obat <i class="fas fa-pills text-info"></i></a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="../admin/data_layanan.php">Data Layanan <i class="fas fa-hospital text-info"></i></a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="../admin/data_pegawai.php">Data Pegawai <i class="fas fa-people-arrows text-warning"></i></a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="../laporan/laporan.php">Laporan <i class="fas fa-file-pdf text-info"></i></a>
          </li>
        <?php } elseif ($_SESSION['level'] === "admin_obat") { ?>
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../tindakan/resep_pasien.php">Tagihan Pasien</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../tindakan/tagihan_pasien.php">Data Tagihan Pasien</a>
          </li>
        <?php } ?>
      </ul>
      <li class="nav-item dropdown d-flex">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php
        $username = $_SESSION['username'];
          $result = mysqli_query($koneksi, "SELECT `pegawai`.`nama_pegawai`, `pegawai`.`jenis_kelamin`, `pegawai`.`foto` FROM `pegawai` INNER JOIN `user` ON `user`.`kode_pegawai` = `pegawai`.`kode_pegawai` WHERE `user`.`username`='$username'");
          while ($user_data = mysqli_fetch_array($result)) {
            $nama_pegawai = $user_data['nama_pegawai'];
            $foto = $user_data['foto'];
          }
          ?>
        <?= $nama_pegawai;?>
        </a>
        <ul class="dropdown-menu border-0" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Profile User <i class="fas fa-user-circle text-info"></i></a></li>
          <li>
            <hr class="dropdown-divider bg-primary">
            <li><a class="dropdown-item" href="../../logout.php">Logout <i class="fas fa-sign-out-alt text-danger"></i></a></li>
          </li>
        </ul>
      </li>
    </div>
  </div>
</nav>
<!-- Akhir Menu -->