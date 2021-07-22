<?php 
include '../../config/connection.php';
$query = mysqli_query($koneksi, "SELECT max(kode_layanan) as kodeTerbesar FROM layanan");
$data = mysqli_fetch_array($query);
$kodeLayanan = $data['kodeTerbesar'];
$urutan = (int) substr($kodeLayanan, 3, 2);
$urutan++;

$huruf = "LYN";

$kodeLayanan = $huruf . sprintf("%02s", $urutan);
$nama_layanan = $_POST['nama_layanan'];
$harga_layanan = $_POST['harga_layanan'];

mysqli_query($koneksi,"INSERT INTO layanan VALUES('','$kodeLayanan','$nama_layanan','$harga_layanan')");
header("location:../admin/data_layanan.php?pesan=berhasil_tambah");

?>