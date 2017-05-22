<?php
session_start();

include "../koneksi.php";


$result = mysqli_query($connect,"SELECT b.nama, c.nama_kriteria, a.nilai_bobot, c.bobot, c.kategori 
									FROM nilai_topsis a 
										JOIN guru b USING(nip) 
										JOIN kriteria c USING(kode_kriteria)");
$data = array();
$data_kriteria = array();
$bobot = array();
$kategori = array();
$nilai_kuadrat = array();

if($result) {
	if($result->num_rows > 0) {
		while($row=$result->fetch_object()) {
			if(!isset($data[$row->nama])) {
				$data[$row->nama] = array();
			}
			if(!isset($data[$row->nama][$row->nama_kriteria])) {
				$data[$row->nama][$row->nama_kriteria] = array();
			}
			if(!isset($nilai_kuadrat[$row->nama_kriteria])) {
				$nilai_kuadrat[$row->nama_kriteria] = 0;
			}

			$bobot[$row->nama_kriteria] = $row->bobot;
			$kategori[$row->nama_kriteria] = $row->kategori;
			$data[$row->nama][$row->nama_kriteria] = $row->nilai_bobot;
			$nilai_kuadrat[$row->nama_kriteria] += pow($row->nilai_bobot,2);
			$data_kriteria[] = $row->nama_kriteria;
		}
	}
} else {
	echo "Data Tidak Bisa Diakses";
}

$kriteria = array_unique($data_kriteria);
$jml_kriteria = count($kriteria);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Perhitungan TOPSIS</title>
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
<a href="#hasil_terpilih">Lihat Hasil Terpilih</a>
<br />
<br />


	<table border='1'>
		<caption>Evaluation Matrix (x<sub>ij</sub>)</caption>
		<thead>
			<tr>
				<th rowspan='3' style="background-color:black; color:white;">No</th>
				<th rowspan='3' style="background-color:black; color:white;">Alternatif</th>
				<th rowspan='3' style="background-color:black; color:white;">Nama</th>
				<th colspan='<?php echo $jml_kriteria;?>' style="background-color:black; color:white;">Kriteria</th>
	        </tr>
	        <tr>
	        	<?php
	        		foreach($kriteria as $k)
	        			echo "<th>{$k}</th>\n";
	        	?>
	        </tr>
	        <tr>
	        	<?php
	        		for($n=1;$n<=$jml_kriteria;$n++)
	        			echo "<th>C{$n}</th>";
	        	?>
	        </tr>
      	</thead>
      	<tbody>
        	<?php
	        	$i=0;
	        	foreach($data as $nama=>$krit){
	        		echo "<tr>
	        			<td>".(++$i)."</td>
	            		<th>A{$i}</th>
	            		<td>{$nama}</td>";
	          		foreach($kriteria as $k){  
	            		echo "<td align='center'>{$krit[$k]}</td>";
	          		}
	          		echo "</tr>\n";
	        	}
       		?>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Rating Kinerja Ternormalisasi (r<sub>ij</sub>)</caption>
      	<thead>
	        <tr>
	          	<th rowspan='3' style="background-color:black; color:white;">No</th>
	          	<th rowspan='3' style="background-color:black; color:white;">Alternatif</th>
	          	<th rowspan='3' style="background-color:black; color:white;">Nama</th>
	          	<th colspan='<?php echo $jml_kriteria;?>' style="background-color:black; color:white;">Kriteria</th>
	        </tr>
	        <tr>
	          	<?php
	          		foreach($kriteria as $k)
	            		echo "<th>{$k}</th>\n";
	          	?>
	        </tr>
	        <tr>
	          	<?php
	          		for($n=1;$n<=$jml_kriteria;$n++)
	            		echo "<th>C{$n}</th>";
	          	?>
	        </tr>
      	</thead>
      	<tbody>
        	<?php
        		$i=0;
        		foreach($data as $nama=>$krit){
          			echo "<tr>
            			<td>".(++$i)."</td>
            			<th>A{$i}</th>
            			<td>{$nama}</td>";
          			foreach($kriteria as $k){  
            			echo "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)."</td>";
          			}
          			echo "</tr>\n";
        		}
        	?>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Rating Bobot Ternormalisasi(y<sub>ij</sub>)</caption>
      	<thead>
	        <tr>
	          	<th rowspan='3' style="background-color:black; color:white;">No</th>
	          	<th rowspan='3' style="background-color:black; color:white;">Alternatif</th>
	          	<th rowspan='3' style="background-color:black; color:white;">Nama</th>
	          	<th colspan='<?php echo $jml_kriteria;?>' style="background-color:black; color:white;">Kriteria</th>
	        </tr>
	        <tr>
	          	<?php
	          		foreach($kriteria as $k)
	            		echo "<th>{$k}</th>\n";
	          	?>
	        </tr>
	        <tr>
	          	<?php
	          		for($n=1;$n<=$jml_kriteria;$n++)
	            		echo "<th>C{$n}</th>";
	          	?>
	        </tr>
      	</thead>
      	<tbody>
        	<?php
        		$i=0;
        		$y=array();
        		foreach($data as $nama=>$krit){
          			echo "<tr>
           	 			<td>".(++$i)."</td>
            			<th>A{$i}</th>
            			<td>{$nama}</td>";
          			foreach($kriteria as $k){  
            			$y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
            			echo "<td align='center'>".$y[$k][$i-1]."</td>";
          			}
          			echo "</tr>\n";
        		}
        	?>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Solusi Ideal positif (A<sup>+</sup>)</caption>
      	<thead>
        	<tr>
          		<th colspan='<?php echo $jml_kriteria;?>' style="background-color:black; color:white;">Kriteria</th>
        	</tr>
        	<tr>
          		<?php
          			foreach($kriteria as $k)
            			echo "<th>{$k}</th>\n";
          		?>
        	</tr>
        	<tr>
          		<?php
          			for($n=1;$n<=$jml_kriteria;$n++)
            			echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
          		?>
        	</tr>
      	</thead>
      	<tbody>
        	<tr>
          		<?php
          			$yplus=array();
          			foreach($kriteria as $k){
            			$yplus[$k]=($kategori[$k]=='Benefit/Keuntungan'?max($y[$k]):min($y[$k]));
            			echo "<th>{$yplus[$k]}</th>";
          			}
          		?>
        	</tr>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Solusi Ideal negatif (A<sup>-</sup>)</caption>
      	<thead>
        	<tr>
          		<th colspan='<?php echo $jml_kriteria;?>' style="background-color:black; color:white;">Kriteria</th>
        	</tr>
        	<tr>
          		<?php
          			foreach($kriteria as $k)
            			echo "<th>{$k}</th>\n";
          		?>
        	</tr>
        	<tr>
          		<?php
          			for($n=1;$n<=$jml_kriteria;$n++)
            			echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
          		?>
        	</tr>
      	</thead>
      	<tbody>
        	<tr>
          		<?php
          			$ymin=array();
          			foreach($kriteria as $k){
            			$ymin[$k]=$kategori[$k]=='Cost/Biaya'?max($y[$k]):min($y[$k]);
            			echo "<th>{$ymin[$k]}</th>";
          			}
          		?>
        	</tr>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Jarak positif (D<sub>i</sub><sup>+</sup>)</caption>
      	<thead>
        	<tr>
          		<th style="background-color:black; color:white;">No</th>
          		<th style="background-color:black; color:white;">Alternatif</th>
          		<th style="background-color:black; color:white;">Nama</th>          
          		<th style="background-color:black; color:white;">D<suo>+</sup></th>
        	</tr>
      	</thead>
      	<tbody>
        	<?php
        		$i=0;
        		$dplus=array();
        		foreach($data as $nama=>$krit){
         	 		echo "<tr>
            			<td>".(++$i)."</td>
            			<th>A{$i}</th>
            			<td>{$nama}</td>";
          			foreach($kriteria as $k){  
            			if(!isset($dplus[$i-1])) $dplus[$i-1]=0;
            				$dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
          			}
          			echo "<td>".round(sqrt($dplus[$i-1]),4)."</td>
           				</tr>\n";
        		}
        	?>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Jarak negatif (D<sub>i</sub><sup>-</sup>)</caption>
      	<thead>
        	<tr>
          		<th style="background-color:black; color:white;">No</th>
          		<th style="background-color:black; color:white;">Alternatif</th>
          		<th style="background-color:black; color:white;">Nama</th>          
          		<th style="background-color:black; color:white;">D<suo>+</sup></th>
        	</tr>
      	</thead>
      	<tbody>
        	<?php
        		$i=0;
        		$dmin=array();
        		foreach($data as $nama=>$krit){
          			echo "<tr>
            			<td>".(++$i)."</td>
            			<th>A{$i}</th>
            			<td>{$nama}</td>";
          			foreach($kriteria as $k){  
            			if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
            				$dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
          			}
          			echo "<td>".round(sqrt($dmin[$i-1]),4)."</td>
           				</tr>\n";
        		}
        	?>
      	</tbody>
    </table>
	<br />

    <table border='1'>
      	<caption>Nilai Preferensi(V<sub>i</sub>)</caption>
      	<thead>
        	<tr>
          		<th style="background-color:black; color:white;">No</th>
          		<th style="background-color:black; color:white;">Alternatif</th>
          		<th style="background-color:black; color:white;">Nama</th>
          		<th style="background-color:black; color:white;">V<sub>i</sub></th>
        	</tr>
      	</thead>
      	<tbody>
        	<?php
        		$i=0;
        		$V=array();
				$terpilih=0;
        		foreach($data as $nama=>$krit){
          			echo "<tr>
            			<td>".(++$i)."</td>
            			<th>A{$i}</th>
            			<td>{$nama}</td>";
          			foreach($kriteria as $k){  
            			$V[$i-1]=round($dmin[$i-1]/($dmin[$i-1]+$dplus[$i-1]),4);
          			}
          			echo "<td>{$V[$i-1]}</td></tr>\n";
					if($terpilih<$V[$i-1]) {
						$terpilih = $V[$i-1];
						$A_terpilih = "(A$i)";
						$nama_terpilih = $nama;
					}
        		}
        	?>
      	</tbody>
    </table>
	<p id="hasil_terpilih">Guru terbaik yang terpilih adalah <b><?php echo "$nama_terpilih $A_terpilih"; ?></b> 
		dengan nilai preferensi <b><?php echo $terpilih; ?></b>.</p>
</center>
</body>
</html>

<?php

$connect->close();
$result->close();

?>