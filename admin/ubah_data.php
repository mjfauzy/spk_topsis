<?php

include '../koneksi.php';

$id = $_GET['id'];

$result = mysqli_query($connect,"SELECT * FROM guru where nip='$id'");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data</title>
</head>
<body>
<center>
	<h2>Pemilihan Guru Terbaik Metode TOPSIS</h2>
	<button onclick="history.go(-1);">Kembali</button>

	<br />
	<br />

	<h3>Ubah Data Guru</h3>
	<form method="POST" action="simpan_data.php?data=updateguru">
	<?php 
	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
				?>

				<table>
					<tr>
						<td>NIP</td>
						<td>:</td>
						<td><input type="text" name="nip" value="<?php echo $row->nip; ?>" readonly="true"></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><input type="text" name="nama" value="<?php echo $row->nama; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><input type="text" name="alamat" value="<?php echo $row->alamat; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Jenis kelamin</td>
						<td>:</td>
						<td>
							<input type="radio" name="jenis_kelamin" <?php if ($row->jenis_kelamin == 'Pria') echo "checked"; ?> value="Pria" />Pria 
							<input type="radio" name="jenis_kelamin" <?php if ($row->jenis_kelamin == 'Wanita') echo "checked"; ?> value="Wanita" />Wanita
						</td>
					</tr>
					<tr>
						<td>Nomor HP</td>
						<td>:</td>
						<td><input type="text" name="no_hp" value="<?php echo $row->no_hp; ?>" required="true" /></td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: right;">
							<input type="submit" name="submit" value="Update" />
						</td>
					</tr>
				</table>
	<?php
			}
		}
	} $result->close(); ?>
		
	</form>
</center>
</body>
</html>