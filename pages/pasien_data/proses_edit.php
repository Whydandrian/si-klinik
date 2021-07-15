<?php 
include '../../config/connection.php';
$id = $_POST['id'];
$kode_pasien = $_POST['kode_pasien'];
$nama_pasien = $_POST['nama_pasien'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$golongan_darah = $_POST['golongan_darah'];
$telepon = $_POST['telepon'];
$jenis_pasien = $_POST['jenis_pasien'];
$alamat_pasien = $_POST['alamat_pasien'];

mysqli_query($koneksi,"UPDATE pasien SET nama_pasien='$nama_pasien', jenis_kelamin='$jenis_kelamin', golongan_darah='$golongan_darah', telepon='$telepon', jenis_pasien='$jenis_pasien', alamat_pasien='$alamat_pasien' WHERE id='$id'");
header("location:../admin/data_pasien.php?pesan=berhasil_update");

?>