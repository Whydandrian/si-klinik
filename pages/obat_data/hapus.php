<?php 
include '../../config/connection.php';
$kd = $_GET['id'];
mysqli_query($koneksi,"delete from obat where id='$kd'");
header("location:../admin/data_obat.php?pesan=berhasil_hapus");

?>