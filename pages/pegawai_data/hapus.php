<?php 
include '../../config/connection.php';
$kd = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM pegawai WHERE id='$kd'");
header("location:../admin/data_pegawai.php?pesan=berhasil_hapus");

?>