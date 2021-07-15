<?php 
include '../../config/connection.php';
$nama_pegawai = $_POST['nama_pegawai'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jabatan = $_POST['jabatan'];
$agama = $_POST['agama'];
$alamat = $_POST['alamat'];
$pendidikan = $_POST['pendidikan'];

$rand = rand();
$ekstensi =  array('png','jpg','jpeg','gif');
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array($ext,$ekstensi) ) {
	header("location:tambah.php?pesan=gagal");
}else{
	if($ukuran < 1044070){		
		$xx = $rand.'_'.$filename;
		move_uploaded_file($_FILES['foto']['tmp_name'], '../../images/'.$rand.'_'.$filename);
		mysqli_query($koneksi, "INSERT INTO pegawai VALUES('','$nama_pegawai','$jenis_kelamin','$tanggal_lahir','$tempat_lahir','$jabatan','$agama','$alamat','$pendidikan','$xx')");
		header("location:../admin/data_pegawai.php?pesan=berhasil_tambah");
	}else{
		header("location:tambah.php?pesan=ukuran_salah");
	}
}