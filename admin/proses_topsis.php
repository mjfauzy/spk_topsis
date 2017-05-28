<?php

require_once "../koneksi.php";

$jumlah_data = count($_GET['kode_nilai_guru']);
$kode_nilai_guru = $_GET['kode_nilai_guru'];
$nip = $_GET['nip'];
$kode_kriteria = $_GET['kode_kriteria'];
$angka_penilaian = $_GET['angka_penilaian'];

$simpan = false;
$update = false;

for($i=0;$i<$jumlah_data;$i++) {
	$cari = mysqli_query($connect, "SELECT * FROM nilai_topsis WHERE kode_nilai_guru='$kode_nilai_guru[$i]'");

	// konversi nilai bobot dengan bobot sebenarnya
	$konversi_bobot = $angka_penilaian[$i];
	if($konversi_bobot > 0 && $konversi_bobot <= 20) {
		$konversi_bobot = 1;
	} elseif ($konversi_bobot > 20 && $konversi_bobot <= 40) {
		$konversi_bobot = 2;
	} elseif ($konversi_bobot > 40 && $konversi_bobot <= 60) {
		$konversi_bobot = 3;
	} elseif ($konversi_bobot > 60 && $konversi_bobot <= 80) {
		$konversi_bobot = 4;
	} elseif ($konversi_bobot > 80 && $konversi_bobot <= 100) {
		$konversi_bobot = 5;
	} else {
		$angka_penilaian[$i] = 0;
		$konversi_bobot = 0;
	}


	if($cari) {
		// simpan atau update data
		if($cari->num_rows > 0) {
			$sql = mysqli_query($connect, "UPDATE nilai_topsis set nip='$nip[$i]',kode_kriteria='$kode_kriteria[$i]',angka_penilaian='$angka_penilaian[$i]',nilai_bobot='$konversi_bobot' where kode_nilai_guru='$kode_nilai_guru[$i]';");
			$update = true;;
		} else {
			$update = false;
		}
	} else {
		$sql = mysqli_query($connect, "INSERT INTO nilai_topsis (kode_nilai_guru,nip,kode_kriteria,angka_penilaian,nilai_bobot) VALUES ('$kode_nilai_guru[$i]','$nip[$i]','$kode_kriteria[$i]','$angka_penilaian[$i]','$konversi_bobot');");
		$simpan = true;
	}
}

if($simpan) {
	echo "<script>alert('Berhasil Simpan Data Penilaian')</script>";
	echo "<meta http-equiv='refresh' content='0; url=penilaian_topsis.php'>";
} elseif($update) {
	echo "<script>alert('Berhasil Update Data Penilaian')</script>";
	echo "<meta http-equiv='refresh' content='0; url=penilaian_topsis.php'>";
} else {
	echo "<script>alert('Gagal Simpan Data Penilaian')</script>";
	echo "<meta http-equiv='refresh' content='0; url=penilaian_topsis.php'>";
}

$connect->close();

?>