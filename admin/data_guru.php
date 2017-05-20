<?php

session_start();
require_once '../koneksi.php';
$result = mysqli_query($connect,"SELECT * FROM guru ORDER BY nama");


?>

<!DOCTYPE html>
<html>
<head>
	<title>SPK TOPSIS</title>
	<style type="text/css">
		th,td {
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

<h3>Data Guru</h3>
<form method="POST" action="simpan_data.php?data=guru">
	<table>
		<tr>
			<td>NIP</td>
			<td>:</td>
			<td><input type="text" name="nip" required="true" /></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><input type="text" name="nama" required="true" /></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><input type="text" name="alamat" required="true" /></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td>
				<input type="radio" name="jenis_kelamin" value="Pria" />Pria 
				<input type="radio" name="jenis_kelamin" value="Wanita" />Wanita
			</td>
		</tr>
		<tr>
			<td>Nomor HP</td>
			<td>:</td>
			<td><input type="text" name="no_hp" required="true" /></td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: right">
				<input type="submit" value="Tambah" />
			</td>
		</tr>
	</table>
</form>
<br />
<hr />
<br />
<h3>Daftar Guru</h3>
<table border="1">
	<tr>
		<th style="background-color: #000; color: #fff;">No.</th>
		<th style="background-color: #000; color: #fff;">NIP</th>
		<th style="background-color: #000; color: #fff;">Nama</th>
		<th style="background-color: #000; color: #fff;">Alamat</th>
		<th style="background-color: #000; color: #fff;">Jenis Kelamin</th>
		<th style="background-color: #000; color: #fff;">No. HP</th>
		<th style="background-color: #000; color: #fff;">Aksi</th>
	</tr>
	<?php
	if ($result) {
		if ($result->num_rows > 0) {
			$no=0;
			while ($row = $result->fetch_object()) {
				$no++;
				?>
				<tr>
					<td><?php echo $no."."; ?></td>
					<td><?php echo $row->nip; ?></td>
					<td><?php echo $row->nama; ?></td>
					<td><?php echo $row->alamat; ?></td>
					<td><?php echo $row->jenis_kelamin; ?></td>
					<td><?php echo $row->no_hp; ?></td> 
					<td>
						<a href="ubah_data.php?id=<?php echo $row->nip; ?>">Ubah</a> | 
						<a href="hapus_data.php?data=guru&id=<?php echo $row->nip; ?>">Hapus</a>
					</td>
				</tr>
	<?php
			}
		} else {
			?>
			<tr>
				<td colspan="7" style="text-align: center;">Data Tidak Tersedia</td>
			</tr>
	<?php
		}
	}
	$connect->close(); 
	$result->close(); ?>
</table>
</center>
</body>
</html>