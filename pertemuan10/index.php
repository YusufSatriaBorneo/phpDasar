<?php
// Menyambungkan ke function.php
require 'functions.php';
$mobil = query("SELECT * FROM mobil");


// $row = mysqli_fetch_assoc($result);
// var_dump($mobil);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/gitcopilot.ico" />
    <title>Toko Mobil</title>
</head>

<body>
    <h1>Daftar Mobil</h1>

    <a href="tambah.php">Tambah Data Mobil</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Kode Produksi</th>
            <th>Nama Mobil</th>
            <th>Harga</th>
            <th>Perusahaan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($mobil as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td>
                    <a href="">Update</a> ||
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah Anda Yakin ?')">Delete</a>
                </td>
                <td><img src="img/<?= $row["gambar"]; ?>" width=" 50"></td>
                <td><?= $row["kode_produksi"]; ?></td>
                <td><?= $row["nama_mobil"]; ?></td>
                <td><?= $row["harga"]; ?></td>
                <td><?= $row["perusahaan"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>


    </table>

</body>

</html>