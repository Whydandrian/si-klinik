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
		#customers {
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

		#customers td,
		#customers th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#customers tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		#customers tr:hover {
			background-color: #ddd;
		}

		#customers th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #04AA6D;
			color: white;
		}
	</style>
</head>

<body>
	<div>
		<h2 id="header">Laporan Data Pegawai</h2>

		<table id="customers">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Pegawai</th>
					<th>Jenis Kelamin</th>
					<th>Agama</th>
					<th>Jabatan</th>
					<th>Tempat Lahir</th>
					<th>Tgl. Lahir</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$query = "SELECT * FROM pegawai ORDER BY nama_pegawai ASC";
				$dewan1 = $koneksi->prepare($query);
				$dewan1->execute();
				$res1 = $dewan1->get_result();

				if ($res1->num_rows > 0) {
					while ($row = $res1->fetch_assoc()) {
						setlocale(LC_ALL, 'id-ID', 'id_ID');
						$nama_pegawai = $row['nama_pegawai'];
						$jenis_kelamin = $row['jenis_kelamin'];
						$agama = $row['agama'];
						$jabatan = $row['jabatan'];

						$tanggal_lahir = strftime("%d %B %Y", strtotime($row['tanggal_lahir']));
						$tempat_lahir = $row['tempat_lahir'];

						echo "<tr>";
						echo "<td>" . $no++ . "</td>";
						echo "<td>" . $nama_pegawai . "</td>";
						if ($jenis_kelamin == "L") {
							echo "<td>Laki-laki</td>";;
						} else {
							echo "<td>Perempuan</td>";
						}
						echo "<td>" . $agama . "</td>";
						echo "<td>" . $jabatan . "</td>";
						echo "<td>" . $tempat_lahir . "</td>";
						echo "<td>" . $tanggal_lahir . "</td>";
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