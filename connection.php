<?php 
$koneksi = mysqli_connect("localhost","root","","klinik");
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>