<?php
require_once '../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

include '../../config/connection.php';
$nama_dokumen = md5(rand());
ob_start();

include '../../layouts/auth/header.php';

?>

<div>
	<h2>Laporan Data Pegawai</h2>

	<table border="1">
		<thead>
			<tr>
				<td>No</td>
				<td>Nama Pasien</td>
				<td>Jn. Kelamin</td>
				<td>Tgl. Daftar</td>
				<td>Jn. Pasien</td>
				<td>Layanan</td>
				<td>Telepon</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = "SELECT `pendaftaran`.*, `layanan`.`nama_layanan`, `layanan`.`harga_layanan`, `pasien`.`nama_pasien`, `pasien`.`jenis_kelamin`, `pasien`.`telepon`, `pasien`.`jenis_pasien`, `pasien`.`alamat_pasien` FROM `layanan` INNER JOIN `pendaftaran` ON `pendaftaran`.`kode_layanan` = `layanan`.`kode_layanan` INNER JOIN `pasien` ON `pendaftaran`.`kode_pasien` = `pasien`.`kode_pasien` ORDER BY `pasien`.`nama_pasien` ASC";
			$dewan1 = $koneksi->prepare($query);
			$dewan1->execute();
			$res1 = $dewan1->get_result();

			if ($res1->num_rows > 0) {
				while ($row = $res1->fetch_assoc()) {
					setlocale(LC_ALL, 'id-ID', 'id_ID');
					$nama_pasien = $row['nama_pasien'];
					$nama_layanan = $row['nama_layanan'];
					$jenis_kelamin = $row['jenis_kelamin'];
					$telepon = $row['telepon'];
					$jenis_pasien = $row['jenis_pasien'];
					$tgl_daftar = strftime("%d %B %Y", strtotime($row['tgl_daftar']));

					echo "<tr>";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $nama_pasien . "</td>";
					echo "<td>" . $jenis_kelamin . "</td>";
					echo "<td>" . $tgl_daftar . "</td>";
					echo "<td>";
					if ($jenis_pasien == "baru") {
						echo "Pasien Baru";
					}
					"</td>";
					echo "</tr>";
					echo "<td>" . $nama_layanan . "</td>";
					echo "<td>" . $telepon . "</td>";
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