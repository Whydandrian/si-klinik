<?php
include '../../config/connection.php';
// Create auto kode registrasi
$qry = mysqli_query($koneksi, "SELECT max(kode_pendaftaran) as kodeDaftar FROM pendaftaran");
$dataDaftar = mysqli_fetch_array($qry);
$kodeDaftar = $dataDaftar['kodeDaftar'];
$list = (int) substr($kodeDaftar, 5, 5);
$list++;
$kd = "REGPS";
$kode_pendaftaran = $kd . sprintf("%05s", $list);
// echo $kode_pendaftaran . "<br>";

// Create Auto kode Pasien
$qryPasien = mysqli_query($koneksi, "SELECT max(kode_pasien) as kodePasien FROM pasien");
$dataRegistrasi = mysqli_fetch_array($qryPasien);
$kodeDaftarPasien = $dataRegistrasi['kodePasien'];
$ll = (int) substr($kodeDaftarPasien, 3, 3);
$ll++;
$kdPsn = "PSN";
// kode pasien baru
$autoKodePasien = $kdPsn . sprintf("%03s", $ll);
// echo $autoKodePasien . "<br>";

$nik_ktp = $_POST['nik_ktp'];
$nama_pasien = $_POST['nama_pasien'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$golongan_darah = $_POST['golongan_darah'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

$tgl_pendaftaran = date("Y-m-d");
$poli_tujuan = $_POST['kode_poli'];
$kode_layanan = $_POST['kode_layanan'];
$keluhan = $_POST['keluhan'];
// echo $psn_kd . "<br>";

mysqli_query($koneksi, "INSERT INTO pasien VALUES('','$autoKodePasien','$nik_ktp','$nama_pasien','$jenis_kelamin','$golongan_darah','1','$telepon','$alamat')");
sleep(1);
$getPasien = mysqli_query($koneksi, "SELECT kode_pasien FROM pasien WHERE nik_ktp='$nik_ktp'");
$pasien = mysqli_fetch_array($getPasien);
$psn_kd = $pasien['kode_pasien'];
sleep(2);
mysqli_query($koneksi, "INSERT INTO pendaftaran VALUES('','$kode_pendaftaran','$tgl_pendaftaran','$psn_kd','$poli_tujuan','$kode_layanan','$keluhan')");
// header("location:pendaftaran_pasien.php?pesan=berhasil");