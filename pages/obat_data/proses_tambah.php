<?php 
include '../../config/connection.php';

// Ambil kode obat terakhir
$qry = mysqli_query($koneksi, "SELECT max(kode_obat) as kode_obat FROM obat");
$obat = mysqli_fetch_array($qry);
$obat_kode = $obat['kode_obat'];

$data = (int) substr($obat_kode, 3, 3);
$data++;
$kd = "OBT";

//Buat Kode Obat Baru
$kd_obat = $kd . sprintf("%03s", $data);
$nama_obat = $_POST['nama_obat'];
$jenis_obat = $_POST['jenis_obat'];
$harga = $_POST['harga_obat'];

mysqli_query($koneksi,"INSERT INTO obat VALUES('', '$kd_obat','$nama_obat','$jenis_obat', '$harga')");
header("location:../admin/data_obat.php?pesan=berhasil_tambah");

?>