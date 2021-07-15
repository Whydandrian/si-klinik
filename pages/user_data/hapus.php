<?php 
include '../../config/connection.php';
$id = $_GET['id'];
mysqli_query($koneksi,"delete from user where id='$id'");
header("location:../admin/data_user.php?pesan=berhasil_hapus");

?>