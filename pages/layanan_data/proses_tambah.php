<?php 
include '../../config/connection.php';

$nama_layanan = $_POST['nama_layanan'];
$harga_layanan = $_POST['harga_layanan'];
$kode_layanan = $_POST['kode_layanan'];

mysqli_query($koneksi,"INSERT INTO layanan VALUES('','$kode_layanan','$nama_layanan','$harga_layanan')");
header("location:../admin/data_layanan.php?pesan=berhasil_tambah");

?>