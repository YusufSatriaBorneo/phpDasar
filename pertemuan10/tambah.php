<?php
require 'functions.php';
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
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
    <title>Tambah Data Mobil</title>
</head>

<body>
    <h1>Tambah Data Mobil</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nama_mobil">Nama Mobil :</label>
                <input type="text" name="nama_mobil" id="nama_mobil" required>
            </li>
            <li>
                <label for="harga">Harga :</label>
                <input type="text" name="harga" id="harga" required>
            </li>
            <li>
                <label for="kode_produksi">Kode Produksi :</label>
                <input type="text" name="kode_produksi" id="kode_produksi" required>
            </li>
            <li>
                <label for="perusahaan">Perusahaan :</label>
                <input type="text" name="perusahaan" id="perusahaan" required>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="text" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>


</body>

</html>