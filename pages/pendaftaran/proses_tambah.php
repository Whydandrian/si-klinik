<?php 
include '../../config/connection.php';

$qry = mysqli_query($koneksi, "SELECT max(kode_pendaftaran) as kodeDaftar FROM pendaftaran");
$dataDaftar = mysqli_fetch_array($qry);
$kodeDaftar = $dataDaftar['kodeDaftar'];
$list = (int) substr($kodeDaftar, 3, 3);
$list++;
$kd = "REG";
$kode_daftar = $kd . sprintf("%03s", $list);

$tgl_daftar = date("Y-m-d");
$kode_pasien = $_POST['kode_pasien'];
$keluhan = $_POST['keluhan'];
$kode_layanan = $_POST['kode_layanan'];
$poli_tujuan = $_POST['poli_tujuan'];
$keterangan = $_POST['keterangan'];

mysqli_query($koneksi, "INSERT INTO pendaftaran VALUES('','$kode_daftar','$kode_pasien','$tgl_daftar','$keluhan','$kode_layanan','$poli_tujuan','$keterangan')");
header("location:pendaftaran_pasien.php?pesan=berhasil");

?>