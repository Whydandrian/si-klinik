<?php 
include '../../config/connection.php';
$kode_daftar = $_POST['kode_daftar'];
$kode_pasien = $_POST['kode_pasien'];
$tgl_daftar = date("Y-m-d");
$keluhan = $_POST['keluhan'];
$kode_layanan = $_POST['kode_layanan'];
$poli_tujuan = $_POST['poli_tujuan'];
$keterangan = $_POST['keterangan'];

mysqli_query($koneksi, "INSERT INTO pendaftaran VALUES('','$kode_daftar','$kode_pasien','$tgl_daftar','$keluhan','$kode_layanan','$poli_tujuan','$keterangan')");
header("location:pendaftaran_pasien.php?pesan=berhasil");

?>