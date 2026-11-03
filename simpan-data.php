<?php
include_once("koneksi-mysqli.php");

if (isset($_POST['simpan'])) {
    $nama          = $_POST['nama'];
    $tempat_lahir  = $_POST['tempat_lahir'];
    $tgl_lahir     = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email         = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Password di-hash
    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO pengguna
            (nama, tempat_lahir, tgl_lahir,
             jenis_kelamin, email, username,
             password, timestamp_regis)
            VALUES (
                '$nama',
                '$tempat_lahir',
                '$tgl_lahir',
                '$jenis_kelamin',
                '$email',
                '$username_user',
                '$password_hash',
                CURRENT_TIMESTAMP
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Registrasi berhasil!');
                window.location='register.php';
              </script>";
    } else {
        echo "Registrasi gagal: " . mysqli_error($conn);
    }
}

?>

