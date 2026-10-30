<?php

$pesan = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Mengambil data dari form
    $nama          = trim($_POST["nama"] ?? "");
    $tempat_lahir  = trim($_POST["tempat_lahir"] ?? "");
    $tgl_lahir     = trim($_POST["tgl_lahir"] ?? "");
    $jenis_kelamin = trim($_POST["jenis_kelamin"] ?? "");
    $email         = trim($_POST["email"] ?? "");
    $username_user = trim($_POST["username"] ?? "");
    $password_user = $_POST["password"] ?? "";

    if (
        $nama === "" ||
        $tempat_lahir === "" ||
        $tgl_lahir === "" ||
        $jenis_kelamin === "" ||
        $email === "" ||
        $username_user === "" ||
        $password_user === ""
    ) {
        $errors[] = "Semua field wajib diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Validasi tanggal lahir
    $tanggal = DateTime::createFromFormat("!Y-m-d", $tgl_lahir);

    if (
        !$tanggal ||
        $tanggal->format("Y-m-d") !== $tgl_lahir
    ) {
        $errors[] = "Format tanggal lahir tidak valid.";
    }

    if (strlen($password_user) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }


    // ====================================
    // SIMPAN DATA KE DATABASE
    // ====================================

    if (empty($errors)) {

        try {

            // Mengamankan password dengan hashing
            $password_hash = password_hash(
                $password_user,
                PASSWORD_DEFAULT
            );

            // Query INSERT
            $sql = "INSERT INTO pengguna
                    (nama, tempat_lahir, tgl_lahir,
                     jenis_kelamin, email, username,
                     password, timestamp_regis)
                    VALUES (?, ?, ?, ?, ?, ?, ?,
                            CURRENT_TIMESTAMP)";

            $stmt = mysqli_prepare($conn, $sql);

            // Mengikat parameter ke query
            mysqli_stmt_bind_param(
                $stmt,
                "sssssss",
                $nama,
                $tempat_lahir,
                $tgl_lahir,
                $jenis_kelamin,
                $email,
                $username_user,
                $password_hash
            );

            // Menjalankan query
            mysqli_stmt_execute($stmt);

            $pesan = "Registrasi berhasil!";

            mysqli_stmt_close($stmt);

        } catch (mysqli_sql_exception $e) {

            error_log($e->getMessage());

            $pesan = "Registrasi gagal. Silakan periksa kembali data Anda.";

        }
    }
}
?>
