<?php

include '../koneksi.php';

$id = $_GET['id'];

$result = mysqli_query($connect,"SELECT * FROM kriteria where kode_kriteria='$id'");

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

	<h3>Ubah Data Kriteria</h3>
	<form method="POST" action="simpan_data.php?data=updatekriteria">
	<?php 
	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
				?>

				<table>
					<tr>
						<td>Kode Kriteria</td>
						<td>:</td>
						<td><input type="text" name="kd_kriteria" value="<?php echo $row->kode_kriteria; ?>" readonly="true"></td>
					</tr>
					<tr>
						<td>Nama Kriteria</td>
						<td>:</td>
						<td><input type="text" name="nama" value="<?php echo $row->nama_kriteria; ?>" required="true"></td>
					</tr>
					<tr>
						<td>Kategori</td>
						<td>:</td>
						<td>
							<select name="kategori">
								<option value="Benefit/Keuntungan" <?php if($row->kategori == 'Benefit/Keuntungan') echo "selected='true'" ?>>Benefit/Keuntungan</option>
								<option value="Cost/Biaya" <?php if($row->kategori == 'Cost/Biaya') echo "selected='true'" ?>>Cost/Biaya</option>
							</select>
						</td>
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