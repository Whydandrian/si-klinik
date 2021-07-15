<?php
require_once '../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

include '../../config/connection.php';

$nama_dokumen = md5(rand());
ob_start();

include '../../layouts/auth/header.php';
?>

	<div>
		<h2>Laporan Data Obat</h2>

		<table border="1">
	    	<thead>
	    		<tr>
	    			<td>No</td>
	    			<td>Nama Obat</td>
	    			<td>Jenis Obat</td>
	    		</tr>
	    	</thead>
	    	<tbody>
				<?php
			        $no = 1;
			        $query = "SELECT * FROM obat ORDER BY nama_obat ASC";
			        $dewan1 = $koneksi->prepare($query);
			        $dewan1->execute();
			        $res1 = $dewan1->get_result();

			        if ($res1->num_rows > 0) {
				        while ($row = $res1->fetch_assoc()) {
				            $nama_obat = $row['nama_obat'];
				            $jenis_obat = $row['jenis_obat'];
							echo "<tr>";
								echo "<td>".$no++."</td>";
								echo "<td>".$nama_obat."</td>";
								echo "<td>".$jenis_obat."</td>";
							echo "</tr>";
			    	} } else { 
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
$mpdf->Output($nama_dokumen.".pdf" ,'D');
clearstatcache();
$koneksi->close();
header("location:../admin/data_pegawai.php");
?>