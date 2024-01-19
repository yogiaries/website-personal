<?php
session_start();
require "../koneksi.php";

// Jika pengguna sudah login, arahkan ke halaman utama
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// Jika tombol "daftar" ditekan
if (isset($_POST["daftar"])) {
    $username = mysqli_real_escape_string($con, htmlspecialchars($_POST["username"]));
    $password = mysqli_real_escape_string($con, htmlspecialchars($_POST["password"]));

    // Cek apakah username sudah digunakan
    $ambil = $con->query("SELECT * FROM users WHERE username='$username'");
    $yangcocok = $ambil->num_rows;

    if ($yangcocok == 1) {
        echo "<script>alert('Pendaftaran gagal, username sudah digunakan');</script>";
        echo "<script>location='daftar.php';</script>";
    } else {
        // Query insert ke tabel users
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $con->query("INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')");

        echo "<script>alert('Pendaftaran sukses, silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Soal Acak - Daftar</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/sweet_alert/dist/sweetalert.css" rel="stylesheet"/>
</head>
<body>

<div class="container">
    <div class="navigasi">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <img alt="Brand" src="../assets/img/quiz.png" width="20">
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="isi">
        <div class="jumbotron">
            <div id="kontenku">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="../assets/img/quiz.png" alt="../assets/img/quiz.png" class="img img-responsive imgku">
                        <br>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Silakan Daftar Terlebih dahulu..</div>
                            <div class="panel-body">
                                <form method="POST" action="daftar.php">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="Username"required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password "required>
                                    </div>
                                    <a href="login.php" class="btn btn-warning">Login</a>
                                    <button type="submit" name="daftar" class="btn btn-warning">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy;<span id="tahun"></span> All rights reserved.</p>
        <script>
            document.getElementById("tahun").innerHTML = new Date().getFullYear();
        </script>
    </div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/sweet_alert/dist/sweetalert.min.js"></script>
</body>
</html>
