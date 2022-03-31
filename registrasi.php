<?php
require 'functions.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "
            <script>
                alert('user baru berhasil ditambahkan!');
            </script>
        ";
    } else {
        echo mysqli_error($conn);
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
    <title>Regestrasi</title>

    <!-- Bootstrap CSS CDN -->
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Konfirmasi Password :</label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email">
            </li>
            <br>
            <li>
                <button type="submit" name="register">Registrasi</button>
            </li>
        </ul>

    </form>

</body>

</html>