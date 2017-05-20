<?php

include '../koneksi.php';

$id = $_GET['id'];

$result = mysqli_query($connect,"SELECT * FROM bobot where kode_bobot='$id'");

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

	<h3>Ubah Data Bobot</h3>
	<form method="POST" action="simpan_data.php?data=updatebobot">
	<?php 
	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
				?>

				<table>
					<tr>
						<td>Kode Bobot</td>
						<td>:</td>
						<td><input type="text" name="kd_bobot" value="<?php echo $row->kode_bobot; ?>" readonly="true"></td>
					</tr>
					<tr>
						<td>Jumlah</td>
						<td>:</td>
						<td><input type="text" name="jumlah" value="<?php echo $row->jumlah; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Keterangan</td>
						<td>:</td>
						<td><input type="text" name="keterangan" value="<?php echo $row->keterangan; ?>" required="true"></td>
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