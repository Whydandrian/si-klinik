<?php
include '../config/connection.php';
$query = mysqli_query($koneksi,"SELECT * FROM pasien WHERE kode_pasien='$_GET[kode_pegawai]'");
$user = mysqli_fetch_array($query);
$data = array('nama_pasien' => $user['nama_pasien'],'kode_pasien' => $user['kode_pasien']);
      echo json_encode($data);
 ?>