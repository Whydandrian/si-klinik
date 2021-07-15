<?php 
include '../../config/connection.php';
$kode_pasien = $_POST['kode_pasien'];
$nama_pasien = $_POST['nama_pasien'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$golongan_darah = $_POST['golongan_darah'];
$telepon = $_POST['telepon'];
$jenis_pasien = $_POST['jenis_pasien'];
$alamat_pasien = $_POST['alamat_pasien'];

mysqli_query($koneksi, "INSERT INTO pasien VALUES('','$kode_pasien','$nama_pasien','$jenis_kelamin','$golongan_darah','$telepon','$jenis_pasien','$alamat_pasien')");
header("location:../admin/data_pasien.php?pesan=berhasil_tambah");

?>