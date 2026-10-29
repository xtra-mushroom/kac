<?php

require_once __DIR__ . '/koneksi-pdo.php';

try {
    $stmt = $pdo->query('SELECT DATABASE() AS nama_database');
    $result = $stmt->fetch();

    echo 'Koneksi berhasil!<br>';
    echo 'Database aktif: ' .
        htmlspecialchars($result['nama_database'], ENT_QUOTES, 'UTF-8');

} catch (PDOException $e) {
    error_log('Database query failed: ' . $e->getMessage());

    http_response_code(500);
    echo 'Gagal menjalankan query database.';
}
