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
	    			<td>Nama Pegawai</td>
	    			<td>Jenis Kelamin</td>
	    			<td>Agama</td>
	    			<td>Jabatan</td>
	    			<td>Tempat Lahir</td>
	    			<td>Tgl. Lahir</td>
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
								echo "<td>".$no++."</td>";
								echo "<td>".$nama_pegawai."</td>";
								echo "<td>".$jenis_kelamin."</td>";
								echo "<td>".$agama."</td>";
								echo "<td>".$jabatan."</td>";
								echo "<td>".$tempat_lahir."</td>";
								echo "<td>".$tanggal_lahir."</td>";
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