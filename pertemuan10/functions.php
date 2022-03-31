<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


// ambil data dari tabel mobil
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//Function tambah data
function tambah($data)
{
    global $conn;

    $nama_mobil = htmlspecialchars($data["nama_mobil"]);
    $harga = htmlspecialchars($data["harga"]);
    $kode_produksi = htmlspecialchars($data["kode_produksi"]);
    $perusahaan = htmlspecialchars($data["perusahaan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // //upload gambar
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }

    $query = "INSERT INTO mobil 
                VALUES 
                ('','$nama_mobil','$harga','$kode_produksi','$perusahaan',
                '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mobil WHERE id = $id");

    return mysqli_affected_rows($conn);
}
