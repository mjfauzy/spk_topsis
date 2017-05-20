<!DOCTYPE html>
<html>
<head>
	<title>SPK TOPSIS</title>
	<style type="text/css">
		.nav label {
			padding: 10px;
			color: blue;
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
	<label>Data Guru</label> | <label>Data Kriteria &amp; Bobot</label> | <label>Penilaian TOPSIS</label> | <label>Hasil Penilaian</label> | <label>Data User</label> | <a href="index.php">Login</a>
</div>

<br />
<br />

<h3>Menu Login</h3>
<b>Silahkan Login...</b>

<form method="POST" action="login_process.php">
<table>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" name="username" placeholder="Username Anda" required="true" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" name="password" placeholder="Password Anda" required="true" /></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align: right;">
			<input type="reset" name="cancel" value="Cancel" />
			<input type="submit" name="login" value="Login" />
		</td>
	</tr>
</table>
</form>

</center>
</body>
</html>