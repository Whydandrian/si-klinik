<?php 
include '../../config/connection.php';
$id = $_POST['id'];
$nama_layanan = $_POST['nama_layanan'];
$harga_layanan = $_POST['harga_layanan'];

mysqli_query($koneksi,"UPDATE layanan SET nama_layanan='$nama_layanan', harga_layanan='$harga_layanan' WHERE id='$id'");
header("location:../admin/data_layanan.php?pesan=berhasil_update");

?>