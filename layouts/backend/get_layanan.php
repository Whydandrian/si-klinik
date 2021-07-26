<?php
include "../../config/connection.php";
$kd_pas = $_POST['kode_pasien'];

// $query = mysqli_query($koneksi, "SELECT `pendaftaran`.`kode_pasien`, `layanan`.`nama_layanan`, SUM(`layanan`.`harga_layanan`) as total_tagihan_layanan FROM `layanan` INNER JOIN `pendaftaran` ON `pendaftaran`.`kode_layanan` = `layanan`.`kode_layanan` WHERE `pendaftaran`.`kode_pasien`='$kd_pas'");
// $layanan = mysqli_fetch_array($query);
// $data = array(
//   'nama_layanan' => $layanan['nama_layanan'],
//   'kode_pasien' => $layanan['kode_pasien'],
//   'total_tagihan_layanan' =>  $layanan['total_tagihan_layanan'],
// );
// json_encode($data);

// if (isset($kd_pas) && !empty($kd_pas)) {

  // $id = $_POST['id'];

  $query = "SELECT `pendaftaran`.`kode_pasien`, `layanan`.`nama_layanan`, SUM(`layanan`.`harga_layanan`) as total_tagihan_layanan FROM `layanan` INNER JOIN `pendaftaran` ON `pendaftaran`.`kode_layanan` = `layanan`.`kode_layanan` WHERE `pendaftaran`.`kode_pasien`='$kd_pas'";

  $result = $koneksi->query($query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data = json_encode($row);
    }
    echo $data;
  } else {
    echo "No record found";
  }
// }
