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
    // $gambar = htmlspecialchars($data["gambar"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mobil 
                VALUES 
                ('','$nama_mobil','$harga','$kode_produksi','$perusahaan',
                '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mobil WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $nama_mobil = htmlspecialchars($data["nama_mobil"]);
    $harga = htmlspecialchars($data["harga"]);
    $kode_produksi = htmlspecialchars($data["kode_produksi"]);
    $perusahaan = htmlspecialchars($data["perusahaan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE mobil SET
                nama_mobil = '$nama_mobil',
                harga = '$harga',
                kode_produksi = '$kode_produksi',
                perusahaan = '$perusahaan',
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mobil WHERE 
                nama_mobil LIKE '%$keyword%' OR
                harga LIKE '%$keyword%' OR
                kode_produksi LIKE '%$keyword%' OR
                perusahaan LIKE '%$keyword%'
                ";
    return query($query);
}


function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = mysqli_real_escape_string($conn, $data["email"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");


    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Mohon menggunakan username yang lain, karena sudah pernah terdaftar!');
            </script>";
        return false;
    }

    // cek email sudah ada atau belum
    $emailnggabolehsamawoi = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (mysqli_fetch_assoc($emailnggabolehsamawoi)) {
        echo "<script>
                alert('Mohon menggunakan email yang lain, karena sudah pernah terdaftar!');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', '$email')");

    return mysqli_affected_rows($conn);
}
