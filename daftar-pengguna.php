<?php
include_once("koneksi-mysqli.php");

$sql = "SELECT id, nama, tempat_lahir, tgl_lahir,
               jenis_kelamin, email, username,
               timestamp_regis
        FROM pengguna
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Gagal mengambil data: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>
</head>

<body>
    <h1>Daftar Pengguna</h1>
    <p>Berikut adalah daftar pengguna yang terdaftar.</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Username</th>
                <th>Tanggal Registrasi</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>
                        <?php echo htmlspecialchars($data['nama']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data['tempat_lahir']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data['tgl_lahir']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data['jenis_kelamin']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data['email']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data['username']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($data['timestamp_regis']); ?>
                    </td>
                </tr>
            <?php
                }
            } else {
                echo "<tr>
                        <td colspan='8'>Belum ada data pengguna.</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <br>

    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>

<?php
// MENUTUP KONEKSI DATABASE
mysqli_free_result($result);
mysqli_close($conn);
?>
