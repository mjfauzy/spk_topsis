<?php

session_start();
include '../koneksi.php';

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
		.maincontent {
			overflow: hidden;
		}
		.content {
			width: 620px;
			float: left;
			padding: 10px;
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

<h3>Data Kriteria &amp; Bobot</h3>
<div class="maincontent">
	<div class="content">
		<b>Data Kriteria</b>
		<form method="POST" action="simpan_data.php?data=kriteria">
			<table>
				<tr>
					<td>Kode Kriteria</td>
					<td>:</td>
					<td><input type="text" name="kd_kriteria" required="true" /></td>
				</tr>
				<tr>
					<td>Nama Kriteria</td>
					<td>:</td>
					<td><input type="text" name="nama_kriteria" required="true" /></td>
				</tr>
				<tr>
					<td>Kategori</td>
					<td>:</td>
					<td>
						<select name="kategori">
							<option value="" selected="true">-- Pilih Kategori --</option>
							<option value="Benefit/Keuntungan">Benefit/Keuntungan</option>
							<option value="Cost/Biaya">Cost/Biaya</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: right;">
						<input type="submit" name="submit" value="Tambah">
					</td>
				</tr>
			</table>
		</form>
		<hr />

		<b>Daftar Kriteria</b>
		<table border="1">
		<tr>
			<th style="background-color: #000; color: #fff;">No.</th>
			<th style="background-color: #000; color: #fff;">Kode</th>
			<th style="background-color: #000; color: #fff;">Nama</th>
			<th style="background-color: #000; color: #fff;">Kategori</th>
			<th style="background-color: #000; color: #fff;">Aksi</th>
		</tr>
		<?php
		$result_kriteria = mysqli_query($connect,"SELECT * FROM kriteria ORDER BY kode_kriteria");
		if ($result_kriteria) {
			if ($result_kriteria->num_rows > 0) {
				$no=0;
				while ($row = $result_kriteria->fetch_object()) {
					$no++;
					?>
					<tr>
						<td><?php echo $no."."; ?></td>
						<td><?php echo $row->kode_kriteria; ?></td>
						<td><?php echo $row->nama_kriteria; ?></td>
						<td><?php echo $row->kategori; ?></td>
						<td>
							<a href="ubah_kriteria.php?id=<?php echo $row->kode_kriteria; ?>">Ubah</a> | 
							<a href="hapus_data.php?data=kriteria&id=<?php echo $row->kode_kriteria; ?>">Hapus</a>
						</td>
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
	</div>
	<div class="content">
		<b>Data Bobot</b>
		<form method="POST" action="simpan_data.php?data=bobot">
			<table>
				<tr>
					<td>Kode Bobot</td>
					<td>:</td>
					<td><input type="text" name="kd_bobot" required="true" /></td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>:</td>
					<td><input type="text" name="jumlah" required="true" /></td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td>:</td>
					<td><input type="text" name="keterangan_bobot" required="true" /></td>
				</tr>
				<tr>
					<td colspan="3" style="text-align: right;">
						<input type="submit" name="submit" value="Tambah">
					</td>
				</tr>
			</table>
		</form>
		<hr />

		<b>Daftar Bobot</b>
		<table border="1">
		<tr>
			<th style="background-color: #000; color: #fff;">No.</th>
			<th style="background-color: #000; color: #fff;">Kode</th>
			<th style="background-color: #000; color: #fff;">Jumlah</th>
			<th style="background-color: #000; color: #fff;">Keterangan</th>
			<th style="background-color: #000; color: #fff;">Aksi</th>
		</tr>
		<?php
		$result_bobot = mysqli_query($connect,"SELECT * FROM bobot ORDER BY jumlah DESC");
		if ($result_bobot) {
			if ($result_bobot->num_rows > 0) {
				$no=0;
				while ($row = $result_bobot->fetch_object()) {
					$no++;
					?>
					<tr>
						<td><?php echo $no."."; ?></td>
						<td><?php echo $row->kode_bobot; ?></td>
						<td><?php echo $row->jumlah; ?></td>
						<td><?php echo $row->keterangan; ?></td>
						<td>
							<a href="ubah_bobot.php?id=<?php echo $row->kode_bobot; ?>">Ubah</a> | 
							<a href="hapus_data.php?data=bobot&id=<?php echo $row->kode_bobot; ?>">Hapus</a>
						</td>
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
	</div>
</div>
<div class="maincontent">
	<br />
	<hr />
	<br />
	<b>Pemberian Bobot</b>

<?php

$result_kriteria = mysqli_query($connect,"SELECT kode_kriteria,nama_kriteria,kategori FROM kriteria ORDER BY kode_kriteria");
$result_bobot = mysqli_query($connect,"SELECT kode_bobot,jumlah FROM bobot ORDER BY jumlah");

echo "<form method='GET' action='simpan_data.php'>";
echo "<input type='hidden' name='data' value='kriteria_terbobot' />";
echo "<table border='1'>";
	echo "<tr>";
		echo "<th style='background-color: #000; color: #fff;'>No.</th>";
		echo "<th style='background-color: #000; color: #fff;'>Kriteria</th>";
		echo "<th style='background-color: #000; color: #fff;'>Kategori</th>";
		echo "<th style='background-color: #000; color: #fff;'>Bobot</th>";
	echo "</tr>";
	if($result_kriteria) {
		if($result_kriteria->num_rows > 0) {
			$no = 0;
			while($row_kriteria = $result_kriteria->fetch_object()) {
				echo "<tr>";
					echo "<td><input type='hidden' name='kode_kriteria[]' value='".$row_kriteria->kode_kriteria."' />".++$no."</td>";
					echo "<td>";
						echo $row_kriteria->nama_kriteria;
					echo "</td>";
					echo "<td>";
						echo $row_kriteria->kategori;
					echo "</td>";
					echo "<td style='text-align: center;'>";
						$result_bobot = mysqli_query($connect,"SELECT kode_bobot,jumlah FROM bobot ORDER BY jumlah");
							if($result_bobot) {
								if($result_bobot->num_rows > 0) {
									echo "<select name='jumlah_bobot[]'>";
										while($row_bobot = $result_bobot->fetch_object()) {
											echo "<option value='".$row_bobot->jumlah."'>";
												echo $row_bobot->jumlah;
											echo "</option>";
										}
									echo "</select>";		
								}
							}
					echo "</td>";
				echo "</tr>";
			}
		}
	}

echo "</table><br />";
echo "<table>";
	echo "<tr>";
		echo "<td>";
			echo "<input type='submit' value='Simpan' />";
		echo "</td>";
	echo "</tr>";
echo "</table>";
echo "</form>";
?>
</div>

</center>
</body>
</html>

<?php

$connect->close();
$result_bobot->close();
$result_kriteria->close();

?>