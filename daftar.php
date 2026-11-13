
<?php
include 'koneksi.php';

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    if ($password != $konfirmasi) {
        echo "<script>alert('Password tidak sama!');</script>";
    } else {
        $cek = mysqli_prepare($db, "SELECT * FROM usern WHERE username = ?");
        mysqli_stmt_bind_param($cek, "s", $username);
        mysqli_stmt_execute($cek);
        $hasil = mysqli_stmt_get_result($cek);

        if (mysqli_num_rows($hasil) > 0) {
            echo "<script>alert('Username sudah digunakan!');</script>";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $role = "petugas";

            $query = mysqli_prepare($db,
                "INSERT INTO usern (username, password, role) VALUES (?, ?, ?)"
            );

            mysqli_stmt_bind_param($query, "sss", $username, $password_hash, $role);

            if (mysqli_stmt_execute($query)) {
                echo "<script>
                    alert('Pendaftaran berhasil!');
                    window.location='create.php';
                </script>";
            } else {
                echo "Pendaftaran gagal!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Daftar Akun Petugas</h2>
    <p>Silakan isi data pendaftaran</p>

    <form method="POST">
        <input type="text" name="username"
            placeholder="Masukkan Username" required>

        <input type="password" name="password"
            placeholder="Masukkan Password" required>

        <input type="password" name="konfirmasi"
            placeholder="Konfirmasi Password" required>

        <button type="submit" name="daftar">Daftar</button>
    </form>

    <p>Sudah punya akun?
        <a href="create.php">Login</a>
    </p>
</div>

</body>
</html>
