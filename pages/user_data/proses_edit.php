<?php 
include '../../config/connection.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$level = $_POST['level'];

mysqli_query($koneksi,"update user set nama='$nama', username='$username', level='$level' where id='$id'");
header("location:../admin/data_user.php?pesan=berhasil_update");

?>