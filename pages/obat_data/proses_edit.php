<?php 
include '../../config/connection.php';

$id = $_POST['id'];
$nama_obat = $_POST['nama_obat'];
$jenis_obat = $_POST['jenis_obat'];
// $harga = $_POST['harga'];

// mysqli_query($koneksi,"UPDATE obat SET nama_obat='$nama_obat', jenis_obat='$jenis_obat', harga='$harga' WHERE id='$id'");
mysqli_query($koneksi,"UPDATE obat SET nama_obat='$nama_obat', jenis_obat='$jenis_obat' WHERE id='$id'");
header("location:../admin/data_obat.php?pesan=berhasil_update");

?>