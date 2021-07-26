<?php 
include '../../config/connection.php';
// Create Auto kode Pasien
$qryTrans = mysqli_query($koneksi, "SELECT max(kode_transaksi) as kode_transaksi FROM biaya_pasien");
$dataTrans = mysqli_fetch_array($qryTrans);
$kodeTrans = $dataTrans['kode_transaksi'];
$ll = (int) substr($kodeTrans, 5, 3);
$ll++;

$kd = "TRANS";

// kode transaksi baru
$kode_transaksi_baru = $kd . sprintf("%03s", $ll);
$tgl_pendaftaran = date("Y-m-d");
$kode_pendaftaran = $_POST['kd_pasien'];
$kode_obat = $_POST['kode_obat'];
$jumlah = $_POST['jumlah'];
$harga_total = $_POST['harga_total'];

mysqli_query($koneksi,"INSERT INTO biaya_pasien VALUES('','$kode_transaksi_baru','$tgl_pendaftaran','$kode_pendaftaran','$kode_obat','$jumlah','$harga_total')");
?>