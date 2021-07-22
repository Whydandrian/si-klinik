<?php 
include '../../config/connection.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];
$kode_pegawai = $_POST['kode_pegawai'];

// Kode user otomatis
$qry = mysqli_query($koneksi, "SELECT max(user_id) as user_id FROM user");
$user_id = mysqli_fetch_array($qry);
$user_id = $user_id['user_id'];

$list = (int) substr($user_id, 6, 4);
$list++;
$kd = "USRLGN0";
$kode_user = $kd . sprintf("%03s", $list);

mysqli_query($koneksi,"INSERT INTO user VALUES('','$kode_user','$username','$password', '$kode_pegawai','$level')");
header("location:../admin/data_user.php?pesan=berhasil_tambah");

?>