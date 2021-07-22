<?php 
include '../../config/connection.php';

$id_transaksi = $_POST['id_transaksi'];
$kode_pasien = $_POST['kode_pasien'];
$id_obat = $_POST['id_obat'];
$harga_obat = $_POST['harga_obat'];
$jumlah = $_POST['jumlah'];
$harga_total = $_POST['harga_total'];

mysqli_query($koneksi,"INSERT INTO biaya_pasien VALUES('','$id_transaksi','$kode_pasien','$id_obat','$harga_obat','$jumlah','$harga_total')");

header("location:resep_pasien.php?pesan=transaksi_berhasil");

?>