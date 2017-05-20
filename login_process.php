<?php
include "koneksi.php";

$username = $_POST['username'];
$pass = $_POST['password'];

$data = mysqli_query($connect, "SELECT * FROM user WHERE username='$username' AND password='$pass'");

$row = mysqli_fetch_array($data);

if ($row['username'] == $username AND $row['password'] == $pass)  {
	session_start();
	$_SESSION['username'] = $row['username'];
	$_SESSION['password'] = $row['password'];
	$_SESSION['nama'] = $row['nama'];

	echo "<script>alert('Berhasil Login');</script>";
	echo "<meta http-equiv='refresh' content='0; url=admin/index.php'>";
} else {
	echo "<script>alert('Gagal Login: Username/Password Salah');</script>";
	echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}

?>