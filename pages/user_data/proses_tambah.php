<?php 
include '../../config/connection.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];
mysqli_query($koneksi,"insert into user values('','$nama','$username','$password','$level')");
header("location:../admin/data_user.php?pesan=berhasil_tambah");

?>