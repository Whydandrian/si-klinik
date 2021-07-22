<?php 
include '../../config/connection.php';
$kd = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM obat WHERE kode_obat='$kd'");
header("location:../admin/data_obat.php?pesan=berhasil_hapus");

?>