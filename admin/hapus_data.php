<?php

include '../koneksi.php';

$data = $_GET['data'];

if($data == "guru") {
	$id = $_GET['id'];

	if($hapus = mysqli_query($connect,"DELETE FROM guru where nip='$id'")) {
		echo "<script>alert('Berhasil Hapus Data Guru');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_guru.php'>";
	} else {
		echo "<script>alert('Gagal Hapus Data Guru');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_guru.php'>";
	}
	$connect->close();
} elseif($data == "kriteria") {
	$kd_kriteria = $_GET['id'];

	if($hapus = mysqli_query($connect,"DELETE FROM kriteria WHERE kode_kriteria='$kd_kriteria'")) {
		echo "<script>alert('Berhasil Hapus Data Kriteria');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Hapus Data Kriteria');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
	$connect->close();
} elseif($data == "bobot") {
	$kd_bobot = $_GET['id'];

	if($hapus = mysqli_query($connect,"DELETE FROM bobot WHERE kode_bobot='$kd_bobot'")) {
		echo "<script>alert('Berhasil Hapus Data Bobot');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	} else {
		echo "<script>alert('Gagal Hapus Data Bobot');</script>";
		echo "<meta http-equiv='refresh' content='0; url=data_kriteria_bobot.php'>";
	}
}