<?php
usleep(500000);

require '../functions.php';
$keyword = $_GET['keyword'];

$query = "SELECT * FROM mobil WHERE 
                nama_mobil LIKE '%$keyword%' OR
                harga LIKE '%$keyword%' OR
                kode_produksi LIKE '%$keyword%' OR
                perusahaan LIKE '%$keyword%'
                ";
$mobil = query($query);
?>

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