<?php 
include '../../config/connection.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$level = $_POST['level'];
$password = md5($_POST['password']); 

mysqli_query($koneksi,"UPDATE user SET nama='$nama', username='$username', password='$password', level='$level' WHERE id='$id'");
header("location:../admin/data_user.php?pesan=berhasil_update");

?>