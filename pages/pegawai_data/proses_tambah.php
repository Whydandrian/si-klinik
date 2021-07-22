<?php
include '../../config/connection.php';
$qry = mysqli_query($koneksi, "SELECT max(kode_pegawai) as kode_pegawai FROM pegawai");
$pegawai = mysqli_fetch_array($qry);
$pegawai_kode = $pegawai['kode_pegawai'];

$data = (int) substr($pegawai_kode, 3, 2);
$data++;
$kd = "PAG";

//Buat Kode pegawai Baru
$kd_pegawai = $kd . sprintf("%02s", $data);
$nama_pegawai = $_POST['nama_pegawai'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jabatan = $_POST['jabatan'];
$pendidikan = $_POST['pendidikan'];
$alamat = $_POST['alamat'];

$rand = rand();
$ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
	header("location:tambah.php?pesan=gagal");
} else {
	if ($ukuran < 1044070) {
		$foto = $rand . '_' . $filename;
		move_uploaded_file($_FILES['foto']['tmp_name'], '../../images/' . $rand . '_' . $filename);
		mysqli_query($koneksi, "INSERT INTO pegawai VALUES('', '$kd_pegawai','$nama_pegawai','$jenis_kelamin','$agama','$tempat_lahir','$tanggal_lahir','$jabatan','$pendidikan','$foto','$alamat')");
		header("location:../admin/data_pegawai.php?pesan=berhasil_tambah");
	} else {
		header("location:tambah.php?pesan=ukuran_salah");
	}
}
