<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$mobil = query("SELECT * FROM mobil");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mobil</title>
    <link rel="shortcut icon" href="img/gitcopilot.ico" />
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Daftar Mobil</h1>
     <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Kode Produksi</th>
                <th>Nama Mobil</th>
                <th>Harga</th>
                <th>Perusahaan</th>
            </tr>';

$i = 1;
foreach ($mobil as $row) {
    $html .= '<tr>
                    <td>' . $i++ . '</td>
                    <td><img src="img/' . $row["gambar"] . '" width="50"></td>
                    <td>' . $row["kode_produksi"] . '</td>
                    <td>' . $row["nama_mobil"] . '</td>
                    <td>' . $row["harga"] . '</td>
                    <td>' . $row["perusahaan"] . '</td>
                </tr>';
}
$html .=    '</table>
</body>
</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mobil.pdf', \Mpdf\Output\Destination::INLINE);
