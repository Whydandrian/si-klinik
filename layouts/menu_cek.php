<?php

if(isset($_GET['page'])){
	$page=$_GET['page'];
}
switch($page){	
	case "data-user":
		include "../halaman_admin.php";//memanggil file header.php
		include "menu.php";
	break;
	case "data-user":
		include "../pages/admin/data_user.php";//memanggil file header.php
		include "menu.php";
	break;
	case "data-user":
		include "../pages/admin/data_user.php";//memanggil file header.php
		include "menu.php";
	break;
	case "data-user":
		include "../pages/admin/data_user.php";//memanggil file header.php
		include "menu.php";
	break;
	
}

?>