<?php 
include '../../config/connection.php';

$id = $_POST['id'];
$nama_obat = $_POST['nama_obat'];
$jenis_obat = $_POST['jenis_obat'];
$harga = $_POST['harga_obat'];

mysqli_query($koneksi,"UPDATE obat SET nama_obat='$nama_obat', id_jenis_obat='$jenis_obat', harga_obat='$harga' WHERE id='$id'");
header("location:../admin/data_obat.php?pesan=berhasil_update");

?>