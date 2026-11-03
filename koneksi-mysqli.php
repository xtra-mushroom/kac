<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'master';

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn){
    echo 'Koneksi ke database berhasil!';
} else {
    http_response_code(500);
    exit('Terjadi kesalahan koneksi database.');
};
