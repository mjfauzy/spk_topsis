<?php
include '../koneksi.php';

$data = $_GET['data'];

if($data == 'guru') {
	$nip = $_POST['nip'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_hp = $_POST['no_hp'];

	if($simpan = mysqli_query($connect,"INSERT INTO guru VALUES ('$nip','$nama','$alamat','$jenis_kelamin','$no_hp')")) {
		echo "<script>alert('Berhasil Simpan Data Guru');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_guru.php'>";
	} else {
		echo "<script>alert('Gagal Simpan Data Guru');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_guru.php'>";
	}
	$connect->close();

} elseif ($data == 'updateguru') {
	$nip = $_POST['nip'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_hp = $_POST['no_hp'];

	if($simpan = mysqli_query($connect,"UPDATE guru SET nama='$nama',alamat='$alamat',jenis_kelamin='$jenis_kelamin',no_hp='$no_hp' WHERE nip='$nip'")) {
		echo "<script>alert('Berhasil Update Data Guru');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_guru.php'>";
	} else {
		echo "<script>alert('Gagal Update Data Guru');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_guru.php'>";
	}
	$connect->close();
} elseif ($data == 'kriteria') {
	$kd_kriteria = $_POST['kd_kriteria'];
	$nama_kriteria = $_POST['nama_kriteria'];
	$kategori = $_POST['kategori'];

	if($simpan = mysqli_query($connect,"INSERT INTO kriteria (kode_kriteria,nama_kriteria,kategori) VALUES ('$kd_kriteria','$nama_kriteria','$kategori')")) {
		echo "<script>alert('Berhasil Simpan Data Kriteria')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Simpan Data Kriteria')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
	$connect->close();
} elseif ($data == 'updatekriteria') {
	$kd_kriteria = $_POST['kd_kriteria'];
	$nama = $_POST['nama'];
	$kategori = $_POST['kategori'];

	if($simpan = mysqli_query($connect,"UPDATE kriteria SET nama_kriteria='$nama',kategori='$kategori' WHERE kode_kriteria='$kd_kriteria'")) {
		echo "<script>alert('Berhasil Update Data Kriteria')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Update Data Kriteria')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
	$connect->close();
} elseif ($data == 'bobot') {
	$kd_bobot = $_POST['kd_bobot'];
	$jumlah = $_POST['jumlah'];
	$keterangan = $_POST['keterangan_bobot'];

	if($simpan = mysqli_query($connect,"INSERT INTO bobot (kode_bobot,jumlah,keterangan) VALUES ('$kd_bobot','$jumlah','$keterangan')")) {
		echo "<script>alert('Berhasil Simpan Data Bobot')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Simpan Data Bobot')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
	$connect->close();
} elseif ($data == 'updatebobot') {
	$kd_bobot = $_POST['kd_bobot'];
	$jumlah = $_POST['jumlah'];
	$keterangan = $_POST['keterangan'];

	if($simpan = mysqli_query($connect,"UPDATE bobot SET jumlah='$jumlah',keterangan='$keterangan' WHERE kode_bobot='$kd_bobot'")) {
		echo "<script>alert('Berhasil Update Data Bobot')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Update Data Bobot')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
	$connect->close();
} elseif ($data == 'kriteria_terbobot') {
	$jumlah_data = count($_GET['kode_kriteria']);
	$kode_kriteria = $_GET['kode_kriteria'];
	$jumlah_bobot = $_GET['jumlah_bobot'];

	$simpan = false;

	for($i=0;$i<$jumlah_data;$i++) {
		if($sql = mysqli_query($connect, "UPDATE kriteria SET bobot='$jumlah_bobot[$i]' WHERE kode_kriteria='$kode_kriteria[$i]'")) {
			$simpan = true;
		} else {
			$simpan = false;
		}
	}

	if($simpan) {
		echo "<script>alert('Berhasil Simpan Data Kriteria Terbobot')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Simpan Data Kriteria Terbobot')</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
	$connect->close();
}

?>