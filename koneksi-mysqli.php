<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'master';

try {
    $conn = mysqli_connect(
        $host,
        $username,
        $password,
        $database
    );

    mysqli_set_charset($conn, 'utf8mb4');

    echo 'Koneksi ke database berhasil!';

} catch (mysqli_sql_exception $e) {
    error_log('Database connection failed: ' . $e->getMessage());

    http_response_code(500);
    exit('Terjadi kesalahan koneksi database.');
}
