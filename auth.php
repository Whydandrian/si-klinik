<?php 
session_start();

include 'config/connection.php';

$username = $_POST['username'];
$password = md5($_POST['password']);


$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	if($data['level']=="admin"){

		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		$_SESSION['status'] = "login";
		header("location:pages/admin/dashboard.php");

	}else if($data['level']=="admin_daftar"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin_daftar";
		$_SESSION['status'] = "login";
		header("location:pages/pendaftaran/pendaftaran_pasien.php");

	}else if($data['level']=="admin_obat"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin_obat";
		$_SESSION['status'] = "login";
		header("location:pages/admin_obat/admin_obat.php");
	}else{
		header("location:?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}

?>