<?php
require_once '../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

include '../../config/connection.php';

$nama_dokumen = md5(rand());
ob_start();

include '../../layouts/auth/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<style>
		#obat {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#header {
			text-align: center;
			font-family: Arial;
			font-size: 2rem;
			font-weight: bold;
		}

		#obat td,
		#obat th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#obat tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		#obat tr:hover {
			background-color: #ddd;
		}

		#obat th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #B9FAF8;
			color: #646464;
		}
	</style>
</head>

<body>
	<div>
		<h2 id="header">Laporan Data Obat</h2>

		<table id="obat">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Obat</th>
					<th>Nama Obat</th>
					<th>Jenis Obat</th>
					<th>Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$query = "SELECT `obat`.*, `jenis_obat`.`nama_jenis_obat` FROM `jenis_obat` INNER JOIN `obat` ON `obat`.`id_jenis_obat` = `jenis_obat`.`id` ORDER BY `obat`.`nama_obat` ASC";
				$dewan1 = $koneksi->prepare($query);
				$dewan1->execute();
				$res1 = $dewan1->get_result();

				if ($res1->num_rows > 0) {
					while ($row = $res1->fetch_assoc()) {
						$kode_obat = $row['kode_obat'];
						$nama_obat = $row['nama_obat'];
						$jenis_obat = $row['nama_jenis_obat'];
						$harga_obat = $row['harga_obat'];
						echo "<tr>";
						echo "<td>" . $no++ . "</td>";
						echo "<td>" . $kode_obat . "</td>";
						echo "<td>" . $nama_obat . "</td>";
						echo "<td>" . $jenis_obat . "</td>";
						echo "<td>Rp " . number_format($harga_obat, 0, ",", ".") . "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr>";
					echo "<td colspan='5'>Tidak ada data ditemukan</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<?php
	include '../../layouts/auth/footer.php';
	$html = ob_get_contents();
	ob_end_clean();

	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen . ".pdf", 'D');
	clearstatcache();
	$koneksi->close();
	header("location:../admin/data_pegawai.php");
	?>
</body>

</html>