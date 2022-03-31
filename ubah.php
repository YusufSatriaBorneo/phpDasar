<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//ambil data di URL
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$mbl = query("SELECT * FROM mobil WHERE id = $id")[0];
// var_dump($mobil); untuk mengecek array

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/gitcopilot.ico" />
    <title>Ubah Data Mobil</title>
</head>

<body>
    <h1>Ubah Data Mobil</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mbl["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mbl["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama_mobil">Nama Mobil :</label>
                <input type="text" name="nama_mobil" id="nama_mobil" required value="<?= $mbl["nama_mobil"]; ?>">
            </li>
            <li>
                <label for="harga">Harga :</label>
                <input type="text" name="harga" id="harga" required value="<?= $mbl["harga"]; ?>">
            </li>
            <li>
                <label for="kode_produksi">Kode Produksi :</label>
                <input type="text" name="kode_produksi" id="kode_produksi" required value="<?= $mbl["kode_produksi"]; ?>">
            </li>
            <li>
                <label for="perusahaan">Perusahaan :</label>
                <input type="text" name="perusahaan" id="perusahaan" required value="<?= $mbl["perusahaan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <img src="img/<?= $mbl["gambar"]; ?>" width="50">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Edit Data</button>
            </li>
        </ul>
    </form>


</body>

</html>