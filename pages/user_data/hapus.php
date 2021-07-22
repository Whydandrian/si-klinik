<?php 
include '../../config/connection.php';
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM user WHERE user_id='$id'");
header("location:../admin/data_user.php?pesan=berhasil_hapus");

?>