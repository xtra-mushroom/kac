<?php
session_start();

Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat Datang!</h1>
    
    <p>Halo, Anda berhasil masuk ke halaman dashboard admin.</p>

    <ul>
      <li><a href="daftar-pengguna.php" target="_blank">Lihat Daftar Pengguna</li>
    </ul>

    <a href="logout.php">Logout</a>

</body>
</html>

