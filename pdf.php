<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

$siswa = query("SELECT * FROM siswa");


$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Data Siswa</title>
</head>
<body>

    <h2>Data Siswa</h2>
    <hr>

    <table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Nim</th>
			<th>Tanggal Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Jurusan</th>
		</tr>';


	$i = 1;
	foreach( $siswa as $row ) {
		$html .= '<tr>
			<td>'. $i++ .'</td>
			<td>'. $row["nama"] .'</td>
			<td>'. $row["nim"] .'</td>
			<td>'. $row["tanggal_lahir"] .'</td>
			<td>'. $row["jenis_kelamin"] .'</td>
            <td>'. $row["jurusan"] .'</td>
		</tr>';
	}


$html .= '</table>


	
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();




?>
