<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


// Menyambungkan ke function.php
require 'functions.php';
$mobil = query("SELECT * FROM mobil");


// $row = mysqli_fetch_assoc($result);
// var_dump($mobil);

//tombol cari ditekan
if (isset($_POST["cari"])) {
    $mobil = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/gitcopilot.ico" />

    <title>Toko Mobil</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 118px;
            left: 290px;
            z-index: -1;
            display: none;
        }
    </style>
    <script src="js/jquery-3.6.0.min.js"></script>
    <Script src="js/script.js"></Script>
</head>

<body>

    <a href="logout.php">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>


    <h1>Daftar Mobil</h1>

    <a href="tambah.php">Tambah Data Mobil</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan Keyword Pencarian..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>


        <img src="img/loader.gif" class="loader">
    </form>
    <br><br>
    <div id="container">
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
                        <a href="ubah.php?id=<?= $row["id"]; ?>">Update</a> ||
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
    </div>


</body>

</html>