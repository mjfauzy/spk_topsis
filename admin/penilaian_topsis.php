<?php
session_start();

include "../koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>SPK TOPSIS</title>
	<style type="text/css">
		th, td {
			padding-left: 10px;
			padding-right: 10px;
		}
		.nav a {
			padding: 10px;
			text-decoration: none;
			color: blue;
		}
		.nav a:hover {
			padding: 10px;
			color: white;
			background-color: black;
		}
	</style>
</head>
<body>
<center>
<h2>Pemilihan Guru Terbaik Metode Topsis</h2>
<div class="nav">
	<a href="data_guru.php">Data Guru</a> | 
	<a href="data_kriteria_bobot.php">Data Kriteria &amp; Bobot</a> | 
	<a href="penilaian_topsis.php">Penilaian TOPSIS</a> | 
	<a href="hasil_penilaian.php">Hasil Penilaian</a> | 
	<a href="data_user.php">Data User</a> | 
	<a href="logout.php">Logout</a>
</div>

<br />
<br />

<h3>Penilaian Guru Terbaik dengan Metode TOPSIS</h3>

<br />
<br />
<hr />
<br />

<b>Table Keterangan Penilaian</b>
<table border="1">
	<tr>
		<th style="background-color: #000; color: #fff;">Range Penilaian</th>
		<th style="background-color: #000; color: #fff;">Bobot</th>
		<th style="background-color: #000; color: #fff;">Keterangan</th>
	</tr>
	<?php
		$result_bobot = mysqli_query($connect,"SELECT * FROM bobot ORDER BY jumlah");
		if ($result_bobot) {
			if ($result_bobot->num_rows > 0) {
				$awal=1;
				$akhir=20;
				while ($row = $result_bobot->fetch_object()) {
					echo "<tr>";
						echo "<td> $awal s.d $akhir </td>";
						echo "<td> $row->jumlah </td>";
						echo "<td> $row->keterangan </td>";
					echo "</tr>";
					$awal = $akhir+1;
					$akhir+=20;
				}
			} else {
				echo "<tr>";
					echo "<td colspan='5' style='text-align: center;'>Data Tidak Tersedia</td>";
				echo "</tr>";
			}
		} 
	?>
</table>

<br />
<br />
<hr />
<br />

<b>Tabel Penilaian Guru</b>
<form method="GET" action="proses_topsis.php">
	<table border="1">
		<tr>
			<th style="background-color: #000; color: #fff;">No.</th>
			<th style="background-color: #000; color: #fff;">Peserta</th>
			<?php
				$result_kriteria = mysqli_query($connect,"SELECT nama_kriteria FROM kriteria ORDER BY kode_kriteria");
				if($result_kriteria) {
					if ($result_kriteria->num_rows > 0) {
						while ($row = $result_kriteria->fetch_object()) {
							echo "<th style='background-color: #000; color: #fff;'>".$row->nama_kriteria."</th>";
						}
					}
				}
			?>
		</tr>
		<?php
			$result_guru = mysqli_query($connect,"SELECT nip,nama FROM guru ORDER BY nip");
			if ($result_guru) {
				if ($result_guru->num_rows > 0) {
					$no=0;
					while ($row = $result_guru->fetch_object()) {
						$no++;
						?>
						<tr>
							<td><?php echo $no."."; ?></td>
							<td><?php echo $row->nama; ?></td>
							<?php
								$result_kriteria = mysqli_query($connect,"SELECT kode_kriteria FROM kriteria ORDER BY kode_kriteria");
								if($result_kriteria) {
									if ($result_kriteria->num_rows > 0) {
										$no_kode=0;
										while ($row_kriteria = $result_kriteria->fetch_object()) {
											echo "<input type='hidden' name='nip[]' value='".$row->nip."' />";
											echo "<input type='hidden' name='kode_nilai_guru[]' value='".$row->nip.$row_kriteria->kode_kriteria."' />";
											echo "<input type='hidden' name='kode_kriteria[]' value='".$row_kriteria->kode_kriteria."' />";
											echo "<td style='text-align:center;'><input type='text' name='nilai_bobot[]' placeholder='1 s/d 100' size='10' maxlength='3' required='true' /></td>";
										}
									}
								}
							?>
						</tr>
			<?php
					}
				} else {
					?>
					<tr>
						<td colspan="5" style="text-align: center;">Data Tidak Tersedia</td>
					</tr>
			<?php
				}
			} ?>
	</table>
	<table>
		<td><input type="submit" value="Proses" /></td>
	</table>
</form>

</center>
</body>
</html>

<?php

$connect->close();
$result_kriteria->close();
$result_guru->close();

?>