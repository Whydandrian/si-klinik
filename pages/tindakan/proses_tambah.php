<?php 
include '../../config/connection.php';

$nama_obat = $_POST['nama_obat'];
$jenis_obat = $_POST['jenis_obat'];
// $harga = $_POST['harga'];
// mysqli_query($koneksi,"insert into obat values('','$nama_obat','$jenis_obat','$harga')");
mysqli_query($koneksi,"insert into obat values('','$nama_obat','$jenis_obat')");
header("location:../admin/data_obat.php?pesan=berhasil_tambah");

?>