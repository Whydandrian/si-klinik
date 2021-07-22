<?php 
include '../../config/connection.php';

$id = $_POST['id'];
$username = $_POST['username'];
$password = md5($_POST['password']); 
$kode_pegawai = $_POST['kode_pegawai'];
$level = $_POST['level'];

if ($password=="") {
  mysqli_query($koneksi,"UPDATE user SET username='$username', kode_pegawai='$kode_pegawai', level='$level' WHERE id='$id'");
  header("location:../admin/data_user.php?pesan=berhasil_update");
} else {
  mysqli_query($koneksi,"UPDATE user SET username='$username', password='$password', kode_pegawai='$kode_pegawai', level='$level' WHERE id='$id'");
  header("location:../admin/data_user.php?pesan=berhasil_update");
}


?>