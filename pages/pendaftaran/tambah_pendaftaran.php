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

$nik_ktp = $_POST['nik_ktp'];
$data = mysqli_query($koneksi, "SELECT kode_pasien FROM pasien WHERE nik_ktp='$nik_ktp'");
$no_ktp = mysqli_fetch_array($data);
$ktp_nik = $no_ktp['nik_ktp'];
echo $ktp_nik;
$tgl_pendaftaran = date("Y-m-d");
$kpasien_kode = $_POST['kd_pasien'];
$poli_tujuan = $_POST['kode_poli'];
$kode_layanan = $_POST['kode_layanan'];
$keluhan = $_POST['keluhan'];

mysqli_query($koneksi, "INSERT INTO pendaftaran VALUES('','$kode_pendaftaran','$tgl_pendaftaran','$kpasien_kode','$poli_tujuan','$kode_layanan','$keluhan')");
