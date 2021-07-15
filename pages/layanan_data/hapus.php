<?php 
include '../../config/connection.php';
$kd = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM layanan WHERE id='$kd'");
header("location:../admin/data_layanan.php?pesan=berhasil_hapus");

?>