<?php 
include '../../config/connection.php';
$kd = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM pasien WHERE id='$kd'");
header("location:../admin/data_pasien.php?pesan=berhasil_hapus");

?>